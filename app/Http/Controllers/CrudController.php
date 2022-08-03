<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function DeleteData($id, $TableName)
    {
        DB::table($TableName)
            ->where('id', $id)
            ->delete();

        return redirect()
            ->back()
            ->with('status', 'The selected record was deleted successfully');
    }

    public function SaveData($request)
    {
        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );
    }

    public function MassInsert(Request $request)
    {
        if ($request->TableName == 'users') {

            $validated = $request->validate([
                '*'     => 'required',
                'files' => 'nullable',
            ]);

            $password = \Hash::make($request->password);

            $this->SaveData($request);

            DB::table('users')
                ->where('UserID', $request->UserID)
                ->update([
                    'password' => $password,
                ]);

            return redirect()
                ->back()
                ->with('status', 'The new admin account was created successfully');

        }
        if ($request->TableName == 'exam_timer_logics') {

            $validated = $request->validate([
                '*'              => 'required',
                'AssessmentType' => 'required|unique:exam_timer_logics',
                'files'          => 'nullable',
            ]);

            $this->SaveData($request);

            return redirect()
                ->back()
                ->with('status', 'The record was created successfully');

        } elseif ($request->TableName == 'attempt_pre_tests') {

            // dd('true');
            $validated = $request->validate([
                '*'     => 'required',
                'files' => 'nullable',
            ]);

            DB::table($request->TableName)
                ->insert(
                    $request->except(['_token', 'TableName', 'id', 'files'])
                );

            DB::table('users')
                ->where('UserID', Auth::user()->UserID)
                ->update([
                    'role' => 'student',
                ]);

            return redirect()
                ->back()
                ->with('status', 'The record was created successfully');
        } elseif ($request->TableName == 'courses') {
            $validated = $request->validate([
                '*'         => 'required',
                'files'     => 'nullable',
                'Thumbnail' => 'required|mimes:png,svg,jpeg,jpg|max:3048',
            ]);

            $this->SaveData($request);

            $fileName = time() . '.' . $request->Thumbnail->extension();

            $request->Thumbnail->move(public_path('assets/data'), $fileName);

            DB::table($request->TableName)
                ->where('uuid', $request->uuid)
                ->update([
                    'Thumbnail' => $fileName,
                ]);

            return redirect()
                ->back()
                ->with('status', 'The record was created successfully');

        } elseif ($request->TableName == 'modules') {
            $validated = $request->validate([
                '*'                  => 'required',
                'files'              => 'nullable',
                'ModulePresentation' => 'required|mimes:pdf|max:10048',
            ]);

            $this->SaveData($request);

            $fileName = time() . '.' . $request->ModulePresentation->extension();

            $request->ModulePresentation->move(public_path('assets/data'), $fileName);

            DB::table($request->TableName)
                ->where('uuid', $request->uuid)
                ->update([
                    'ModulePresentation' => $fileName,
                ]);

            return redirect()
                ->back()
                ->with('status', 'The record was created successfully');
        } else {
            $validated = $request->validate([
                '*'     => 'required',
                'files' => 'nullable',
            ]);

            $this->SaveData($request);

            return redirect()
                ->back()
                ->with('status', 'The record was created successfully');
        }
    }

    public function MassUpdate(Request $request)
    {
        $validated = $this->validate($request, [
            '*'     => 'required',
            'files' => 'nullable',
        ]);

        DB::table($request->TableName)
            ->where('id', $request->id)

            ->update($request->except(['_token', 'TableName', 'id', 'files']));

        return redirect()
            ->back()
            ->with('status', 'The selected record was updated successfully');
    }
}
