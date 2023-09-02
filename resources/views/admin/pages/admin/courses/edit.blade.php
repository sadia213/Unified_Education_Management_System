@extends('admin.layouts.two_col')
@section('title','Edit Courses')
@section('content')
<h1 class="h3 mb-3 mx-3">Edit Courses</h1>

<div class="card-header">
    Edit Courses <a class="btn btn-info mx-2" href="{{ url('admin/courses/index') }}">List</a>

</div>

<div class="card-body">
    <form action="{{ url('admin/courses/update',['course'=>$course->id] ) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Course Code</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="course_code" value="{{ old('course_code',$course->course_code) }}">
                @error('course_code')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Course Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="course_name" value="{{ old('course_name',$course->course_name) }}">
                @error('course_name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Course Short Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="short_name" value="{{ old('short_name',$course->short_name) }}">
                @error('short_name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Credit</label>
            <div class="col-8">
                <select name="credit" id="" class="form-control">
                    <option value="1" {{ $course->credit == '1' ? "selected" : '' }}>1</option>
                    <option value="1.5" {{ $course->credit == '1.5' ? "selected" : '' }}>1.5</option>
                    <option value="2" {{ $course->credit == '2' ? "selected" : '' }}>2</option>
                    <option value="3" {{ $course->credit == '3' ? "selected" : '' }}>3</option>
                    <option value="4" {{ $course->credit == '4' ? "selected" : '' }}>4</option>
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
                    <option value="Theory" {{ $course->type == "Theory" ? "selected" : " " }}>Theory</option>
                    <option value="Lab" {{ $course->type == "Lab" ? "selected" : " " }}>Lab</option>
                    <option value="Project" {{ $course->type == "Project" ? "selected" : " " }}>Project</option>
                    <option value="Thesis" {{ $course->type == "Thesis" ? "selected" : " " }}>Thesis</option>
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
                    @foreach($departments as $d)
                    <option {{ ($d->id == $course->department_id) ? 'selected' : '' }} value="{{$d->id}}">{{$d->dept_name}}</option>
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