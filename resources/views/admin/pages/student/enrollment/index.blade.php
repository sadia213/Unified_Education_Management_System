@extends('admin.layouts.two_col')
@section('title', '/Enrollment Status')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h1 class="h3 mb-3 mx-3">Enrollment Status</h1>

            <div class="card-header">
                Status <a class="btn btn-info mx-2" href="{{ url('student/enroll/create') }}">Enroll</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive m-3" id="enrollmentTable">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Session</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Section</th>
                            <th scope="col">Assigned Teacher</th>
                        </tr>
                    </thead>
                    <tbody class="my-3">
                        @foreach ($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->session }}</td>
                                <td>{{ $enrollment->course_code }}</td>
                                <td>{{ $enrollment->course_name }}</td>
                                <td>{{ $enrollment->section }}</td>
                                <td>{{ $enrollment->first_name }} {{ $enrollment->last_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
