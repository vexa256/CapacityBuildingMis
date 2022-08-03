<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MarkModularTestController extends Controller
{
    public function SelectCourseToMarkModular()
    {
        $Courses = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->select('M.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'    => 'MarkModular.SelectModular',
            'Title'   => 'Select course and module  whose students are to be marked',
            'Desc'    => 'Modular Test Student Marking',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptMarkModular(Request $request)
    {

        $validated = $request->validate([
            '*' => 'required',
        ]);

        $id = $request->id;

        return redirect()->route('MarkModularTestNow', ['id' => $id]);

    }

    public function MarkModularTestNow($id)
    {
        $Course = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.*', 'C.*')
            ->where('M.id', $id)->first();
        $CID = $Course->CID;

        $Results = DB::table('attempt_modular_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.UserID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.id', $id)
            ->where('P.Marked', 'false')
            ->join('modular_tests AS T', 'T.uuid', 'P.ModularTestUuid')
            ->select('T.ModularTestTitle', 'T.BriefDescription', 'S.*', 'P.ModularQuestion', 'M.Module', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID')
            ->get();

        $Marked = DB::table('attempt_modular_tests AS P')
            ->join('students AS S', 'S.uuid', 'P.UserID')
            ->join('courses AS C', 'C.CID', 'P.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.id', $id)
            ->where('P.Marked', 'true')
            ->join('modular_tests AS T', 'T.uuid', 'P.ModularTestUuid')
            ->select('T.ModularTestTitle', 'T.BriefDescription', 'S.*', 'P.ModularQuestion', 'M.Module', 'P.StudentAnswer', 'C.CourseName', 'P.id AS SelectedExamID', 'P.Score', 'P.created_at')
            ->get();
        $Guides = DB::table('courses AS C')
            ->where('C.CID', $CID)
        // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('marking_guides AS G', 'G.CID', 'C.CID')
            ->select('G.*', 'C.CourseName')
            ->get();

        $data = [
            'Page'         => 'MarkModular.MarkModular',
            'Title'        => 'Mark all students who attempted the modular test for the course ' . $Course->CourseName,
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
