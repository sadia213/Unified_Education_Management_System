@extends('admin.layouts.single_col')
@section('title','Signin')
@section('content')
<div class="container-fluid">
    <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
        <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6">
            <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                <div class=" align-items-center justify-content-between mb-4">
                    <h2 class="text-primary">Welcome Back!</h2>
                    <br><br>
                    @if(Session:: has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    <form class="user" method="post" action="{{ url('/user/login') }}">
                        @csrf
                        <h3>Sign In</h3>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    <label for="">Email address</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    <label for=" ">Password</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <a href="">Forgot Password</a>
                </div>
                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                </form>
                <div class="text-center">
                    <a class="big" href="{{ url('/teacher/register') }}">Create a Teacher Account!</a>
                    <br>
                    <a class="big" href="{{ url('/student/register') }}">Create a Student Account!</a>
                </div>
            </diV>
        </div>
    </div>
</div>
@endsection