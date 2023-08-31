@extends('admin/layouts.two_col')

@section('title', 'Import Users')
@section('main')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Users</h1>
    </div>

    {{-- Alert Messages --}}
    @include('admin.includes.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Import Users</h6>
        </div>
        <form class="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/import-user') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-md-12 my-2">
                        <p>Please Upload CSV in Given Format <a href="{{ asset('files/sample-data-sheet.csv') }}" target="_blank">Sample CSV Format</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mt-1 mb-2 mb-sm-0">
                        <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input type="file" class="form-control form-control-user @error('file') is-invalid @enderror" id="exampleFile" name="file" value="{{ old('file') }}">

                        @error('file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    
                </div>
                
                <button type="submit" class="btn btn-success btn-user mt-3">Upload Users</button>
            </div>

            <div class="card-footer">
                <a href="{{ route('export-user') }}" class="btn btn-primary float-right my-2">Export Excel</a>
            </div>
        </form>
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