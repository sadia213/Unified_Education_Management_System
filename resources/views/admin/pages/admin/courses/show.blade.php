@extends('admin.layouts.two_col')
@section('title','Show a Course')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            Show <a class="btn btn-info mx-2" href="{{ url('admin/courses/index') }}">List</a>
        </div>
        <div class="card-body mt-3">
            <table class="table table-striped ">
                <tr>
                    <th scope="row">Department Name</th>
                    <td>
                    {{$course->department->dept_name}}
                    </td>
                    
                </tr>
                <tr>
                    <th scope="row">Course Code</th>
                    <td>{{ $course->course_code }}</td>
                </tr>
                <tr>
                    <th scope="row">Course Name</th>
                    <td>{{ $course->course_name }}</td>
                    
                </tr>
                <tr>
                    <th scope="row">Course Short Name</th>
                    <td>{{ $course->short_name }}</td>
                    
                </tr>
                <tr>
                    <th scope="row">Course Credit</th>
                    <td>{{ $course->credit }}</td>
                    
                </tr>
                <tr>
                    <th scope="row">Course Type</th>
                    <td>{{ $course->type }}</td>
                    
                </tr>
            </table>


        </div>
    </div>
</div>


@endsection