<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MarkPracticalTestController extends Controller
{
    public function SelectCourseToMarkPractical()
    {
        $Courses = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->select('M.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'    => 'MarkPractical.SelectPractical',
            'Title'   => 'Select course and module  whose students are to be marked',
            'Desc'    => 'Practical Test Student Marking',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptMarkPractical(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',
        ]);

        $id = $request->id;

        return redirect()->route('MarkPracticalTestNow', ['id' => $id]);

    }

    public function MarkPracticalTestNow($id)
    {
        $Course = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.*', 'C.*')
            ->where('M.id', $id)->first();
        $CID = $Course->CID;

        $Results = DB::table('attempt_practical_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.UserID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.id', $id)
            ->where('P.Marked', 'false')
            ->join('practical_tests AS T', 'T.uuid', 'P.PracticalTestUuid')
            ->select('T.PracticalTestTitle', 'T.BriefDescription', 'S.*', 'P.PracticalQuestion', 'M.Module', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID')
            ->get();

        $Marked = DB::table('attempt_practical_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.UserID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.id', $id)
            ->where('P.Marked', 'true')
            ->join('practical_tests AS T', 'T.uuid', 'P.PracticalTestUuid')
            ->select('T.PracticalTestTitle', 'T.BriefDescription', 'S.*', 'P.PracticalQuestion', 'M.Module', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID', 'P.Score', 'P.created_at')
            ->get();
        $Guides = DB::table('courses AS C')
            ->where('C.CID', $CID)
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('marking_guides AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'         => 'MarkPractical.MarkPractical',
            'Title'        => 'Mark all students who attempted the practical test for the course ' . $Course->CourseName,
            'Desc'         => $Course->Module,
            'ModularTests' => $Results,
            'CourseName'   => $Course->CourseName,
            'Guides'       => $Guides,
            'Marked'       => $Marked,
            'Module'       => $Course->Module,

            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }
}
