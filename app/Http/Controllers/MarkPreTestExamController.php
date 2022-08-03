<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MarkPreTestExamController extends Controller
{
    public function SelectCourseToMarkPreTest()
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'MarkPretest.SelectPreTest',
            'Title'   => 'Select course  whose students are to be marked',
            'Desc'    => 'Pre-Test Marking',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptMarkPreTest(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',
        ]);

        $id = $request->id;

        return redirect()->route('MarkPreTestTestNow', ['id' => $id]);

    }

    public function MarkPreTestTestNow($id)
    {
        $Course = DB::table('courses')->where('id', '=', $id)->first();

        $Results = DB::table('attempt_pre_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.StudentID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->where('C.id', $id)
            ->where('P.Marked', 'false')
            ->join('pre_tests AS T', 'T.uuid', 'P.PretestID')
            ->select('T.PreTestTitle', 'T.BriefDescription', 'S.*', 'T.TestQuestion AS PreTestQuestion', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID', 'P.Score', 'P.created_at')
            ->get();

        $Marked = DB::table('attempt_pre_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.StudentID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->where('C.id', $id)
            ->where('P.Marked', 'true')
            ->join('pre_tests AS T', 'T.uuid', 'P.PretestID')
            ->select('T.PreTestTitle', 'T.BriefDescription', 'S.*', 'T.TestQuestion AS PreTestQuestion', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID', 'P.Score', 'P.created_at')
            ->get();

        $Guides = DB::table('courses AS C')
            ->where('C.id', $id)
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('marking_guides AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'       => 'MarkPretest.MarkPreTest',
            'Title'      => 'Mark all students who attempted the pre test  for the course ' . $Course->CourseName,
            'Desc'       => 'Pre-Test  Marking',
            'PreTests'   => $Results,
            'CourseName' => $Course->CourseName,
            'Guides'     => $Guides,
            'Marked'     => $Marked,

            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    } //
}
