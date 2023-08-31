@extends('admin.layouts.two_col')
@section('title','All Courses')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="{{ url('admin/courses/create') }}">Add Courses</a>
            All Courses <span class="badge rounded-pill bg-danger"> {{count($courses)}}</span>
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
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
              
                    <tbody>
                        @php $sl=0 @endphp
                        @foreach($courses as $course)
                        <tr>
                            <td>{{++$sl}}</td>
                            <td>{{$course->course_code}}</td>
                            <td>{{$course->course_name}}</td>                           
                            <td>
                                <a href="{{ url('admin/courses/show',['course'=>$course->id]) }}"><i class=" fa fa-eye px-1"></i></a>
                                <a href="{{ url('admin/courses/edit',['course'=>$course->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form style="display:inline" action="{{ url('admin/courses/delete', ['course' => $course->id]) }}">
                                    @csrf
                                   
                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('are sure want delete?')" style="font-size: 11px"><i class=" fa fa-trash "></i></button>
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