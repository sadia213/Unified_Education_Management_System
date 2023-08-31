@extends('admin/layouts.two_col')
@section('main')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Enroll</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Enroll</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <form action="">
                                <div class="form-group">
                                    <label for="">Enter Roll</label>
                                    <input type="text" class="form-control" name="" id="">
                                </div>
                               </form>
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