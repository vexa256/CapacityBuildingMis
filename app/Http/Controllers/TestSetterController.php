<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use Auth;
use DB;
use Illuminate\Http\Request;

class TestSetterController extends Controller
{

    public function SelectPretestCourse(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'PreTests.SelectCourse',
            'Title'   => 'Select course to attache  a Pre-Test Assessment to',
            'Desc'    => 'Pre Test Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCoursePretest(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtPreTest', ['id' => $id]);
    }

    public function MgtPreTest($id)
    {

        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $Pretest = DB::table('pre_tests')
            ->where('CID', '=', $Courses->CID)
            ->limit(1)->get();

        $rem = ['id', 'created_at', 'status', 'Active', 'converted', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data       = [
            'Page'       => 'PreTests.MgtPreTest',
            'Title'      => 'Manage Pre-Test Questions attached to the selected course',
            'Desc'       => $Courses->CourseName,
            'Pretests'   => $Pretest,
            'CourseName' => $Courses->CourseName,
            'CID'        => $Courses->CID,
            'rem'        => $rem,
            'Form'       => $FormEngine->Form('pre_tests'),
        ];

        return view('scrn', $data);
    }

    public function SelectCourseForPostTest(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'PostTests.SelectCourse',
            'Title'   => 'Select course to attache  a Pre-Test Assessment to',
            'Desc'    => 'Pre Test Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCoursePostTest(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtPostTest', ['id' => $id]);
    }

    public function MgtPostTest($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $PostTests = DB::table('post_tests')
            ->where('CID', '=', $Courses->CID)
            ->limit(1)->get();

        $rem = ['id', 'created_at', 'Active', 'status', 'Active', 'converted', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data       = [
            'Page'       => 'PostTests.MgtPostTest',
            'Title'      => 'Manage Post-Tests questions attached to the selected course',
            'Desc'       => $Courses->CourseName,
            'PostTests'  => $PostTests,
            'CourseName' => $Courses->CourseName,
            'CID'        => $Courses->CID,
            'rem'        => $rem,
            'Form'       => $FormEngine->Form('post_tests'),
        ];

        return view('scrn', $data);
    }

    public function SelectCoursePractical(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'PracticalTests.SelectCourse',
            'Title'   => 'Select course to attache  a Practical  Assessment to',
            'Desc'    => 'Practical Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCoursePractical(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('SelectPracticalModule', ['id' => $id]);
    }

    public function SelectPracticalModule(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        $Courses = DB::table('courses')->where('id', $id)->first();

        $Modules = DB::table('modules AS M')->where('M.CID', $Courses->CID)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'    => 'PracticalTests.SelectModule',
            'Title'   => 'Select course module to attach  a practical  assessment to',
            'Desc'    => 'Practical Assessment Settings',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptPracticalModule(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtPracticalTest', ['id' => $id]);
    }

    public function MgtPracticalTest($id)
    {
        $Mod = DB::table('modules')
            ->where('id', '=', $id)
            ->first();

        $Courses = DB::table('courses')
            ->where('CID', '=', $Mod->CID)
            ->first();

        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->where('M.CID', '=', $Courses->CID)
            ->select('M.*', 'C.CourseName')
            ->get();

        $Practicals = DB::table('practical_tests AS P')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->where('P.CID', '=', $Mod->CID)
            ->select('P.*', 'M.Module', 'C.CourseName')
            ->get()->unique('id');

        $rem = ['id', 'created_at', 'status', 'Active', 'converted', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();

        $data = [
            'Page'       => 'PracticalTests.MgtPracticals',
            'Title'      => 'Manage Practical Test question attached to the selected course',
            'Desc'       => $Courses->CourseName,
            'Practicals' => $Practicals,
            'CourseName' => $Courses->CourseName,
            'CID'        => $Mod->CID,
            'MID'        => $Mod->MID,
            'rem'        => $rem,
            'Modules'    => $Modules,
            'Form'       => $FormEngine->Form('practical_tests'),
        ];

        return view('scrn', $data);
    }

    public function ModularSelectCourse(Type $var = null)
    {
        if (Auth::user()->role == 'student') {

            $Courses = DB::table('courses')->where('CID', Auth::user()->CID)->get();
        } else {
            $Courses = DB::table('courses')->get();
        }

        if (Auth::user()->role == 'student') {

            $Title = 'View modular questions for the selected course';
        } else {
            $Title = 'Select the course whose modular tests are required';
        }

        $data = [
            'Page'    => 'ModularTests.SelectCourse',
            'Title'   => $Title,
            'Desc'    => 'Modular Tests Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ModularSelectModule(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id      = $request->id;
        $Courses = DB::table('courses')
            ->where('id', $id)
            ->first();
        $Modules = DB::table('modules')
            ->where('CID', $Courses->CID)
            ->get();

        $data = [
            'Page'    => 'ModularTests.SelectModule',
            'Title'   => 'Select the module to attach tests to',
            'Desc'    => 'Modular Tests Assessment Settings',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptModuleSelection(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtModularTests', ['id' => $id]);
    }

    public function MgtModularTests($id)
    {
        $Modules = DB::table('modules')
            ->where('id', '=', $id)
            ->first();

        $Courses = DB::table('courses')
            ->where('CID', '=', $Modules->CID)
            ->first();

        // dd($Modules->CID);

        $ModularTests = DB::table('modular_tests')
            ->where('MID', '=', $Modules->MID)
            ->get();

        $rem = ['id', 'created_at', 'status', 'Active', 'converted', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();

        $data = [
            'Page'         => 'ModularTests.MgtModularTests',
            'Title'        =>
            'Manage Modular Test questions attached to the selected course module',
            'Desc'         => $Modules->Module,
            'ModularTests' => $ModularTests,
            'CourseName'   => $Courses->CourseName,
            'Module'       => $Modules->Module,
            'CID'          => $Courses->CID,
            'MID'          => $Modules->MID,
            'rem'          => $rem,
            'Form'         => $FormEngine->Form('modular_tests'),
        ];

        return view('scrn', $data);
    }

}
