<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;
use Auth;

class AdminStatsController extends Controller
{
    public function AdminStats()
    {

        $TotalCourses  = DB::table('courses')->count();
        $TotalStudents = DB::table('users')
            ->where('role', 'student')
            ->count();
        $TotalInstructors   = DB::table('instructors')->count();
        $TotalCourseModules = DB::table('modules')->count();

        $Countries = DB::table('students')
            ->distinct('nationality')
            ->count('nationality');

        $Admins = DB::table('users')->where('role', 'admin')->count();

        $PostTests      = DB::table('post_tests')->count();
        $PreTests       = DB::table('pre_tests')->count();
        $ModularTests   = DB::table('modular_tests')->count();
        $PracticalTests = DB::table('practical_tests')->count();
        $Users          = DB::table('users')->count();
        $Certified      = DB::table('certificates_issueds')->count();

        $data = [
            //"Page" => "users.MgtUsers",
            'Page'               => 'admin.Stats',
            'Title'              =>
            'SRL Uganda E-learning | Admin Dashboard and Stats',
            'Desc'               => Auth::user()->name,
            'PostTests'          => $PostTests,
            'Certified'          => $Certified,
            'Users'              => $Users,
            'PreTests'           => $PreTests,
            'ModularTests'       => $ModularTests,
            'PracticalTests'     => $PracticalTests,
            'Admins'             => $Admins,
            // 'TotalModules'       => $Admins,
            'Countries'          => $Countries,
            'TotalInstructors'   => $TotalInstructors,
            'TotalCourses'       => $TotalCourses,
            'TotalStudents'      => $TotalStudents,
            'TotalCourses'       => $TotalCourses,
            'TotalCourseModules' => $TotalCourseModules,

        ];

        return view('scrn', $data);
    }

}
