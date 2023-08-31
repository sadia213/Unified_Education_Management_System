@extends('admin.layouts.two_col')
@section('title','All Sessions')
@section('content')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="{{ url('admin/add_sessions/create') }}">Add Sessions</a>
            All Sessions <span class="badge rounded-pill bg-danger"> {{count($add_sessions)}}</span>
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
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $sl=0 @endphp
                        @foreach($add_sessions as $session)
                        <tr>
                            <td>{{++$sl}}</td>
                            <td>{{$session->session}}</td>
                            <td>
                                @if($session->status==1)
                                <span class="badge rounded-pill bg-success">Active</span>
                                <a href="{{ route('session.inactive', $session->id) }}"  title="active"><i class="fa-solid fa-circle-check"></i></a>
                                @else
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                <a href="{{ route('session.active', $session->id) }}"  title="inactive"><i class="fa-solid fa-circle-xmark"></i></a>
                                @endif
                            </td>
                            <td>
                                <form style="display:inline" action="{{ url('admin/add_sessions/delete', ['session' => $session->id]) }}">
                                    @csrf

                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure, you want to delete this?')" style="font-size: 11px">
                                        <i class=" fa fa-trash "></i>
                                    </button>
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