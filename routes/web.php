<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLayoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login']);
Route::post('/user/login', [AuthController::class, 'userLogin']);

Route::get('/teacher/register', [AuthController::class, 'teacherRegister']);
Route::post('/teacher/registration', [AuthController::class, 'registrationTeacher']);

Route::get('/student/register', [AuthController::class, 'studentRegister']);
Route::post('/student/registration', [AuthController::class, 'registrationStudent']);

Route::middleware(['checkLogin'])->group(function () {
    Route::get('/dashboard', [AdminLayoutController::class, 'dashboard']);
    Route::get('/tables', [AdminLayoutController::class, 'tables']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::middleware(['checkIfSuperAdmin'])->group(function () {

        Route::get('super-admin/pending-users', [UserController::class, 'pendingUsers']);
        Route::get('super-admin/approve-user/{userid}', [UserController::class, 'approveUser']);
        Route::get('super-admin/studentCreate', [AuthController::class, 'studentCreate']);
        Route::post('super-admin/createStudent', [AuthController::class, 'createStudent']);
        Route::get('super-admin/adminCreate', [AuthController::class, 'adminCreate']);
        Route::post('super-admin/createAdmin/{userId}', [AuthController::class, 'createAdmin'])->name('createAdmin');
        Route::get('super-admin/teacherCreate', [AuthController::class, 'teacherCreate']);
        Route::post('super-admin/createTeacher', [AuthController::class, 'createTeacher']);
        Route::get('super-admin/dept', [DepartmentController::class, 'dept']);
        Route::post('super-admin/createDept', [DepartmentController::class, 'createDept']);
    });

    Route::middleware(['checkIfAdmin'])->group(function () {
        Route::get('admin/pending-users', [UserController::class, 'pendUsers']);
        Route::get('admin/approve-user/{userid}', [UserController::class, 'appUser']);

        Route::get('admin/import-users', [UserController::class, 'import']);
        Route::get('admin/export-user', [UserController::class, 'exportUser'])->name('export-user');
        Route::post('admin/import-user', [UserController::class, 'importUser'])->name('import-user');

        Route::get('admin/adminUser', [AuthController::class, 'adminUser']);
        Route::post('admin/userAdmin', [AuthController::class, 'userAdmin']);
        Route::get('admin/signupTeacher', [AuthController::class, 'signupTeacher']);
        Route::post('admin/teacherSignup', [AuthController::class, 'teacherSignup']);
        Route::get('admin/studentSignup', [AuthController::class, 'studentSignup']);
        Route::post('admin/signupStudent', [AuthController::class, 'signupStudent']);

        Route::get('admin/courses/index', [CourseController::class, 'index']);
        Route::get('admin/courses/create', [CourseController::class, 'create']);
        Route::post('admin/courses/store', [CourseController::class, 'store']);
        Route::get('admin/courses/edit/{id}', [CourseController::class, 'edit']);
        Route::post('admin/courses/update/{id}', [CourseController::class, 'update']);
        Route::get('admin/courses/delete/{id}', [CourseController::class, 'destroy']);
        Route::get('admin/courses/show/{id}', [CourseController::class, 'show']);

        Route::get('admin/assigned_courses/index', [SessionController::class, 'index']);
        Route::get('admin/assigned_courses/create', [SessionController::class, 'create']);
        Route::post('admin/assigned_courses/store', [SessionController::class, 'store']);
        Route::get('admin/assigned_courses/show/{id}', [SessionController::class, 'show']);
        Route::get('admin/assigned_courses/edit/{id}', [SessionController::class, 'edit']);
        Route::post('admin/assigned_courses/update/{id}', [SessionController::class, 'update']);
        Route::get('admin/assigned_courses/delete/{id}', [SessionController::class, 'destroy']);

        Route::get('admin/add_sessions/index', [SessionController::class, 'sessionIndex']);
        Route::get('admin/add_sessions/create', [SessionController::class, 'sessionCreate']);
        Route::post('admin/add_sessions/store', [SessionController::class, 'sessionStore']);
        Route::get('admin/add_sessions/delete/{id}', [SessionController::class, 'sessionDestroy']);
        Route::get('add_session/active/{id}', [SessionController::class, 'SessionInactive'])->name('session.inactive');
        Route::get('add_session/inactive/{id}', [SessionController::class, 'SessionActive'])->name('session.active');
    });
    Route::middleware(['checkIfStudent'])->group(function () {
        Route::get('student/enroll/create', [StudentController::class, 'enroll']);
        Route::get('student/enroll/index', [StudentController::class, 'enrollIndex']);
        Route::post('student/enroll/post', [StudentController::class, 'postEnroll']);
        
        Route::get('student/project/index', [ProjectController::class, 'index']);
        Route::get('student/project/create', [ProjectController::class, 'create']);
        Route::post('student/project/store', [ProjectController::class, 'store']);
        
    });
    Route::middleware(['checkIfTeacher'])->group(function (){
        Route::get('teacher/running-courses', [CourseController::class, 'runningCourses']);

        Route::get('teacher/marks-distribution', [CourseController::class, 'marksDistribute']);
        Route::post('teacher/marks-distribute', [CourseController::class, 'marksDistribution']);
        
        Route::get('teacher/distributed-course/{id}', [CourseController::class, 'distributedCourse']);

        Route::get('teacher/assign-marks', [CourseController::class, 'assignMarks']);
       
        
    });
});
