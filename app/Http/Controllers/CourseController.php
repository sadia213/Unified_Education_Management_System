<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\AddSession;
use App\Models\Session;
use Illuminate\Support\Facades\DB;
use App\Models\MarksDistribution;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.courses.index', compact('courses', 'pend_users'));
    }

    public function create()
    {
        $departments = Department::latest()->get();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.courses.create', compact('departments', 'pend_users'));
    }

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

    public function show($id)
    {
        $course = Course::find($id);
        $departments = Department::latest()->get();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.courses.show', compact('course', 'departments', 'pend_users'));
    }

    public function edit($id)
    {
        $course = Course::find($id);
        $departments = Department::latest()->get();
        $departmentId = session('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.courses.edit', compact('course', 'departments', 'pend_users'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->update([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'short_name' => $request->short_name,
            'credit' => $request->credit,
            'type' => $request->type,
            'department_id' => $request->department_id,
        ]);
        return redirect('admin/courses/index')->withMessage('Courses updated successfully.');
    }

    public function destroy($id)
    {
        if (Course::find($id)->delete()) {
            return redirect('admin/courses/index');
        }
    }



    public function runningCourses()
    {
        $userDepartmentId = session('user_department_id');
        $sessions = Session::with(['course', 'add_session'])
            ->whereHas('course', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId);
            })
            ->get();
        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);
        $courses = Course::where('department_id', session('user_department_id')) // Filter by department
            ->latest()
            ->get();
        $departmentId = session('user_department_id');
        $user_department_id = session('user_department_id'); // Retrieve the user_department_id from session

        return view('admin.pages.teacher.running_courses', compact('sessions', 'add_sessions',  'courses', 'user_department_id'));
    }

    public function marksDistribute()
    {
        $userDepartmentId = session('user_department_id');
        $sessions = Session::with(['course', 'add_session'])
            ->whereHas('course', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId);
            })
            ->get();
        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);
        $courses = Course::where('department_id', session('user_department_id')) // Filter by department
            ->latest()
            ->get();
        $departmentId = session('user_department_id');
        $user_department_id = session('user_department_id'); // Retrieve the user_department_id from session

        return view('admin.pages.teacher.marks_distribution', compact('sessions', 'add_sessions',  'courses', 'user_department_id'));
    }

    public function marksDistribution(Request $request)
    {
        $courseId = $request->input('course');
        $departmentId = session('user_department_id');
        $categories = $request->input('category');
        $marks = $request->input('marks');

        $sum = 0;
        foreach ($marks as $mark) {
            $sum += $mark;
        }

        if ($sum !== 100) {
            return redirect()->back()->with('err_msg', 'Total marks should be 100.');
        }

        MarksDistribution::where('course_id', $courseId)->delete();

        foreach ($categories as $key => $category) {
            MarksDistribution::create([
                'course_id' => $courseId,
                'department_id' => $departmentId,
                'category_name' => $category,
                'marks' => $marks[$key],
            ]);
        }

        return redirect('teacher/marks-distribution')->withMessage('Successfully inserted.');
    }


    public function distributedCourse($course_id)
    {
        $courses = DB::table('sessions')
            ->join('courses', 'sessions.course_id', '=', 'courses.id')
            ->join('departments', 'courses.department_id', '=', 'departments.id')
            ->where('sessions.course_id', '=', $course_id)
            ->select('courses.*', 'sessions.section')
            ->get();
        return response()->json([
            'distributed_courses' => $courses
        ]);
    }
}
