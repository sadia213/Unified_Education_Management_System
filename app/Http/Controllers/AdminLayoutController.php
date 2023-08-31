<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminLayoutController extends Controller
{
    public function dashboard()
    {
        $pending_users = User::where('status', '=', 0)->get();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.dashboard', compact('pending_users', 'pend_users'));
    }
    public function tables()
    {
        return view('admin.pages.tables');
    }
    public function getTeachers($department_id)
    {
        $users = DB::table('users')
            ->where('department_id', '=', $department_id)
            ->where('role', 'teacher')
            ->where('status', 1)
            ->get();
        return response()->json([
            'users' => $users
        ]);
    }
}
