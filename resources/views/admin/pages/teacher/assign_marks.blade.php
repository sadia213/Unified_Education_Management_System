@extends('admin.layouts.two_col')
@section('title', '/Assign Marks')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h1 class="h3 mb-3 mx-3">Assign Marks</h1>

            <div class="card-header">
                Marking <a class="btn btn-info mx-2" href="{{ url('teacher/marks-distribution') }}">Distribute Marks</a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card-body">
                <form action="{{ url('teacher/assigned-marks') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3">
                        <div class="col-8">
                            <select name="session" id="session" class="form-control mx-3">
                                <option value="">Select Session</option>
                                @foreach ($add_sessions as $s)
                                    <option value="{{ $s->id }}">{{ $s->session }}</option>
                                @endforeach
                            </select>
                            @error('session')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-8">
                            <select name="course" class="form-control mx-3" id="course">
                                <option value="">Select Course</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-8">
                            <table id="teacherassign" class="table table-striped table-bordered m-3" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student's Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="dynamic">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3 mx-3">
                        <button type="submit" name="submit" id="button" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#teacherassign').hide();
            $('#button').hide();
            $("#session").change(function() {
                var add_session_id = $(this).val();
                $("#course").empty();
                if (!add_session_id) {
                    $('#teacherassign').hide();
                    $('#button').hide();
                }
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/enrollment/' + add_session_id,
                    dataType: "json",
                    type: 'GET',
                    success: function(res) {
                        var add_sessions = res.add_sessions;
                        var len = add_sessions.length;
                        var str = '<option value="">Select Course</option>';
                        for (var i = 0; i < len; i++) {
                            str += '<option value="' + add_sessions[i].id + '">' +
                                add_sessions[i].course_name + ' - ' + add_sessions[i].section +
                                '</option>';
                        }
                        $("#course").append(str);
                        $('#teacherassign').hide();
                        $('#button').hide();
                    }
                });
            });
            $("#course").change(function() {
                var courseId = $(this).val();
                if (courseId) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/course-enrollments/' + courseId,
                        dataType: "json",
                        type: 'GET',
                        success: function(res) {
                            console.log(res)
                            var students = res.students; // Access the 'students' array
                            var tableRows = '';
                            students.forEach(function(student) {
                                tableRows += '<tr>' +
                                    '<td>' + student.user.student_id + '</td>' +
                                    // Assuming 'user' relationship on Enrollment model fetches user info
                                    '<td>' + student.user.first_name + ' ' + student
                                    .user.last_name + '</td>' +
                                    '<td></td>' +
                                    '</tr>';
                            });
                            $("#dynamic").html(tableRows);
                            $('#teacherassign').show();
                            $('#button').show();
                        }
                    });
                } else {
                    $('#teacherassign').show();
                    $('#button').hide();
                }
            });
        });
    </script>
@endsection
