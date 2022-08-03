<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function SelectCourseAttend()
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page'    => 'attendance.SelectCourseAttend',
            'Title'   => 'Select Course Whose Students are Required',
            'Desc'    => 'Module Attendance Marking',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCourseAttend(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            // 'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('SelectStudentAttend', ['id' => $id]);
    }

    public function SelectStudentAttend($id)
    {
        $Counter = DB::table('courses')->where('id', $id)->count();

        if ($Counter < 1) {

            return redirect()->back()->with('error_a', 'Query returned an empty record set. Try again');

        }
        $Course = DB::table('courses')->where('id', $id)->first();

        $CID = $Course->CID;

        $Students = DB::table('students')->where('CID', $CID)->get();

        // $Courses = DB::table('courses')->get();

        $data = [
            'Page'     => 'attendance.SelectStudentAttend',
            'Title'    => 'Select Student For Modular Attendance Marking',
            'Desc'     => 'Student Attendance Marking',
            'Students' => $Students,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function AcceptMarkStudentAttendance(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            // 'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MarkStudentAttendance', ['id' => $id]);
    }

    public function MarkStudentAttendance($id)
    {
        $Students = DB::table('students')->where('id', $id)->first();

        $CID = $Students->CID;

        $Course = DB::table('courses')->where('CID', $CID)->first();

        $Mods = DB::table('modules')->where('CID', $CID)->get();

        $Modules = DB::table('modules AS M')
            ->join('student_attendances AS A', 'A.MID', 'M.MID')
            ->where('A.UserID', $Students->uuid)
            ->where('M.CID', $CID)
            ->where('A.status', 'true')
            ->select('M.Module', 'A.*')
            ->get();

        $data = [
            'Page'       => 'attendance.MarkStudentAttendance',
            'Title'      => 'Mark Module Attendance For the Student ' . $Students->Name,
            'Desc'       => 'Student Attendance Marking',
            'Students'   => $Students,
            'Name'       => $Students->Name,
            'CourseName' => $Course->CourseName,
            'Modules'    => $Modules,
            'id'         => $id,
            'CID'        => $CID,
            'Mods'       => $Mods,
            'UserID'     => $Students->uuid,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

    public function StudentAttendance()
    {

        $UserID = Auth::user()->UserID;
        $CID    = Auth::user()->CID;

        $Students = DB::table('students')->where('uuid', $UserID)->first();

        $Course = DB::table('courses')->where('CID', $CID)->first();

        $Mods = DB::table('modules')->where('CID', $CID)->get();

        $Modules = DB::table('modules AS M')
            ->join('student_attendances AS A', 'A.MID', 'M.MID')
            ->where('A.UserID', $UserID)
            ->where('M.CID', $CID)
            ->where('A.status', 'true')
            ->select('M.Module', 'A.*')
            ->get();
        $data = [
            'Page'       => 'attendance.StudentAttendance',
            'Title'      => Auth::user()->name . ' This is your module attendance Record',
            'Desc'       => 'All modules have to be attended for certification',
            'Students'   => $Students,
            'Name'       => $Students->Name,
            'CourseName' => $Course->CourseName,
            'Modules'    => $Modules,
            // 'id'         => $id,
            'CID'        => $CID,
            'Mods'       => $Mods,
            'UserID'     => $Students->uuid,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);

    }

}