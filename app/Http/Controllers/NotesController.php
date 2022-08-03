<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use Auth;
use DB;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function NotesSelectCourse()
    {
        if (Auth::user()->role == 'student') {

            $Courses = DB::table('courses')->where('CID', Auth::user()->CID)->get();
        } else {
            $Courses = DB::table('courses')->get();
        }

        if (Auth::user()->role == 'student') {

            $Title = 'View Notes For the Selected Course';
        } else {
            $Title = 'Select course to attach  notes to';
        }

        $data = [
            'Page'    => 'notes.SelectCourse',
            'Title'   => $Title,
            'Desc'    => 'Course notes ',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCourseNotes(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        $Course = DB::table('courses')->where('id', $id)->first();
        $Course->CID;

        return redirect()->route('NotesModule', ['CID' => $Course->CID]);
    }

    public function NotesModule($CID)
    {
        $Modules = DB::table('courses AS C')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->where('C.CID', $CID)
            ->select('C.CourseName', 'M.*')
            ->get();

        if (Auth::user()->role == 'student') {

            $Title = 'View Notes For the Selected Module';
        } else {
            $Title = 'Select course to attach  notes to';
        }

        $data = [
            'Page'    => 'notes.SelectModule',
            'Title'   => $Title,
            'Desc'    => 'Course notes',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function NotesAcceptModule(Request $request)
    {
        $validated = $request->validate([
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtNotes', ['id' => $id]);
    }

    public function MgtNotes($id)
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

        $FormEngine = new FormEngine;

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'ModulePresentation',
            'uuid',
            'CID',
            'Type',
            'url',
            'MID'];
        $data = [
            'Page'       => 'notes.MgtNotes',
            'Title'      => 'Select course module to attach  notes to',
            'Desc'       => 'Course notes Settings',
            'Modules'    => $Modules,
            "rem"        => $rem,
            "Notes"      => $Notes,
            "Videos"     => $Videos,
            "CID"        => $Details->CID,
            "MID"        => $Details->MID,
            "CourseName" => $Details->CourseName,
            "ModuleName" => $Details->Module,
            "Form"       => $FormEngine->Form('notes'),
        ];

        return view('scrn', $data);
    }

    public function NewDoc(Request $request)
    {

        $request->validate([

            '*'   => 'required',
            'url' => 'required|mimes:pdf,mp4|max:300048',

        ]);

        $fileName = time() . '.' . $request->url->extension();

        $request->url->move(public_path('assets/data'), $fileName);

        DB::table($request->TableName)->insert(
            $request->except([
                '_token',
                'TableName',
                'id',
                'files',
            ])
        );

        DB::table($request->TableName)->where('uuid', $request->uuid)->update([

            'url' => $fileName,
        ]);

        return redirect()->back()->with('status', 'The record was created successfully');
    }

    public function DeleteDoc($id, $TableName)
    {
        $del = DB::table($TableName)->where('id', $id)->first();

        unlink(public_path('assets/data/' . $del->url));

        DB::table($TableName)->where('id', $id)->delete();

        return redirect()->back()->with('status', 'The record was deleted successfully');
    }
}
