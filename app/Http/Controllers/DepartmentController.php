<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;
class DepartmentController extends Controller
{
    public function dept()
    {
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.super_admin.create_department',compact('pending_users'));
    }

    public function createDept(Request $req)
    {
        // check if the submitted email is already in the users table
        $user_exists = Department::where('dept_name', '=', $req->dept_name)->first();
        if ($user_exists) {
            return redirect()->back()->with('error', 'Department already exists');
        } else {
            $user = new Department();
            $user->dept_name = $req->dept_name;
            $user->short_name = $req->short_name;
            $user->established = $req->established;
            if ($user->save()) {
                return redirect('/dashboard')->withMessage('Department created successfully.');
            }
        }
    }
}
