<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use App\Models\Course;
use App\Models\AddSession;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $userDepartmentId = session('user_department_id');

        $sessions = Session::with(['course', 'teacher'])
            ->whereHas('course', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId);
            })
            ->get();

        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();

        return view('admin.pages.admin.sessions.index', compact('sessions', 'pend_users'));
    }

    public function create()
    {
        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);
        $users = User::where('role', 'teacher')
            ->where('status', 1)
            ->where('department_id', session('user_department_id')) // Filter by department
            ->get(['id', 'first_name', 'last_name']);
        $courses = Course::where('department_id', session('user_department_id')) // Filter by department
            ->latest()
            ->get();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        $user_department_id = session('user_department_id'); // Retrieve the user_department_id from session

        return view('admin.pages.admin.sessions.create', compact('add_sessions', 'users', 'courses', 'pend_users', 'user_department_id'));
    }

    public function store(Request $request)
    {

        $adminDepartmentId = session('user_department_id');

        Session::create([
            'add_session_id' => $request->add_session_id,
            'section' => $request->section,
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'department_id' => $adminDepartmentId, // Set the department_id to admin's department
        ]);
        return redirect('admin/assigned_courses/index')->withMessage('Session added successfully.');
    }

    public function show($id)
    {
        $userDepartmentId = session('user_department_id');
        $sessions = Session::with(['course', 'teacher', 'add_session'])
            ->whereHas('course', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId);
            })
            ->find($id);
        $users = User::where('role', 'teacher')
            ->where('status', 1)
            ->where('department_id', $userDepartmentId) // Filter by department
            ->get(['id', 'first_name', 'last_name']);
        $courses = Course::where('department_id', $userDepartmentId) // Filter by department
            ->latest()
            ->get();

        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();

        return view('admin.pages.admin.sessions.show', compact('sessions', 'users', 'courses', 'pend_users'));
    }

    public function edit($id)
    {

        $session = Session::find($id);
        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);
        $users = User::where('role', 'teacher')
            ->where('status', 1)
            ->where('department_id', session('user_department_id')) // Filter by department
            ->get(['id', 'first_name', 'last_name']);
        $courses = Course::where('department_id', session('user_department_id')) // Filter by department
            ->latest()
            ->get();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        $user_department_id = session('user_department_id'); // Retrieve the user_department_id from session
        return view('admin.pages.admin.sessions.edit', compact('session', 'add_sessions', 'users', 'courses', 'pend_users', 'user_department_id'));
    }

    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        $course = Course::find($id);

        $session->update([
            'session' => $request->session,
            'section' => $request->section,
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
        ]);
        return redirect('admin/assigned_courses/index')->withMessage('Session updated successfully.');
    }

    public function destroy($id)
    {
        if (Session::find($id)->delete()) {
            return redirect('admin/assigned_courses/index');
        }
    }

    public function sessionIndex()
    {

        $add_sessions = AddSession::all();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.add_sessions.index', compact('add_sessions', 'pend_users'));
    }

    public function sessionCreate()
    {


        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.add_sessions.create', compact('pend_users'));
    }

    public function sessionStore(Request $request)
    {

        AddSession::create([
            'session' => $request->session,
        ]);
        return redirect('admin/add_sessions/index')->withMessage('Session added successfully.');
    }
    public function sessionDestroy($id)
    {
        if (AddSession::find($id)->delete()) {
            return redirect('admin/add_sessions/index');
        }
    }


    public function SessionActive($id)
    {
        AddSession::findOrFail($id)->update(['status' => 1]);
        return redirect('admin/add_sessions/index')->withMessage('Session Successfully Activated');
    }
    public function SessionInActive($id)
    {
        AddSession::findOrFail($id)->update(['status' => 0]);
        return redirect('admin/add_sessions/index')->withMessage('Session Successfully Deactivated');
    }
}
