<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use App\Http\Controllers\SystemController;
use DB;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function __construct()
    {
        $SystemController = new SystemController;
    }

    public function MgtCourses()
    {
        $rem = ['id', 'TotalPreTests', 'TotalPostTests', 'TotalPracticals', 'TotalExercises', 'TotalModules', 'created_at', 'updated_at', 'uuid', 'CID', 'Thumbnail', 'ApprovalStatus'];

        $FormEngine = new FormEngine();

        $Courses = DB::table('courses')->get();
        $data    = [
            'Page'    => 'courses.MgtCourses',
            'Title'   => 'Manage all supported courses',
            'Desc'    => 'Course Settings',
            'Courses' => $Courses,
            'rem'     => $rem,
            'Form'    => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function SelectCourseModule(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'modules.SelectCourse',
            'Title'   => 'Select course to attache modules to',
            'Desc'    => 'Course module Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }
    public function ModuleCourseSelected(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtModules', ['id' => $id]);
    }

    public function MgtModules($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $Modules = DB::table('modules')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data       = [
            'Page'       => 'modules.MgtModule',
            'Title'      => 'Manage modules attached to the selected course',
            'Desc'       => 'Course module Assignment',
            'Modules'    => $Modules,
            'CourseName' => $Courses->CourseName,
            'CID'        => $Courses->CID,
            'rem'        => $rem,
            'Form'       => $FormEngine->Form('modules'),
        ];

        return view('scrn', $data);
    }

    public function CourseLinksCourse()
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'VideoLinks.SelectCourse',
            'Title'   => 'Select course to attach an live video lesson session to',
            'Desc'    => 'Course Video Links',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptVideoCourse(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',

        ]);

        $id = $request->id;

        return redirect()->route('MgtVideoLinks', ['id' => $id]);
    }

    public function MgtVideoLinks($id)
    {
        $SelectedCourse = DB::table('courses')->where('id', '=', $id)->first();

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
            ->select('I.*', 'C.CourseName')
            ->get();

        $FormEngine = new FormEngine();

        $data = [
            'Page'           => 'VideoLinks.MgtVideoLinks',
            'Title'          => 'Manage live video links attached to the selected course',
            'Desc'           => $SelectedCourse->CourseName,
            'Links'          => $Links,
            'SelectedCourse' => $SelectedCourse,
            "rem"            => $rem,
            "Form"           => $FormEngine->Form('course_links'),
        ];

        return view('scrn', $data);

    }

    public function MgtCourseSchedule()
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
            'Page'      => 'courses.MgtSchedule',
            'Title'     => 'Manage Course Schedule',
            'Desc'      => 'Course Schedule Settings',
            'Schedules' => $Schedules,
            // 'Modules' => $Modules,
            'Courses'   => $Courses,
            "rem"       => $rem,
            "Form"      => $FormEngine->Form('course_schedules'),
        ];

        return view('scrn', $data);
    }

    public function MgtMarkingGuide()
    {

        $FormEngine = new FormEngine();

        $rem = [
            'id',
            'TotalPreTests',
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
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('marking_guides AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'    => 'courses.MarkingGuide',
            'Title'   => 'Manage Course Marking Guide',
            'Desc'    => 'Marking Guide Settings',
            'Guides'  => $Guides,
            // 'Modules' => $Modules,
            'Courses' => $Courses,
            "rem"     => $rem,
            "Form"    => $FormEngine->Form('marking_guides'),
        ];

        return view('scrn', $data);
    }

}
