@extends('admin.layouts.two_col')
@section('content')
@section('title','Create Teacher Account')
@section('content')
<div class="container-fluid">
    <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
        <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6">
            <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                <div class=" align-items-center justify-content-between mb-2 my-2">
                    <h3 class="text-primary">Create a Teacher Account!</h3>
                    <br>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session:: has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                </div>
                <form class="user" method="post" action="{{ url('admin/teacherSignup') }}">
                    @csrf
                    <h3>Sign Up</h3>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control form-control-user" name="first_name" id="exampleFirstName" placeholder="First Name">
                            <label for="">First Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control form-control-user" name="last_name" id="exampleLastName" placeholder="Last Name">
                            <label for="">Last Name</label>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address">
                        <label for="">Email Address</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select name="department" id="" class="form-control form-control-user">
                            <option value="">Select Department</option>
                            @foreach($departments as $d)
                            <option value="{{ $d->id }}">{{ $d->dept_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                            <label for="">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="conf_password">
                            <label for="">Repeat Password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-3">Register Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection