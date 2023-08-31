@extends('admin/layouts.two_col')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-sm btn-success">
                    <i class="fas fa-check"></i> Export To Excel
                </a>
            </div>

        </div>

    </div>
    {{-- Alert Messages --}}
    @include('admin.includes.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th width="25%">Name</th>
                            <th width="25%">Email</th>
                            <th width="25%">Student's ID</th>
                            <th width="20%">Action</th>
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
@section('scripts')
<!-- Page level plugins -->
<script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->

<script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endsection