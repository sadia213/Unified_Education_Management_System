@extends('admin.layouts.two_col')
@section('title', '/Assign Courses')
@section('content')
    <h1 class="h3 mb-3 mx-3">Assigning Course</h1>

    <div class="card-header">
        Assign Courses <a class="btn btn-info mx-2" href="{{ url('admin/assigned_courses/index') }}">List</a>
    </div>

    <div class="card-body">
        <form action="{{ url('admin/assigned_courses/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="inputBrandTitle" class="col-sm-3 col-form-label">Session</label>
                <div class="col-8">
                    <select name="add_session_id" id="" class="form-control">
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
                <label for="inputPicture" class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-8">
                    <select name="course_id" class="form-select" id="courseSelect">
                        <option></option>
                        @foreach ($courses as $c)
                            <option value="{{ $c->id }}" data-department="{{ $c->department_id }}"
                                class="course-option">{{ $c->course_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">Section</label>
                <div class="col-8">
                    <select name="section" id="" class="form-control">
                        <option value="">Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                    @error('section')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="inputPicture" class="col-sm-3 col-form-label">Teacher's Name</label>
                <div class="col-8">
                    <select name="user_id" class="form-select">
                        <option></option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->first_name }} {{ $u->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const departmentId = {{ $user_department_id }};
            const coursesSelect = document.querySelector('select[name="course_id"]');
            const usersSelect = document.querySelector('select[name="user_id"]');

            coursesSelect.addEventListener('change', filterUsersByDepartment);

            function filterUsersByDepartment() {
                const selectedCourseId = coursesSelect.value;
                const filteredUsers = allUsers.filter(user => user.department_id === departmentId && (
                    selectedCourseId === '' || user.course_id === parseInt(selectedCourseId)));
                populateUsersDropdown(filteredUsers);
            }

            function populateUsersDropdown(users) {
                usersSelect.innerHTML = '<option></option>';
                users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = `${user.first_name} ${user.last_name}`;
                    usersSelect.appendChild(option);
                });
            }

            filterUsersByDepartment();
        });
    </script>
@endsection
