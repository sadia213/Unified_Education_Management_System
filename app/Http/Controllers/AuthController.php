<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.pages.auth.login');
    }
    public function userLogin(Request $req)
    {
        $email = $req->email;
        $password = md5($req->password);
        $user = User::where('email', '=', $email)
            ->where('password', '=', $password)
            ->first();
        if ($user) {
            if ($user->status == 1) {
                Session::put('user_frame', $user->first_name);
                Session::put('user_lname', $user->last_name);
                Session::put('user_email', $user->email);
                Session::put('user_role', $user->role);
                Session::put('user_department_id', $user->department_id);
                return redirect('/dashboard');
            } else {
                return redirect()->back()->with('error', 'User Not Approved Yet');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid');
        }
    }


    //Super-Admin - Admin, Teacher, Student

    //Super-Admin - Admin
    public function adminCreate()
    {
        $users = User::where('role', 'teacher')->where('status', 1)->get(['id', 'first_name', 'last_name']);
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.super_admin.create_admin', compact('users', 'departments', 'pending_users'));
    }
    public function createAdmin(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);

            if ($user->role === 'Teacher') {
                $user->role = 'Admin';
                $user->save();
                // Return a success response with the message
                return response()->json(['success' => true, 'message' => 'User role updated successfully']);
            } else {
                // Return an error response with the message
                return response()->json(['success' => false, 'message' => 'User role is not "teacher"']);
            }
        } catch (\Exception $e) {
            // Return an error response with the message
            return response()->json(['success' => false, 'message' => 'Error updating user role']);
        }

        // Redirect to the dashboard (you can modify this URL as needed)
        return redirect('/dashboard')->withMessage('Teacher account created successfully.');
    }


    //Super-Admin - Teacher
    public function teacherCreate()
    {
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.super_admin.create_teacher', compact('departments', 'pending_users'));
    }
    public function createTeacher(Request $req)
    {
        if ($req->password == $req->conf_password) {
            // check if the submitted email is already in the users table
            $user_exists = User::where('email', '=', $req->email)->first();
            if ($user_exists) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->password = md5($req->password);
                $user->role = 'Teacher';
                $user->department_id = $req->department;
                $user->status = '1';
                if ($user->save()) {
                    return redirect('/dashboard')->withMessage('Teacher account created successfully.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Password Mismatch');
        }
    }

    //Super-Admin - Student
    public function studentCreate()
    {
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.super_admin.create_student', compact('departments', 'pending_users'));
    }
    public function createStudent(Request $req)
    {
        if ($req->password == $req->conf_password) {
            // check if the submitted email is already in the users table
            $user_exists = User::where('email', '=', $req->email)->first();
            if ($user_exists) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->student_id = $req->roll;
                $user->password = md5($req->password);
                $user->role = 'Student';
                $user->department_id = $req->department;
                $user->status = '1';
                if ($user->save()) {
                    return redirect('/dashboard')->withMessage('Student account created successfully.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Password Mismatch');
        }
    }



    //Admin - Admin, Teacher, Student
    //Admin - Admin
    public function adminUser()
    {
        $departments = Department::latest()->get();
        $user_department_id = session('user_department_id');
        $user_department_name = Department::where('id', $user_department_id)->value('dept_name');
        $users = User::where('role', 'teacher')
            ->where('status', 1)
            ->where('department_id', session('user_department_id')) // Filter by department
            ->get(['id', 'first_name', 'last_name']);
        $departmentId = Session::get('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.admin_user', compact('departments', 'user_department_name', 'users', 'pend_users'));
    }
    public function userAdmin(Request $req)
    {
        $teacherId = $req->input('user_id');
        $teacher = User::find($teacherId);

        if ($teacher) {
            $teacher->role = 'Admin';
            $teacher->save();

            return redirect('/dashboard')
                ->withMessage('Teacher assigned as admin successfully.');
        }

        return redirect('/dashboard')
            ->withMessage('Failed to assign teacher as admin.');
    }


    //Admin - Teacher
    public function signupTeacher()
    {
        $departments = Department::latest()->get();
        $departmentId = Session::get('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.teacher_signup', compact('departments', 'pend_users'));
    }
    public function teacherSignup(Request $req)
    {
        if ($req->password == $req->conf_password) {
            // check if the submitted email is already in the users table
            $user_exists = User::where('email', '=', $req->email)->first();
            if ($user_exists) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->password = md5($req->password);
                $user->role = 'Teacher';
                $user->department_id = $req->department;
                $user->status = '1';
                if ($user->save()) {
                    return redirect('/dashboard')->withMessage('Teacher account created successfully.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Password Mismatch');
        }
    }

    //Admin - Student 
    public function studentSignup()
    {
        $departments = Department::latest()->get();
        $departmentId = Session::get('user_department_id');

        // Get the pending users for the user's department
        $pend_users = User::where('status', 0)
            ->where('department_id', $departmentId)
            ->get();
        return view('admin.pages.admin.student_signup', compact('departments', 'pend_users'));
    }
    public function signupStudent(Request $req)
    {
        if ($req->password == $req->conf_password) {
            // check if the submitted email is already in the users table
            $user_exists = User::where('email', '=', $req->email)->first();
            if ($user_exists) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->student_id = $req->roll;
                $user->password = md5($req->password);
                $user->role = 'Student';
                $user->department_id = $req->department;
                $user->status = '1';
                if ($user->save()) {
                    return redirect('/dashboard')->withMessage('Student account created successfully.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Password Mismatch');
        }
    }



    //Teacher and Student Register
    public function teacherRegister()
    {
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.auth.teacher_register', compact('departments'));
    }
    public function registrationTeacher(Request $req)
    {
        if ($req->password == $req->conf_password) {
            // check if the submitted email is already in the users table
            $user_exists = User::where('email', '=', $req->email)->first();
            if ($user_exists) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->password = md5($req->password);
                $user->role = 'Teacher';
                $user->department_id = $req->department;
                if ($user->save()) {
                    return redirect()->back()->with('success', 'User Registered. Waiting for admin approval.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Password Mismatch');
        }
    }
    public function studentRegister()
    {
        $departments = Department::latest()->get();
        $pending_users = User::where('status', '=', 0)->get();
        return view('admin.pages.auth.student_register', compact('departments'));
    }
    public function registrationStudent(Request $req)
    {
        if ($req->password == $req->conf_password) {
            // check if the submitted email is already in the users table
            $user_exists = User::where('email', '=', $req->email)->first();
            if ($user_exists) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                $user = new User();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->student_id = $req->roll;
                $user->password = md5($req->password);
                $user->role = 'Student';
                $user->department_id = $req->department;
                if ($user->save()) {
                    return redirect()->back()->with('success', 'User Registered. Waiting for admin approval.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Password Mismatch');
        }
    }



    //Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['user_frame', 'user_lname', 'user_email', 'user_role']);
        return redirect('/login');
    }
}
