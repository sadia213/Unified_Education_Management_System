@extends('admin.layouts.two_col')
@section('title','/Assigned Courses')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="{{ url('admin/assigned_courses/create') }}">Assign Courses</a>
            Assigned Courses <span class="badge rounded-pill bg-danger"> {{count($sessions)}}</span>
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
                            <th scope="col">SL</th>
                            <th scope="col">Session</th>
                            <th scope="col">Section</th>
                            <th scope="col">Course Title</th>
                            <th scope="col">Teacher's Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $sl=0 @endphp
                        @foreach($sessions as $session)
                        <tr>
                            <td>{{++$sl}}</td>
                            <td>{{$session->add_session->session}}</td>
                            <td>{{$session->section}}</td>
                            <td>{{$session->course->course_name}}</td>
                            <td>{{$session->teacher->first_name}} {{$session->teacher->last_name}}</td>
                            <td>
                                <a href="{{ url('admin/assigned_courses/show',['session'=>$session->id]) }}"><i class=" fa fa-eye px-1"></i></a>
                                <a href="{{ url('admin/assigned_courses/edit',['session'=>$session->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form style="display:inline" action="{{ url('admin/sessions/delete', ['session' => $session->id]) }}">
                                    @csrf

                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure, you want to delete this?')" style="font-size: 11px">
                                        <i class=" fa fa-trash "></i>
                                    </button>
                                    @if($session->status == 1)
                                    <a href="{{ route('session.inactive', $session->id) }}" title="active"><i class="fa-solid fa-circle-check"></i></a>
                                    @else
                                    <a href="{{ route('session.active', $session->id) }}" title="inactive"><i class="fa-solid fa-circle-xmark"></i></a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection