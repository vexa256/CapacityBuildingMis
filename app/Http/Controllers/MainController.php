<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SystemController;

#use Illuminate\Http\Request;
use DB;

class MainController extends Controller
{

    public function __construct()
    {
        $SystemController = new SystemController;

        $counter = DB::table('users')->whereNull('UserID')
            ->count();

        if ($counter > 0) {

            // dd('true');

            $up = DB::table('users')->whereNull('UserID')->get();

            foreach ($up as $data) {

                DB::table('users')->where('id', $data->id)->update([
                    "UserID" => md5($data->id . uniqid()),
                ]);

            }
        }
    }

    public function MainConsole(Type $var = null)
    {
        $data = [
            //'Page'  => 'Students.AttemptPretest',
            'Title' => 'Main Students Console',

        ];

        return view('scrn', $data);
    }

}
