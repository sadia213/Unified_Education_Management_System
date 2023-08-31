<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;
use App\Models\Session;
use App\Models\AddSession;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
  

    public function store(Request $request)
    {

        Course::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'short_name' => $request->short_name,
            'credit' => $request->credit,
            'type' => $request->type,
            'department_id' => $request->department_id,
        ]);
        return redirect('admin/courses/index')->withMessage('Courses added successfully.');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.student.project_submission.edit', compact('course', 'departments', 'pending_users'));
    }
    public function enroll()
    {

        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);
        $users = User::where('role', 'teacher')
            ->where('status', 1)
            ->where('department_id', session('user_department_id')) // Filter by department
            ->get(['id', 'first_name', 'last_name']);
        $courses = Course::where('department_id', session('user_department_id')) // Filter by department
            ->latest()
            ->get();

        $user_department_id = session('user_department_id'); // Retrieve the user_department_id from session
        return view('admin.pages.student.enrollment.create', compact('add_sessions', 'users', 'courses', 'user_department_id'));
    }
    public function enrollStore()
    {

        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);
        $users = User::where('role', 'teacher')
            ->where('status', 1)
            ->where('department_id', session('user_department_id')) // Filter by department
            ->get(['id', 'first_name', 'last_name']);
        $courses = Course::where('department_id', session('user_department_id')) // Filter by department
            ->latest()
            ->get();

        $user_department_id = session('user_department_id'); // Retrieve the user_department_id from session
        return view('admin.pages.student.enrollment.index', compact('add_sessions', 'users', 'courses',  'user_department_id'));
    }

    public function getEnroll($add_session_id)
    {
        $courses = DB::table('sessions')
            ->join('courses', 'sessions.course_id', '=', 'courses.id')
            ->join('departments', 'courses.department_id', '=', 'departments.id') // Join with departments table
            ->where('sessions.add_session_id', '=', $add_session_id)
            ->select('courses.*', 'sessions.section')
            ->get();

        return response()->json([
            'add_sessions' => $courses
        ]);
    }

    public function postEnroll(Request $request)
    {
        $data = $request->input('courses');
        $sessionId = $request->input('session'); // Assuming the session ID is submitted

        // Identify user based on session ID (replace this with your actual method)
        $userId = $this->getUserBySession($sessionId); // Implement this method

        if (!$userId) {
            return redirect()->back()->with('error', 'User not identified');
        }

        // Loop through the selected courses and store the enrollment
        foreach ($data as $courseId) {
            Enrollment::create([
                'user_id' => $userId,
                'course_id' => $courseId,
                // You can set other attributes if needed
            ]);
        }

        return redirect()->back()->with('success', 'Enrollment successful');
    }
}
