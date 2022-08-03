<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MarkPostExamController extends Controller
{
    public function SelectCourseToMark()
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'Mark.SelectPost',
            'Title'   => 'Select course  whose students are to be marked',
            'Desc'    => 'Post Test Student Marking',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptMarkPost(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',
        ]);

        $id = $request->id;

        return redirect()->route('MarkPostTestNow', ['id' => $id]);

    }

    public function MarkPostTestNow($id)
    {
        $Course = DB::table('courses')->where('id', '=', $id)->first();

        $Results = DB::table('attempt_post_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.UserID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->where('C.id', $id)
            ->where('P.Marked', 'false')
            ->join('post_tests AS T', 'T.uuid', 'P.PostTestUuid')
            ->select('T.PostTestTitle', 'T.BriefDescription', 'S.*', 'P.PostQuestion', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID')
            ->get();

        $Marked = DB::table('attempt_post_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.UserID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->where('C.id', $id)
            ->where('P.Marked', 'true')
            ->join('post_tests AS T', 'T.uuid', 'P.PostTestUuid')
            ->select('T.PostTestTitle', 'T.BriefDescription', 'S.*', 'P.PostQuestion', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID', 'P.Score', 'P.created_at')
            ->get();

        $Guides = DB::table('courses AS C')
            ->where('C.id', $id)
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('marking_guides AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'       => 'Mark.MarkPost',
            'Title'      => 'Mark all students who attempted the post test for the course ' . $Course->CourseName,
            'Desc'       => 'Post Test Marking',
            'PostTests'  => $Results,
            'CourseName' => $Course->CourseName,
            'Guides'     => $Guides,
            'Marked'     => $Marked,

            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }
}
