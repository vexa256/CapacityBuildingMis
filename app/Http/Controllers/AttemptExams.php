<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class AttemptExams extends Controller
{

    public function SetTestTimer()
    {
        $rem = ['id', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'AssessmentType'];

        $FormEngine = new FormEngine();

        $Timers = DB::table('exam_timer_logics')->get();
        $data   = [
            'Page'  => 'ExamTimer.SetTestTimer',
            'Title' => 'Set the test duration/timing logic',
            'Desc'  => 'Test Timer Settings',
            'Timer' => $Timers,
            "rem"   => $rem,
            "Form"  => $FormEngine->Form('exam_timer_logics'),
        ];

        return view('scrn', $data);
    }

    public function ResetTimer($id)
    {

        DB::table('exam_timer_logics')->where('id', $id)->delete();

        return redirect()
            ->back()
            ->with('status', 'The timer for the selected assessment type has been reset  successfully. Please create a new timer record');

    }

    private function ModularConfirmActiveStatus()
    {
        $Course = DB::table('courses')
            ->where('CID', Auth::user()->CID)->first();

        $StudentCourseName = $Course->CourseName;

        $ActiveCID = $Course->CID;

        $ActiveChecker = DB::table('modular_tests')->where('CID', $ActiveCID)
            ->where('Active', 'true')
            ->count();

        if ($ActiveChecker < 1) {

            return false;

        } else {

            return true;
        }

    }

    public function StartModularExam()
    {

        $Timer = DB::table('exam_timer_logics')->count();

        if ($Timer < 3) {
            return redirect()
                ->back()
                ->with('error_a', 'SRL Uganda has not yet set the time allocation for the assessment. The time allocation is in progress, Try again later.');

        }

        if ($this->ModularConfirmActiveStatus()) {

            $ModularTests = DB::Table('modular_tests AS M')
                ->join('courses AS C', 'C.CID', 'M.CID')
                ->join('modules AS D', 'D.MID', 'M.MID')
                ->select('M.*', 'C.CourseName', 'D.Module')
                ->get();

            $data = [
                'Page'         => 'AttemptExams.SelectModularToAttempt',
                'Title'        => 'Modular Test Selection',
                'Desc'         => 'SRL Uganda Assessments',
                // 'Course' => $Course,
                'ModularTests' => $ModularTests,
                // "rem" => $rem,
                // "Form" => $FormEngine->Form('courses'),
            ];

            return view('scrn', $data);

        } else {

            return redirect()
                ->back()
                ->with('error_a', 'SRL Uganda has not yet enabled modular tests for this course. Contact your instructor for more details');

        }

    }

    public function ModularTestToAttemptSelected($id)
    {
        $ModularExam = DB::table('modular_tests')->where('id', $id)->first();

        $CheckAttempt = DB::table('attempt_modular_tests')
            ->where('ModularTestUuid', $ModularExam->uuid)
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($CheckAttempt > 0) {
            return redirect()
                ->route('StartModularExam')
                ->with('error_a', 'You have already attempted this test. Please select another test to attempt');

        }

        $GetExamTime = DB::table('exam_timer_logics')
            ->where('AssessmentType', 'ModularTests')
            ->first();

        $SetDeadline = Carbon::now()
            ->addMinutes($GetExamTime->TimeInMinutes)
            ->format('Y-m-d H:i:s');

        $CheckAttemptForStudent = DB::table('student_exam_sessions')
            ->where('CID', $ModularExam->CID)
            ->where('MID', $ModularExam->MID)
            ->where('ExamUuid', $ModularExam->uuid)
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($CheckAttemptForStudent < 1) {

            $CreateTimerAndLock = DB::table('student_exam_sessions')->insert([

                'uuid'       => md5(uniqid() . 'AFC' . date('Y-m-d H:I:S')),
                'CID'        => $ModularExam->CID,
                'MID'        => $ModularExam->MID,
                'ExamUuid'   => $ModularExam->uuid,
                'UserID'     => Auth::user()->UserID,
                'Deadline'   => $SetDeadline,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

        }

        $ModularTests = DB::Table('modular_tests AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('modules AS D', 'D.MID', 'M.MID')
            ->where('M.id', $id)
            ->select('M.*', 'C.CourseName', 'D.Module')
            ->get();

        $Deadline = DB::table('student_exam_sessions')
            ->where('CID', $ModularExam->CID)
            ->where('MID', $ModularExam->MID)
            ->where('ExamUuid', $ModularExam->uuid)
            ->where('UserID', Auth::user()->UserID)
            ->first();

        $data = [
            'Page'         => 'AttemptExams.AttemptModular',
            'Title'        => 'You are now attempting the modular test ' . $ModularExam->ModularTestTitle,
            'Desc'         => 'SRL Uganda Assessments',
            // 'Course' => $Course,
            'ModularTests' => $ModularTests,
            'Exam'         => $ModularExam,
            'Deadline'     => date('F j, Y, g:i a', strtotime($Deadline->Deadline)),
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function SubmitModularAnswer(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',

        ]);

        $CheckExpiry = DB::table('student_exam_sessions')
            ->where('UserID', Auth::user()->UserID)
            ->where('ExamUuid', $request->ModularTestUuid)
        // ->where('MID', $request->MID)
        // ->where('MID', $request->CID)
            ->first();

        $GetDeadline = $CheckExpiry->Deadline;

        if (Carbon::createFromFormat('Y-m-d H:i:s', $GetDeadline)->isPast()) {

            return redirect()
                ->route('StartModularExam')
                ->with('error_a', 'The submission deadline exceeded. Answers not captured. Contact your facilitator for further information.');

        }

        DB::table('attempt_modular_tests')->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );

        return redirect()
            ->route('StartModularExam')
            ->with('status', 'Your submission has been sent to SRL for marking. Results will appear in your scoreboard once they are availed');

    }

}
