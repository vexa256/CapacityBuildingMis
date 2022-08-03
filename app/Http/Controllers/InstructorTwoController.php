<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;

class InstructorTwoController extends Controller
{
    public function FacilitatorCheckList()
    {
        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'IID',
            'url',
            'Checklist',
        ];

        $FormEngine = new FormEngine();

        $Checklist = DB::table('facili_tator_check_lists AS F')
            ->join('users AS U', 'U.UserID', 'F.UserID')
            ->join('modules AS M', 'M.MID', 'F.MID')
            ->join('courses AS C', 'C.CID', 'F.CID')
            ->where('F.UserID', \Auth::user()->UserID)
            ->select('F.*', 'M.Module', 'C.CourseName', 'U.name', 'U.email')
            ->get();

        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.*', 'C.CourseName')
            ->get();
        $Courses = DB::table('courses')->get();

        //  dd($Details->MID);

        $data = [
            'Page'      => 'checklist.MgtChecklist',
            'Title'     => 'Submit your facilitator checklist for a given course module',
            'Desc'      => 'facilitator checklist',
            'rem'       => $rem,
            'Checklist' => $Checklist,
            'Courses'   => $Courses,
            'Modules'   => $Modules,
            'Form'      => $FormEngine->Form('facili_tator_check_lists'),
        ];

        return view('scrn', $data);
    }
}
