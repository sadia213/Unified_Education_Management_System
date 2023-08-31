@extends('admin/layouts.two_col')
@section('main')
<!-- Begin Page Content -->
<div class="container-fluid">
    @if (session('message'))
    <div class="alert alert-success">
        <span class="close" data-dismiss="alert"></span>
        <strong>{{ session('message') }}</strong>
    </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pending Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pending_users as $u)
                        <tr>
                            <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                            <td>{{ $u-> email }}</td>
                            <td>{{ $u-> role }}</td>
                            <td>
                                @if( $u->status )
                                <button class="btn btn-success">Approved</button>

                                @else
                                <button class="btn btn-danger">Not Approved</button>

                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ url('super-admin/approve-user/'.$u->id) }}">Approve</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->

<script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endsection