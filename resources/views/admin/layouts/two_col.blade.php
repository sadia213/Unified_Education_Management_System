<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div class="container-l position-relative bg-white d-flex p-0">

        @include('admin.includes.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div class="content">

            <!-- Main Content -->

            <!-- Topbar -->
            @include('admin.includes.nav')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            @yield('main')
            <!-- /.container-fluid -->
            @yield('content')
            <!-- End of Main Content -->

            <!-- Footer -->
            @yield('admin.includes.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    @include('admin.includes.scripts')
    @yield('scripts')


</body>

</html>