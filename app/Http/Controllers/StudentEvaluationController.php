<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use Auth;
use DB;
use Illuminate\Http\Request;

class StudentEvaluationController extends Controller
{

    public function StudentCourseEvaluation()
    {
        $Courses = DB::table('courses')
            ->where('CID', Auth::user()->CID)
            ->first();

        $Time = DB::table('approval_details')
            ->where('UserID', Auth::user()->UserID)
            ->first();

        $Student = DB::table('students')
            ->where('uuid', Auth::user()->UserID)
            ->first();

        $Evaluation = DB::table('student_evaluations')
            ->where('UserID', Auth::user()->UserID)
            ->get();

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'ModulePresentation',
            'uuid',
            'CID',
            'OverallTheTrainingMetMyExpectations',
            'IWillBeAbleToApplyTheKnowledgeLearned',
            'HowDoYouRateTheTrainingOverall',
            'TheTrainingWasRelevantToMyWork',
            'UseofSkills',
            'OtherComments',
            'InstructorFeedback',
        ];

        $FormEngine = new FormEngine();

        $data = [
            'Page'       => 'evaluations.StudentEval',
            'Title'      => 'Fill in the student overall course evaluation form',
            'Desc'       => $Courses->CourseName,
            // 'Modules' => $Modules,
            'Time'       => $Time,
            'Student'    => $Student,
            'Evaluation' => $Evaluation,
            'rem'        => $rem,
            'Form'       => $FormEngine->Form('student_evaluations'),
        ];

        return view('scrn', $data);
    }

    public function SubmitEvaluation(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $counter = DB::table('student_evaluations')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', Auth::user()->CID)
            ->count();

        if ($counter > 0) {

            return redirect()
                ->back()
                ->with('error_a', ' You have already submitted an evaluation. Delete the existings evaluation and try again.');

        } else {

            DB::table('student_evaluations')->insert(
                $request->except(['_token', 'TableName', 'id', 'files'])
            );

            return redirect()
                ->back()
                ->with('status', 'Your Evaluation has been successfully saved');

        }

    }

    public function StudentEvaluationReport()
    {
        $Evaluation = DB::table('courses AS C')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('approval_details AS A', 'A.UserID', 'S.uuid')
            ->join('student_evaluations AS E', 'E.CID', 'C.CID')
            ->select('C.*', 'S.*', 'A.*', 'E.*')
            ->get();

        $data = [
            'Page'       => 'students.EvalReport',
            'Title'      => 'Student Course Evaluation Report',
            'Desc'       => 'SRL E-learning Student Feedback',
            // 'Modules' => $Modules,

            'Evaluation' => $Evaluation,

        ];

        return view('scrn', $data);
    }

}