<?php

use App\Http\Controllers\AdminLayoutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('users/{id}', [AdminLayoutController::class, 'getTeachers']);
Route::get('enrollment/{id}', [StudentController::class, 'getEnroll']);
Route::get('course-enrollments/{courseId}', [CourseController::class,'getCourseEnrollments']);
