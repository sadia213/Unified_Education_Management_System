@extends('admin.layouts.two_col')
@section('title','Create Courses')
@section('content')
<h1 class="h3 mb-3"> Course</h1>

<div class="card-header">
    Create Courses <a class="btn btn-info mx-2" href="{{ url('admin/courses/index') }}">List</a>

</div>

<div class="card-body">
    <form action="{{ url('admin/courses/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Course Code</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="course_code" value="">
                @error('course_code')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Course Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="course_name" value="">
                @error('course_name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Course Short Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="short_name" value="">
                @error('short_name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Credit</label>
            <div class="col-8">
                <select name="credit" id="" class="form-control">
                    <option value="">Select Credit</option>
                    <option value="1">1</option>
                    <option value="1.5">1.5</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                @error('credit')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputBrandTitle" class="col-sm-3 col-form-label">Type</label>
            <div class="col-8">
                <select name="type" id="" class="form-control">
                    <option value="">Select Course Type</option>
                    <option value="Theory">Theory</option>
                    <option value="Lab">Lab</option>
                    <option value="Project">Project</option>
                    <option value="Thesis">Thesis</option>
                </select>
                @error('type')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputPicture" class="col-sm-3 col-form-label">Department</label>
            <div class="col-8">
                <select name="department_id" class="form-select">
                    <option></option>
                    @foreach($departments as $d)
                    <option value="{{$d->id}}">{{$d->dept_name}}</option>
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

@endsection