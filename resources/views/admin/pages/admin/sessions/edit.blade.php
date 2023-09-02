@extends('admin.layouts.two_col')
@section('title','/Edit Session')
@section('content')
<h1 class="h3 mb-3 mx-3">Edit Session</h1>

<div class="card-header">
    Edit Courses <a class="btn btn-info mx-2" href="{{ url('admin/assigned_courses/index') }}">List</a>

</div>

<div class="card-body">
    <form action="{{ url('admin/assigned_courses/update',['session'=>$session->id] ) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="inputBrandTitle" class="col-sm-3 col-form-label">Session</label>
            <div class="col-8">
                <select name="add_session_id" id="" class="form-control">
                    <option value="">Select Session</option>
                    @foreach ($add_sessions as $s)
                        <option {{ ($s->id == $session->add_session_id) ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->session }}</option>
                    @endforeach
                </select>
                @error('session')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Section</label>
            <div class="col-8">
                <select name="section" id="" class="form-control">
                    <option value="A"{{ $session->section == 'A' ? "selected" : '' }}>A</option>
                    <option value="B"{{ $session->section == 'B' ? "selected" : '' }}>B</option>
                    <option value="C"{{ $session->section == 'C' ? "selected" : '' }}>C</option>
                    <option value="D"{{ $session->section == 'D' ? "selected" : '' }}>D</option>
                    <option value="E"{{ $session->section == 'E' ? "selected" : '' }}>E</option>
                </select>
                @error('section')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="inputPicture" class="col-sm-3 col-form-label">Course Name</label>
            <div class="col-8">
                <select name="course_id" class="form-select">
                    @foreach($courses as $c)
                    <option {{ ($c->id == $session->course_id) ? 'selected' : '' }} value="{{$c->id}}">{{$c->course_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="inputPicture" class="col-sm-3 col-form-label">Teacher's Name</label>
            <div class="col-8">
                <select name="user_id" class="form-select">
                    @foreach($users as $u)
                    <option {{ ($u->id == $session->user_id) ? 'selected' : '' }} value="{{ $u->id }}">{{ $u->first_name }} {{ $u->last_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <div class="col-sm-8">
                <button type="submit" class="btn btn-info">Update</button>
            </div>

        </div>

    </form>
</div>

@endsection