<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminStatsController;
use App\Http\Controllers\FormEngine;
use App\Http\Controllers\SystemController;
use App\Mail\NotifyMail;
use Auth;
use DB;
use Illuminate\Http\Request;
use Mail;

// use Illuminate\Http\Request;
class OpenController extends Controller
{

    public function __construct()
    {

        if (!\Schema::hasTable('country')) {

            DB::unprepared(COUNTRIES);

        }
        if (!\Schema::hasTable('approval_details')) {
            \Schema::create('approval_details', function ($table) {
                $table->id();
                $table->string('uuid');
                $table->string('UserID');
                $table->date('From');
                $table->date('To');
                $table->string('Coordinator');
                $table->string('Signature');
                $table->string('Sent')->default('false');
                $table->timestamps();
            });

        } elseif (!\Schema::hasTable('student_evaluations')) {

            \Schema::create('student_evaluations', function ($table) {
                $table->id();
                $table->string('uuid');
                $table->string('CID');
                $table->string('UserID');
                $table->string('Country');
                $table->string('OverallTheTrainingMetMyExpectations');
                $table->string('IWillBeAbleToApplyTheKnowledgeLearned');
                $table->string('TheTrainingOutcomesWereMet');
                $table->string('HowDoYouRateTheTrainingOverall');
                $table->string('TheTrainingWasRelevantToMyWork');
                $table->longText('UseofSkills');
                $table->longText('OtherComments');
                $table->string('InstructorFeedback');
                $table->timestamps();
            });

        } elseif (!\Schema::hasTable('certificates_issueds')) {

            \Schema::create('certificates_issueds', function ($table) {
                $table->id();
                $table->string('CID');
                $table->string('UserID');
                $table->bigInteger('Score');
                $table->string('Type');
                $table->bigInteger('CertNo');
                $table->bigInteger('PostTestScore')->nullable();
                $table->bigInteger('PreTestScore')->nullable();
                $table->bigInteger('PracticalTestScore')->nullable();
                $table->bigInteger('AttendanceScore')->nullable();
                $table->bigInteger('ModularScore')->nullable();
                $table->bigInteger('CEUs')->nullable();
                $table->date('From')->nullable();
                $table->date('To')->nullable();
                $table->timestamps();
            });

        } elseif (!\Schema::hasTable('modules_attended_by_students')) {

            \Schema::create('modules_attended_by_students', function ($table) {
                $table->id();
                $table->string('CID');
                $table->string('UserID');
                $table->string('status')->default('false');
                $table->bigInteger('ModulesExpected');
                $table->bigInteger('ModulesAttended');
                $table->timestamps();
            });

        } elseif (!\Schema::hasTable('module_counts')) {

            \Schema::create('module_counts', function ($table) {
                $table->id();
                // $table->string('uuid');
                $table->string('CID');
                $table->bigInteger('ModuleCount');
                $table->timestamps();
            });

        } elseif (!\Schema::hasTable('student_attendances')) {
            \Schema::create('student_attendances', function ($table) {
                $table->id();
                $table->string('uuid');
                $table->string('UserID');
                $table->string('CID');
                $table->string('MID');
                // $table->string('IID');
                $table->string('status')->default('true');
                $table->timestamps();
            });
        }

        if (!\Schema::hasTable('cordinators')) {
            DB::unprepared(COORDINATORS_TABLE);
        }

    }

    public function StudentModules()
    {
        $Courses = DB::table('courses')
            ->where('CID', '=', Auth::user()->CID)
            ->first();

        $Modules = DB::table('modules')
            ->where('CID', '=', Auth::user()->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data       = [
            'Page'       => 'public.MyModules',
            'Title'      => 'View all modules for  your course',
            'Desc'       => $Courses->CourseName,
            'Modules'    => $Modules,
            'CourseName' => $Courses->CourseName,
            'CID'        => $Courses->CID,
            'rem'        => $rem,
            'Form'       => $FormEngine->Form('modules'),
        ];

        return view('scrn', $data);
    }

    private function __SendAdmissionLetter()
    {

        $UserID = Auth::user()->UserID;

        $Details = DB::table('approval_details')
            ->where('UserID', $UserID)
            ->first();

        $course = DB::table('students AS S')
            ->where('S.uuid', $UserID)
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->select('C.*', 'S.*')
            ->first();

        $Contents = ['Course' => $course->CourseName,

            "From"                => $Details->From,
            "To"                  => $Details->To,
            "Cord"                => $Details->Coordinator,
            "Signature"           => $Details->Signature,
        ];

        if ('false' == $Details->Sent || null == $Details->Sent) {

            Mail::to(Auth::user()->email)->send(new NotifyMail($Contents));

            $Details = DB::table('approval_details')
                ->where('UserID', $UserID)
                ->update([
                    'Sent' => 'true',
                ]);

        }

    }

    public function ViewCourses()
    {
        if (Auth::check()) {

            if (Auth::user()->role == 'admin') {

                $AdminStatsController = new AdminStatsController;

                // return $AdminStatsController->AdminStats();

                return redirect()->route('AdminStats');

            }
        }

        if (Auth::check()) {

            if (Auth::user()->role == 'student') {
                return $this->StudentDashboard();
            }
        }
        $SystemController = new SystemController();

        if (Auth::check()) {

            // dd('true');

            if (
                Auth::user()->role == 'PreTest'

            ) {

                $this->__SendAdmissionLetter();

                return $SystemController->LoadPretestExam();

            } elseif (Auth::user()->role == 'Approve') {

                return redirect()->route('ApplicationStatus');

            } elseif (Auth::user()->role == 'Instructor') {

                return redirect()->route('InstructorViewCourses');

            }
        }

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'ReasonsForJoining',
            'SpecialNeed',
            'Gender',
            'CV',
            'StudentID',
            'ApprovalStatus',
            'StartDate',
            'CourseDuration',
            'Comment',
            'nationality',

        ];

        $FormEngine = new FormEngine();
        $Courses    = DB::table('courses')->get();
        $Students   = DB::table('students')->get();

        $Countries = DB::table('country')->get();
        $data      = [
            //"Page" => "users.MgtUsers",
            'Page'      => 'public.CourseView',
            'Title'     =>
            'SRL Uganda Course Catalog | Click View More To See More Details',
            'Desc'      => 'Select a course to enroll for',
            'Courses'   => $Courses,
            'Countries' => $Countries,
            'Students'  => $Students,
            'TermsYes'  => 'true',
            'Policy'    => 'true',
            'rem'       => $rem,
            'Form'      => $FormEngine->Form('students'),
        ];

        return view('scrn', $data);
    }

    public function StudentDashboard()
    {
        $Modules = DB::table('modules')->where('CID', Auth::user()
                ->CID)->count();

        $Notes = DB::table('notes')->where('CID', Auth::user()
                ->CID)->count();

        $Prac = DB::table('practical_tests')->where('CID', Auth::user()
                ->CID)->count();

        $Mods = DB::table('modular_tests')->where('CID', Auth::user()
                ->CID)->count();

        $PostTests = DB::table('post_tests')->where('CID', Auth::user()
                ->CID)->count();

        $AttemptPostTests = DB::table('attempt_post_tests')
            ->where('UserID', Auth::user()
                    ->UserID)->count();

        $AttemptModTests = DB::table('attempt_modular_tests')
            ->where('UserID', Auth::user()
                    ->UserID)->count();

        $AttemptPracTests = DB::table('attempt_practical_tests')
            ->where('UserID', Auth::user()
                    ->UserID)->count();

        $Instructors = DB::table('instructors')
            ->where('CID', Auth::user()
                    ->CID)->count();

        $data = [
            //"Page" => "users.MgtUsers",
            'Page'             => 'StudentStats.Stats',
            'Title'            =>
            'SRL Uganda E-learning | Student Dashboard ',
            'Desc'             => Auth::user()->name,
            'Modules'          => $Modules,
            'Notes'            => $Notes,
            'Prac'             => $Prac,
            'Mods'             => $Mods,
            'PostTests'        => $PostTests,
            'AttemptPostTests' => $AttemptPostTests,
            'AttemptModTests'  => $AttemptModTests,
            'AttemptPracTests' => $AttemptPracTests,
            'Instructors'      => $Instructors,

        ];

        return view('scrn', $data);
    }

    public function dashboard(Type $var = null)
    {
        if (Auth::check()) {

            if (Auth::user()->role == 'admin') {

                $AdminStatsController = new AdminStatsController;

                // return $AdminStatsController->AdminStats();

                return redirect()->route('AdminStats');

            }
        }

        if (Auth::check()) {

            if (Auth::user()->role == 'student') {
                return $this->StudentDashboard();
            }
        }

        $SystemController = new SystemController();

        if (Auth::check()) {

            // dd('true');

            if (
                Auth::user()->role == 'PreTest'

            ) {
                return $SystemController->LoadPretestExam();

            } elseif (Auth::user()->role == 'Approve') {

                return redirect()->route('ApplicationStatus');

            } elseif (Auth::user()->role == 'Instructor') {

                return redirect()->route('InstructorViewCourses');

            }
        }

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'ReasonsForJoining',
            'SpecialNeed',
            'Gender',
            'CV',
            'StudentID',
            'ApprovalStatus',
            'StartDate',
            'CourseDuration',
            'Comment',

        ];

        $FormEngine = new FormEngine();
        $Courses    = DB::table('courses')->get();
        $Students   = DB::table('students')->get();

        $data = [
            //"Page" => "users.MgtUsers",
            'Page'     => 'public.CourseView',
            'Title'    =>
            'SRL Uganda Course Catalog | Click View More To See More Details',
            'Desc'     => 'Select a course to enroll for',
            'Courses'  => $Courses,
            'Students' => $Students,
            'Policy'   => 'true',
            'rem'      => $rem,
            'Form'     => $FormEngine->Form('students'),
        ];

        return view('scrn', $data);
    }
    public function NewStudent(Request $request)
    {
        $request->validate([
            '*'         => 'required',
            'CV'        => 'required|mimes:pdf|max:30048',
            'Email'     => 'required|unique:students',
            'StudentID' => 'required|mimes:pdf|max:30048',
        ]);

        $CV = time() . '.' . $request->CV->extension();
        $request->CV->move(public_path('assets/data'), $CV);

        $StudentID = time() . '.' . $request->StudentID->extension();
        $request->StudentID->move(public_path('assets/data'), $CV);

        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files', 'role'])
        );

        DB::table('users')->insert([
            'UserID'            => $request->uuid,
            'password'          => \Hash::make($request->Email),
            'email'             => $request->Email,
            'role'              => 'Approve',
            'phone'             => $request->MobileNumber,
            'name'              => $request->Name,
            'ApplicationLetter' => $request->ReasonsForJoining,
            'institution'       => $request->ParentOrganization,
            'nationality'       => $request->Nationality,
            'CID'               => $request->CID,
            'gender'            => $request->Gender,
        ]);

        DB::table($request->TableName)
            ->where('uuid', $request->uuid)
            ->update([
                'StudentID' => $StudentID,
                'CV'        => $CV,
            ]);

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Your course application has been submitted successfully and is pending review, Login into your SRL E-learning account using the email ' .
                $request->Email .
                ' and the password ' .
                $request->Email .
                '. Remember to update your credentials upon login'
            );
    }

    public function ApproveStudentApps(Type $var = null)
    {
        $Coordinators = DB::table('cordinators')->get();
        // dd($Coordinators);
        $Apps = DB::table('students AS S')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->where('U.role', 'Approve')
            ->select(
                'C.CourseName',
                'U.*',
                'C.CourseDescription',
                'S.*',
                'S.id AS ID',
                'U.id AS Uid'
            )
            ->get();

        $data = [
            'Page'         => 'public.ApproveApplication',
            'Title'        => 'Approve Student Course Application',
            'Desc'         => 'Course Application Approval ',
            'Apps'         => $Apps,
            'Coordinators' => $Coordinators,
        ];

        return view('scrn', $data);
    }

    public function ApplicationStatus(Type $var = null)
    {

        $Coordinators = DB::table('cordinators')->count();

        // dd($Coordinators);

        $Apps = DB::table('students AS S')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->where('U.UserID', \Auth::user()->UserID)
            ->select(
                'C.CourseName',
                'U.*',
                // 'U.id AS USER_ID',
                'C.CourseDescription',
                'S.*',
                'U.id AS ID'
            )
            ->get();
        $data = [
            'Page'         => 'public.ApplicationStatus',
            'Title'        => 'Your Course Application Dashboard',
            'Desc'         => 'Course Application ',
            'Apps'         => $Apps,
            'Coordinators' => $Coordinators,
        ];

        return view('scrn', $data);
    }

    public function ApproveAppLogic(Request $request)
    {
        $request->validate([
            '*' => 'required',

        ]);

        DB::table('students')->where('id', '=', $request->id)
            ->update([

                "ApprovalStatus" => 'Approved',
                "StartDate"      => $request->From,
                "CourseDuration" => 00,
                "Comment"        => 'Student Approved',

            ]);

        $Coordinator = DB::table('cordinators')
            ->where('id', '=', $request->Coordinator)
            ->first();

        DB::table('approval_details')->insert([

            "uuid"        => md5(uniqid() . date('Y-m-d H:i:s')),
            "UserID"      => $request->UserID,
            "From"        => $request->From,
            "To"          => $request->To,
            "Coordinator" => $Coordinator->Name,
            "Signature"   => $Coordinator->Signature,

        ]);

        DB::table('users')->where('UserID', '=', $request->UserID)
            ->update([

                'role' => 'PreTest',
            ]);

        return redirect()
            ->back()
            ->with('status', 'The student application has been approved successfully');
    }
}