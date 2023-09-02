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
use App\Models\Enrollment;
use App\Models\AddMark;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departmentId = session('user_department_id');
        $courses = Course::where('department_id', $departmentId)
            ->get();
        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.courses.index', compact('courses', 'pend_users'));
    }

    public function create()
    {
        $departmentId = session('user_department_id');
        $departments = Department::where('id', $departmentId)
            ->get();

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
    public function assignMarks()
    {
        $userDepartmentId = session('user_department_id');

        $sessions = Session::with(['course', 'add_session'])
            ->whereHas('course', function ($query) use ($userDepartmentId) {
                $query->where('department_id', $userDepartmentId);
            })
            ->get();

        $add_sessions = AddSession::where('status', 1)->get(['id', 'session']);

        $courses = Course::where('department_id', session('user_department_id'))
            ->latest()
            ->get();

        // Retrieve students' information for the selected course
        $enrollments = []; // Initialize an array to store student information
        $selectedCourseId = request()->input('course'); // Get the selected course ID from the request

        if ($selectedCourseId) {
            $enrollments = Enrollment::where('course_id', $selectedCourseId)
                ->with('user') // Assuming you have a relationship to the User model
                ->get();
        }
        $categoryNames = MarksDistribution::where('course_id', $selectedCourseId)
            ->distinct('category_name')
            ->pluck('category_name');
        $user_department_id = session('user_department_id');

        return view('admin.pages.teacher.assign_marks', compact('sessions', 'add_sessions', 'courses', 'user_department_id', 'enrollments', 'categoryNames'));
    }

    public function getCourseEnrollments($courseId)
    {
        $enrollments = Enrollment::where('course_id', $courseId)
            ->with('user') // Assuming you have a relationship to the User model
            ->get();

        $categoryNames = MarksDistribution::where('course_id', $courseId)
            ->distinct('category_name')
            ->pluck('category_name');

        $marksData = MarksDistribution::where('course_id', $courseId)
            ->get(['id', 'category_name', 'marks']); // Retrieve marks data using the 'id' column

        return response()->json([
            'students' => $enrollments,
            'categoryNames' => $categoryNames,
            'marksData' => $marksData, // Include marks data in the response
        ]);
    }

    public function marksAssigned(Request $request)
    {
        // Debugging: Check the marks data
        $marksData = $request->input('marks');


        // Validate the form data here
        $request->validate([
            // Define validation rules for your input fields
            // For example:
            'marks.*.*' => 'numeric|nullable', // Adjust this based on your form input fields
        ]);

        // Loop through the validated data and store it in the database
        foreach ($request->input('marks') as $userId => $categoryMarks) {
            foreach ($categoryMarks as $categoryName => $marks) {
                // Create a new MarksDistribution entry
                AddMark::create([
                    'user_id' => $userId,
                    'course_id' => $request->input('course_id'), // Assuming you have a hidden input field for course_id in your form
                    'department_id' => $request->input('department_id'), // Assuming you have a hidden input field for department_id in your form
                    'category_name' => $categoryName,
                    'marks' => $marks,
                ]);
            }
        }

        // Redirect back to the assignMarks page with a success message
        return redirect('teacher/assign-marks')->with('Marks assigned successfully.');
    }


    public function submitMarks(Request $request)
    {
        // Get the flattened marks array
        $marks = collect($request->input('marks'))->flatten(1);

        // Validate the form data here
        $request->validate([
            'marks.*' => 'numeric|nullable', // Adjust this based on your form input fields
        ]);

        // Prepare an array for bulk insertion
        $insertData = [];

        foreach ($marks as $key => $value) {
            // Extract the user ID and category name from the keys
            [$userId, $categoryName] = explode('-', $key);

            $insertData[] = [
                'user_id' => $userId,
                'course_id' => $request->input('course_id'), // Assuming you have a hidden input field for course_id in your form
                'department_id' => $request->input('department_id'), // Assuming you have a hidden input field for department_id in your form
                'category_name' => $categoryName,
                'marks' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Perform bulk insertion to improve efficiency
        AddMark::insert($insertData);

        // Return a success response (you can customize this)
        return response()->json(['message' => 'Marks assigned successfully']);
    }
}
