<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Controllers\SystemController;
use Auth;
use DB;
use \Carbon\Carbon;

class SystemController extends Controller
{
    // protected $property;

    public function __construct()
    {
        $counter = DB::table('course_links')->where('status', 'active')->count();

        if ($counter > 0) {

            $update = DB::table('course_links')->where('status', 'active')->get();

            foreach ($update as $data) {

                if (Carbon::createFromFormat('Y-m-d', $data->ValidTo)->isPast()) {

                    DB::table('course_links')->where('id', $data->id)->update([

                        'status' => 'false',

                    ]);

                }

            }
        }
    }

    public function LoadPretestExam(Type $var = null)
    {

        $Timer = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('pre_tests AS P', 'P.CID', 'S.CID')
            ->select('P.*')
            ->first();

        $Apps = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('pre_tests AS P', 'P.CID', 'S.CID')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->select(
                'P.*',
                'U.name',
                'S.Name',
                'S.ParentOrganization',
                'S.Email',
                'S.Nationality',
                'C.CourseName'
            )
            ->limit(1)
            ->get();

        $data = [
            'Page'    => 'public.AttemptPreTest',
            'Title'   => 'Pre-Test Assessment, Your Application Was Approved',
            'Desc'    => ' Attempt Pre-Test Assessment To Proceed',
            'Apps'    => $Apps,
            'Pretest' => 'true',
            'rem'     => ['test'],
            'Form'    => $Timer,
            'Timer'   => "10",
        ];

        return view('scrn', $data);
    }}
