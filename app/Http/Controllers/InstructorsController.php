<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use App\Http\Controllers\SystemController;
use Auth;
use DB;
use Illuminate\Http\Request;

class InstructorsController extends Controller
{
    public function __construct()
    {
        $SystemController = new SystemController;
    }

    public function InstrSelectCourse()
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'instructors.SelectCourse',
            'Title'   => 'Select course to attach an instructor to',
            'Desc'    => 'Course Instructor Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptInstCourse(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',

        ]);

        $id = $request->id;

        return redirect()->route('InstrCourseSelect', ['id' => $id]);
    }

    public function InstrCourseSelect($id)
    {
        $SelectedCourse = DB::table('courses')->where('id', $id)->first();

        $Instructors = DB::table('courses AS C')
            ->where('C.id', $id)
            ->join('instructors AS I', 'I.CID', 'C.CID')
            ->select('I.*', 'C.CourseName')
            ->get();

        $FormEngine = new FormEngine;

        $rem = [

            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'IID',
        ];

        $data = [
            'Page'           => 'instructors.MgtInstructors',
            'Title'          => 'Select course to attach an instructor to',
            'Desc'           => 'Course Instructor Settings',
            'Instructors'    => $Instructors,
            "rem"            => $rem,
            "SelectedCourse" => $SelectedCourse,
            "CourseName"     => $SelectedCourse->CourseName,
            "CID"            => $SelectedCourse->CID,
            "Form"           => $FormEngine->Form('instructors'),
        ];

        return view('scrn', $data);
    }

    public function NewInstructor(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
            'Email' => 'unique:instructors',
            'Email' => 'unique:users,email',
        ]);

        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );

        DB::table('users')->insert([
            'name'        => $request->Name,
            'email'       => $request->Email,
            'password'    => \Hash::make($request->Email),
            'nationality' => $request->Nationality,
            'phone'       => $request->Phone,
            'role'        => 'Instructor',
            'UserID'      => $request->IID,
        ]);

        return redirect()
            ->back()
            ->with('status', 'The selected record was created successfully');
    }

    public function DeleteInstructor($id)
    {
        $up = DB::table('instructors')
            ->where('id', $id)
            ->first();

        DB::table('users')
            ->where('UserID', $up->uuid)
            ->delete();

        DB::table('instructors')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->back()
            ->with('status', 'The selected record was deleted successfully');
    }

    public function InstructorGuides()
    {
        $FormEngine = new FormEngine();

        $rem = [
            'id', 'TotalPreTests',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'url',

        ];

        $Courses = DB::table('courses')->get();
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.*', 'C.CourseName')->get();

        $Guides = DB::table('courses AS C')
        // ->where('C.id', $id)
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('instructor_guidelines AS G', 'G.MID', 'M.MID')
            ->select('G.*', 'C.CourseName', 'M.Module')
            ->get();

        $data = [
            'Page'    => 'instructors.MgtGuides',
            'Title'   => ' Modular Instructor Guides',
            'Desc'    => 'Instructor Guides',
            'Guides'  => $Guides,
            'Modules' => $Modules,
            'Courses' => $Courses,
            "rem"     => $rem,
            "Form"    => $FormEngine->Form('instructor_guidelines'),
        ];

        return view('scrn', $data);
    }

    public function InstructorViewCourses()
    {

        $Courses = DB::table('courses')->get();
        $data    = [
            'Page'    => 'instructors.InstructorViewCourses',
            'Title'   => 'View courses and associated notes',
            'Desc'    => 'Instructor View Course Notes',
            'Courses' => $Courses,

        ];

        return view('scrn', $data);
    }

    public function ViewModules($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $Modules = DB::table('modules')
            ->where('CID', '=', $Courses->CID)
            ->get();

        // $rem = ['id', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'MID'];

        // $FormEngine = new FormEngine();
        $data = [
            'Page'       => 'instructors.ViewModules',
            'Title'      => 'View modules attached to the selected course',
            'Desc'       => 'Select modular notes to view',
            'Modules'    => $Modules,
            'CourseName' => $Courses->CourseName,
            'CID'        => $Courses->CID,
            // 'rem'        => $rem,
            // 'Form'       => $FormEngine->Form('modules'),
        ];

        return view('scrn', $data);
    }

    public function ViewNotes($id)
    {
        $Modules = DB::table('modules')->where('id', $id)->first();
        $Details = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->where('M.id', $id)
            ->select('C.*', 'M.*')
            ->first();

        $Notes = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('notes AS N', 'N.MID', 'M.MID')
            ->where('M.MID', $Modules->MID)
            ->where('N.Type', 'document')
            ->select('N.*')
            ->get();

        $Videos = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('notes AS N', 'N.MID', 'M.MID')
            ->where('M.MID', $Modules->MID)
            ->where('N.Type', 'video')
            ->select('N.*')
            ->get();

        // $FormEngine = new FormEngine;

        // $rem = [
        //     'id',
        //     'created_at',
        //     'updated_at',
        //     'ModulePresentation',
        //     'uuid',
        //     'CID',
        //     'Type',
        //     'url',
        //     'MID'];
        $data = [
            'Page'       => 'instructors.ViewNotes',
            'Title'      => 'View all the motes attached to the selected course module',
            'Desc'       => 'Modular Notes',
            'Modules'    => $Modules,
            // "rem"        => $rem,
            "Notes"      => $Notes,
            "Videos"     => $Videos,
            "CID"        => $Details->CID,
            "MID"        => $Details->MID,
            "CourseName" => $Details->CourseName,
            "ModuleName" => $Details->Module,
            // "Form"       => $FormEngine->Form('notes'),
        ];

        return view('scrn', $data);
    }

    public function SelectLinksCourse(Type $var = null)
    {

        if (Auth::user()->role == 'student') {

            $Courses = DB::table('courses')->where('CID', Auth::user()->CID)->get();
        } else {
            $Courses = DB::table('courses')->get();
        }

        $data = [
            'Page'    => 'instructors.SelectLinkCourse',
            'Title'   => 'Select course  whose live stream links are required',
            'Desc'    => 'Course Lesson Live Stream',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ViewVideoLinks(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        $SelectedCourse = DB::table('courses')->where('id', '=', $id)->first();

        // dd($SelectedCourse);
        $rem = [
            'id', 'TotalPreTests',
            'TotalPostTests',
            'TotalPracticals',
            'TotalExercises',
            'TotalModules',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'Thumbnail',
            'Status',
            'status',
        ];
        $SelectedCourse = DB::table('courses')->where('id', $id)->first();

        $Links = DB::table('courses AS C')
            ->where('C.id', $id)
            ->join('course_links AS I', 'I.CID', 'C.CID')
        // ->where('I.status', 'active')
            ->select('I.*', 'C.CourseName')
            ->get();

        // dd($Links);

        $FormEngine = new FormEngine();

        $data = [
            'Page'           => 'instructors.ViewVideoLinks',
            'Title'          => 'Select live session to stream ',
            'Desc'           => $SelectedCourse->CourseName,
            'Links'          => $Links,
            'SelectedCourse' => $SelectedCourse,
            "rem"            => $rem,
            "Form"           => $FormEngine->Form('course_links'),
        ];

        return view('scrn', $data);

    }

    public function ViewCourseSchedule()
    {
        $FormEngine = new FormEngine();

        $rem = [
            'id', 'TotalPreTests',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'url',

        ];

        $Courses = DB::table('courses')->get();
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.*', 'C.CourseName')->get();

        $Schedules = DB::table('courses AS C')
        // ->where('C.id', $id)
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('course_schedules AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'      => 'instructors.ViewCourseSchedule',
            'Title'     => 'View Course Schedules',
            'Desc'      => 'Course Schedules',
            'Schedules' => $Schedules,
            // 'Modules' => $Modules,
            'Courses'   => $Courses,
            "rem"       => $rem,
            "Form"      => $FormEngine->Form('course_schedules'),
        ];

        return view('scrn', $data);
    }

    public function SelectCourseMarkingGuide()
    {

        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'instructors.SelectCourseMarkingGuide',
            'Title'   => 'Select course whose marking guide are required',
            'Desc'    => 'Course Marking Guide',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptCourseMarkingGuide(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',

        ]);

        $id = $request->id;

        return redirect()->route('ViewMarkingGuide', ['id' => $id]);
    }

    public function ViewMarkingGuide($id)
    {
        $Course = DB::table('courses')->where('id', $id)->first();

        $Guides = DB::table('courses AS C')
            ->where('C.id', $id)
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('marking_guides AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'       => 'instructors.ViewMarkingGuide',
            'Title'      => 'Course Marking Guides',
            'Desc'       => $Course->CourseName,
            'CourseName' => $Course->CourseName,
            'Guides'     => $Guides,
            // 'Modules' => $Modules,
            // 'Courses' => $Courses,
            // "rem"     => $rem,
            // "Form"    => $FormEngine->Form('marking_guides'),
        ];

        return view('scrn', $data);
    }

}
