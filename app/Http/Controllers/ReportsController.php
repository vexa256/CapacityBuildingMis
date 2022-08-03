<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\FormEngine;

class ReportsController extends Controller
{
    public function StudentDatabase(Type $var = null)
    {
        $Coordinators = DB::table('cordinators')->get();
        // dd($Coordinators);
        $Apps = DB::table('students AS S')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->where('U.role', 'student')
            ->select(
                'C.CourseName',
                'U.*',
                'C.CourseDescription',
                'S.*',
                'S.id AS ID',
                'U.id AS Uid'
            )
            ->get();

        $data = [
            'Page'         => 'reports.Students',
            'Title'        => 'SRL E-learning Student Database',
            'Desc'         => 'Enrolled Students | Approved Students Only',
            'Apps'         => $Apps,
            'Coordinators' => $Coordinators,
        ];

        return view('scrn', $data);
    }

    public function CourseEnrollment()
    {
        $CourseEnrollment = DB::table('courses AS C')
            ->join('students AS S', 'C.CID', 'S.CID')
            ->groupBy('C.CourseName')
            ->selectRaw('count(S.Name) as Students , C.CourseName')->get();

        $data = [
            'Page'  => 'reports.Enrollment',
            'Title' => 'SRL E-learning Course Enrollment',
            'Desc'  => 'Course Enrollment Statistics',
            'Apps'  => $CourseEnrollment,
            // 'CourseEnrollment' => $Coordinators,
        ];

        return view('scrn', $data);
    }

    public function CountryEnrollment()
    {
        $CourseEnrollment = DB::table('courses AS C')
            ->join('students AS S', 'C.CID', 'S.CID')
            ->groupBy('S.nationality')
            ->selectRaw('count(S.id) as Students , S.nationality')->get();

        $data = [
            'Page'  => 'reports.Country',
            'Title' => 'SRL E-learning Course Enrollment by Country',
            'Desc'  => 'Country Enrollment Statistics',
            'Apps'  => $CourseEnrollment,
            // 'CourseEnrollment' => $Coordinators,
        ];

        return view('scrn', $data);
    }

    public function MgtUsers()
    {
        $Users = DB::table('users')
            ->where('email', '!=', 'vexa256@gmail.com')->get();

        $FormEngine = new FormEngine();

        $rem = ['id', 'created_at', 'updated_at', 'ModulePresentation', 'uuid', 'CID', 'AssessmentType', 'institution', 'ApplicationLetter', 'gender',
            'ApprovalStatus', 'phone', 'role', 'address', 'email_verified_at', 'remember_token', 'CID', 'nationality', 'CourseAppliedFor', 'UserID',
        ];

        $data = [
            'Page'  => 'users.MgtUsers',
            'Title' => 'SRL E-learning User Management',
            'Desc'  => 'User Settings',
            'Users' => $Users,
            'rem'   => $rem,
            'Form'  => $FormEngine->Form('users'),
            // 'CourseEnrollment' => $Coordinators,
        ];

        return view('scrn', $data);
    }
}
