@extends('admin.layouts.two_col')
@section('title', 'Assign Admin')
@section('content')
    <div class="container-fluid">
        <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
            <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6 py-5">
                <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                    <div class=" align-items-center justify-content-between mb-2 my-2">
                        <h3 class="text-primary">Assign Admin</h3>
                        <br>
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <form class="user" method="post" action="{{ url('admin/userAdmin') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <h3>Teachers of
                                {{ $user_department_name }}
                            </h3>
                        </div>

                        <div class="mb-3">
                            <label for="inputPicture" class="col-sm-3 col-form-label">Teacher's Name</label>
                            <div class="col-12">
                                <select name="user_id" class="form-select py-2 w-200 mb-3">
                                    <option>Select Teacher</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->first_name }} {{ $u->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 w-100 mb-3 mt-3">Assign Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
@endsection
