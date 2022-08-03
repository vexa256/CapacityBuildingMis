<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use Auth;
use DB;
use Illuminate\Http\Request;

class ScoreBoardController extends Controller
{
    // protected $property;

    public function __construct()
    {
        $Counter = DB::table('courses')->count();

        if ($Counter > 0) {

            $Courses = DB::table('courses')->get();

            foreach ($Courses as $data) {

                $ModulesCount = DB::table('modules')
                    ->where('CID', $data->CID)
                    ->count();

                if (DB::table('module_counts')->where('CID', $data->CID)->count() > 0) {

                    DB::table('module_counts')
                        ->where('CID', $data->CID)->update([
                        "ModuleCount" => $ModulesCount,
                        // "CID"         => $data->CID,
                    ]);

                } else {

                    DB::table('module_counts')->insert([
                        "ModuleCount" => $ModulesCount,
                        "CID"         => $data->CID,
                    ]);

                }

            }

        }

    }

    public function modules_attended_by_students()
    {

        $UserID = Auth::user()->UserID;

        $StudentCourseCID = Auth::user()->CID;

        $ExpectedModulesAttended = DB::table('module_counts')
            ->where('CID', $StudentCourseCID)
            ->first();

        $ModulesAttended = DB::table('student_attendances')
            ->where('CID', $StudentCourseCID)
            ->where('UserID', $UserID)
            ->count();

        $Counter = DB::table('modules_attended_by_students')
            ->where('CID', $StudentCourseCID)
            ->where('UserID', $UserID)
            ->count();

        $status = 'false';

        if ($ExpectedModulesAttended->ModuleCount == $ModulesAttended) {

            $status = 'true';

        }

        if ($Counter > 0) {

            DB::table('modules_attended_by_students')
                ->where('CID', $StudentCourseCID)
                ->where('UserID', $UserID)
                ->update([
                    "ModulesExpected" => $ExpectedModulesAttended->ModuleCount,
                    "ModulesAttended" => $ModulesAttended,
                    "status"          => $status,
                ]);
        } else {

            DB::table('modules_attended_by_students')
                ->insert([
                    "ModulesExpected" => $ExpectedModulesAttended->ModuleCount,
                    "ModulesAttended" => $ModulesAttended,
                    "CID"             => $StudentCourseCID,
                    "UserID"          => $UserID,
                    "status"          => $status,
                ]);

        }

    }

    private function __GetAttendanceScore($UserID)
    {
        $AttendanceTotalScore = 0;

        $C = DB::table('modules_attended_by_students')
            ->where('UserID', $UserID)
            ->count();

        if ($C > 0) {
            $A = DB::table('modules_attended_by_students')
                ->where('UserID', $UserID)
                ->first();

            $Calc = $A->ModulesAttended / $A->ModulesExpected;

            $AttendanceTotalScore = $Calc * 20;
        }

        return $AttendanceTotalScore;

    }

    public function RunScoreTotal()
    {
        $AttendanceTotalScore = 0;

        $C = DB::table('modules_attended_by_students')
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($C > 0) {
            $A = DB::table('modules_attended_by_students')
                ->where('UserID', Auth::user()->UserID)
                ->first();

            $Calc = $A->ModulesAttended / $A->ModulesExpected;

            $AttendanceTotalScore = $Calc * 20;
        }

        $this->modules_attended_by_students();

        $UserID = Auth::user()->UserID;

        $StudentCourseCID = Auth::user()->CID;

        $ExpectedModulesAttended = DB::table('module_counts')
            ->where('CID', $StudentCourseCID)
            ->first();

        $ModulesAttended = DB::table('student_attendances')
            ->where('CID', $StudentCourseCID)
            ->where('UserID', $UserID)
            ->count();

        $CourseAppliedFor = DB::table('courses AS C')
            ->where('C.CID', Auth::user()->CID)
            ->first();

        $CID = $CourseAppliedFor->CID;

        $TotalPracticals = DB::table('practical_tests')
            ->where('CID', $CID)
            ->count();

        $TotalModular = DB::table('modular_tests')
            ->where('CID', $CID)
            ->count();

        $TotalModular = DB::table('post_tests')
            ->where('CID', $CID)
            ->count();

        $Modular = DB::table('attempt_modular_tests')
            ->where('UserID', $UserID)->sum('Score');

        $Practical = DB::table('attempt_practical_tests')
            ->where('UserID', $UserID)->sum('Score');

        $Post = DB::table('attempt_post_tests')
            ->where('UserID', $UserID)->sum('Score');

        $ModulaScore    = ($Modular / 100) * 10;
        $PracticalScore = ($Practical / 100) * 20;
        $PostScore      = ($Post / 100) * 50;
        $Attendance     = number_format($AttendanceTotalScore);

        $data = [
            'Page'           => 'Scoreboard.Scoreboard',
            'Title'          => 'Student Scoreboard',
            'Desc'           => 'SRL Uganda Assessments',
            // 'Course' => $Course,
            'ModulaScore'    => $ModulaScore,
            'PracticalScore' => $PracticalScore,
            'PostScore'      => $PostScore,
            'Attendance'     => $Attendance,
            'CourseName'     => $CourseAppliedFor->CourseName,
            'TotalScore'     => $PostScore + $Attendance + $PracticalScore + $Modular,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function Certify()
    {

        $C = DB::table('modules_attended_by_students')
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($C > 0) {

            $A = DB::table('modules_attended_by_students')
                ->where('UserID', Auth::user()->UserID)
                ->first();

            if ('false' == $A->status) {

                return redirect()->back()->with('error_a', 'You must score 100% in your attendance sheet to certify, Attend all modules');

            }
        }

        $UserID = Auth::user()->UserID;

        $CourseAppliedFor = DB::table('courses AS C')->where('C.CID', Auth::user()->CID)->first();

        $CID = $CourseAppliedFor->CID;

        $Modules         = DB::table('modules')->where('CID', $CID)->get();
        $TotalPracticals = DB::table('practical_tests')
            ->where('CID', $CID)
            ->count();

        $TotalModular = DB::table('modular_tests')
            ->where('CID', $CID)
            ->count();

        $TotalModular = DB::table('post_tests')
            ->where('CID', $CID)
            ->count();

        $Modular = DB::table('attempt_modular_tests')
            ->where('UserID', $UserID)->sum('Score');

        $Practical = DB::table('attempt_practical_tests')
            ->where('UserID', $UserID)->sum('Score');

        $Post = DB::table('attempt_post_tests')
            ->where('UserID', $UserID)->sum('Score');

        if ($Modular < 1) {

            $Modular = 0.2;

        } elseif ($Practical < 1) {

            $Practical = 0.2;

        } elseif ($Post < 1) {

            $Post = 0.2;

        } elseif ($Post < 1) {

            $Post = 0.2;

        }

        $ModulaScore    = ($Modular / 100) * 10;
        $PracticalScore = ($Practical / 100) * 20;
        $PostScore      = ($Post / 100) * 50;
        $Attendance     = (100 / 100) * 20;
        $Total          = $PostScore + $Attendance + $PracticalScore + $Modular;

        $CertType = "Attendance";
        $bg       = asset('assets/cert/achiv.png');

        if ($Total < 80) {

            $CertType = "Attendance";
            $bg       = asset('assets/cert/attend.png');

        } else {

            $CertType = "Achievement";

            $bg = asset('assets/cert/achiv.png');

        }

        if ($Total < 80) {

            return redirect()
                ->back()
                ->with('error_a', 'You  do not qualify for certification yet. Attempt all tests and score  80%  or above to certify');

        }

        $ApprovalDetails = DB::table('approval_details')
            ->where('UserID', Auth::user()->UserID)
            ->first();

        // dd($ApprovalDetails);

        $CertCounters = DB::table('certificates_issueds')
            ->where('UserID', Auth::user()->UserID)
            ->where('CID', Auth::user()->CID)
            ->count();

        $PreScore = DB::table('attempt_pre_tests')
            ->where('StudentID', Auth::user()->UserID)
            ->where('CID', Auth::user()->CID)
            ->first();

        $PreTestScore = $PreScore->Score;

        $CertNumber = Auth::user()->id + random_int(100000, 999999);

        if ($CertCounters < 1) {

            DB::table('certificates_issueds')
                ->insert([

                    'CID'                => Auth::user()->CID,
                    'UserID'             => Auth::user()->UserID,
                    "Score"              => $Total,
                    "Type"               => $CertType,
                    "CertNo"             => $CertNumber,
                    "PostTestScore"      => $PostScore,
                    "PreTestScore"       => $PreTestScore,
                    "PracticalTestScore" => $PracticalScore,
                    "AttendanceScore"    => $this->GetAttendanceScore(Auth::user()->UserID),
                    "ModularScore"       => $ModulaScore,
                    "CEUs"               => $CourseAppliedFor->CEU,
                    'To'                 => date('Y-m-d', strtotime($ApprovalDetails->To)),
                    'From'               => date('Y-m-d', strtotime($ApprovalDetails->From)),
                    "created_at"         => date('Y-m-d H:i:s'),

                ]);

        } else {

            $CertNoGetter = DB::table('certificates_issueds')
                ->where('UserID', Auth::user()->UserID)
                ->where('CID', Auth::user()->CID)
                ->first();

            $CertNumber = $CertNoGetter->CertNo;
        }
        // dd($Modules);
        $data = [
            'Page'           => 'certificates.cert',
            'Title'          => 'Student Certificate',
            'Desc'           => 'SRL Uganda Course Certificate',
            // 'Course' => $Course,
            'ModulaScore'    => $ModulaScore,
            'bg'             => $bg,
            'PrintCert'      => 'true',
            'CertNumber'     => $CertNumber,
            'PracticalScore' => $PracticalScore,
            'Modules'        => $Modules,
            // 'From'           => $ApprovalDetails->From,
            'To'             => date('F j, Y', strtotime($ApprovalDetails->To)),
            'From'           => date('F j, Y', strtotime($ApprovalDetails->From)),

            'PostScore'      => $PostScore,
            'Attendance'     => $Attendance,
            'CourseName'     => $CourseAppliedFor->CourseName,
            'CEU'            => $CourseAppliedFor->CEU,
            'TotalScore'     => $Total,
            'CertType'       => $CertType,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('certificates.cert', $data);

    }

    public function MarkStudentAttendanceLogic(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
        ]);

        $counter = DB::table('student_attendances')
            ->where('CID', $request->CID)
            ->where('MID', $request->MID)
            ->where('UserID', $request->UserID)
            ->count();

        if ($counter > 0) {

            return redirect()->back()->with('error_a', 'Student has already attended this module. Its part of the selected student\'s attendance sheet');

        }

        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );

        return redirect()->back()->with('status', 'Attendance Record Saved Successfully');
    }

    public function CertifiedStudents()
    {

        $CertifiedStudents = DB::table('certificates_issueds AS C')
            ->join('courses AS S', 'S.CID', 'C.CID')
            ->join('users AS U', 'U.UserID', 'C.UserID')
            ->select('C.*', 'S.*', 'U.*')
            ->get();

        $data = [
            'Page'              => 'certificates.report',
            'Title'             => 'SRL Student Certification Dashboard',
            'Desc'              => 'SRL Uganda Certification Statistics',
            "CertifiedStudents" => $CertifiedStudents,

        ];

        return view('scrn', $data);

    }

}