@extends('admin.layouts.two_col')
@section('title','Show a Session')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            Show <a class="btn btn-info mx-2" href="{{ url('admin/assigned_courses/index') }}">List</a>
        </div>
        <div class="card-body mt-3">
            <table class="table table-striped">
                <tr>
                    <th scope="row">Session</th>
                    <td>
                        {{ $sessions->add_session->session }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Teacher's Name</th>
                    <td>{{ $sessions->teacher->first_name }} {{ $sessions->teacher->last_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Section</th>
                    <td>{{ $sessions->section }}</td>
                </tr>
                <tr>
                    <th scope="row">Course Code</th>
                    <td>{{ $sessions->course->course_code }}</td>
                </tr>
                <tr>
                    <th scope="row">Course Title</th>
                    <td>{{ $sessions->course->course_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Course Short Name</th>
                    <td>{{ $sessions->course->short_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Course Credit</th>
                    <td>{{ $sessions->course->credit }}</td>
                </tr>
                <tr>
                    <th scope="row">Course Type</th>
                    <td>{{ $sessions->course->type }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection