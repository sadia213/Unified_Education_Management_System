@extends('admin.layouts.two_col')
@section('title','Project Status')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="{{ url('student/project/create') }}">Project Submission</a>
            Project Details
        </div>
        <div class="card-body">
            @if(session('message'))
            <div class="alert alert-success">
                <span class="close" data-dismiss="alert"></span>
                <strong>{{session('message')}}</strong>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Project's Title</th>
                            <th scope="col">Project's Details</th>
                            <th scope="col">Member's Name</th>
                            <th scope="col">Member's ID</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
              
                    <tbody>
                      
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection