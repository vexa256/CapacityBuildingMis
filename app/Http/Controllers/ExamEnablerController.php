<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ExamEnablerController extends Controller
{

    public function EnablePostTestSelectCourse()
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'EnableExams.SelectPostTest',
            'Title'   => 'Select course whose Post Tests are required',
            'Desc'    => 'Enable Course Post Test',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptEnablePostTestSelectCourse(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        // dd($id);

        return redirect()->route('EnablePostTest', ['id' => $id]);

    }

    public function EnablePostTest($id)
    {

        // dd($id);

        $Tests = DB::table('post_tests AS P')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->where('C.id', $id)
            ->select('P.*', 'C.CourseName')
            ->get();

        $Course = DB::table('courses')->where('id', $id)->first();

        $data = [
            'Page'   => 'EnableExams.PostTests',
            'Title'  => 'Enable/Disable Post Tests for the Course ' . $Course->CourseName,
            'Desc'   => 'Manage Post Test Activation',
            'Course' => $Course,
            'Tests'  => $Tests,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function ActivateSelectedTest($id, $TableName)
    {

        DB::table($TableName)->where('id', $id)->update([

            'Active' => 'true',

        ]);

        return redirect()
            ->back()
            ->with('status', 'The test has been activated successfully');
    }

    public function DeActivateSelectedTest($id, $TableName)
    {

        DB::table($TableName)->where('id', $id)->update([

            'Active' => 'false',

        ]);

        return redirect()
            ->back()
            ->with('status', 'The test has been deactivated successfully');
    }

    public function SelectModularTestActivate()
    {
        $Modules = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
        // ->where('M.CID', $CID)
            ->select('C.CourseName', 'M.*')
            ->get();

        $data = [
            'Page'    => 'EnableExams.SelectModularTest',
            'Title'   => 'Enable/Disable Modular Tests For The Selected Course  and Module',
            'Desc'    => 'Manage Modular Test Activation',
            'Modules' => $Modules,
            // 'Tests'   => $Tests,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptModularEnable(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        // dd($id);

        return redirect()->route('ModularTestActivation', ['id' => $id]);

    }

    public function ModularTestActivation($id)
    {

        // dd($id);

        $Tests = DB::table('modular_tests AS P')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.id', $id)
            ->select('P.*', 'C.CourseName', 'M.Module')
            ->get();

        $Module = DB::table('modules')->where('id', $id)->first();

        $Course = DB::table('courses')->where('CID', $Module->CID)->first();

        $data = [
            'Page'  => 'EnableExams.EnableModular',
            'Title' => 'Enable/Disable Modular Tests for the Course ' . $Course->CourseName,
            'Desc'  => 'Module : ' . $Module->Module,
            // 'Course' => $Course,
            'Tests' => $Tests,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function SelectPracticalTestActivate()
    {
        $Modules = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
        // ->where('M.CID', $CID)
            ->select('C.CourseName', 'M.*')
            ->get();

        $data = [
            'Page'    => 'EnableExams.SelectPracticalEnable',
            'Title'   => 'Enable/Disable Practical Tests For The Selected Course  and Module',
            'Desc'    => 'Manage Practical Test Activation',
            'Modules' => $Modules,
            // 'Tests'   => $Tests,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptPracticalEnable(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        // dd($id);

        return redirect()->route('PracticalTestActivation', ['id' => $id]);

    }

    public function PracticalTestActivation($id)
    {

        // dd($id);

        $Tests = DB::table('practical_tests AS P')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.id', $id)
            ->select('P.*', 'C.CourseName', 'M.Module')
            ->get();

        $Module = DB::table('modules')->where('id', $id)->first();

        $Course = DB::table('courses')->where('CID', $Module->CID)->first();

        $data = [
            'Page'  => 'EnableExams.EnablePractical',
            'Title' => 'Enable/Disable Practical Tests for the Course ' . $Course->CourseName,
            'Desc'  => 'Module : ' . $Module->Module,
            // 'Course' => $Course,
            'Tests' => $Tests,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

}
