<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Department;
use Excel;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function pendingUsers()
    {
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.super_admin.pending_users', compact('pending_users'));
    }
    public function approveUser($id)
    {
        User::where('id', $id)
            ->update(['status' => true]);
        return redirect()->back();
    }


    public function pendUsers(Request $request)
    {
        // Get the authenticated user
        $departmentId = Session::get('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();

        return view('admin.pages.admin.pending_users', compact('pend_users'));
    }

    public function appUser($id)
    {
        User::where('id', $id)
            ->update(['status' => true]);
        return redirect()->back();
    }


    public function exportUser()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function importUser(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file'));
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.import_users', compact('pending_users'));
    }
    public function import()
    {
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.import_users', compact('pending_users'));
    }

    public function teacherIndex()
    {
        $users = User::where('role', 'teacher')->where('department_id', 2)->get(['id', 'first_name', 'last_name']);
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.admin.admin_user', compact('users', 'departments', 'pending_users'));
    }


  
}
