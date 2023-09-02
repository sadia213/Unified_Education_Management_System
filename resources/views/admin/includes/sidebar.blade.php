<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <div class="navbar-nav w-100">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text m-3">{{ Session::get('user_role') }}</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li> --}}

                @if (Session::has('user_role') && Session::get('user_role') == 'Super-Admin')
                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center"
                        href="{{ url('/dashboard') }}">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-laugh-wink"></i>
                        </div>
                        <div class="sidebar-brand-text m-3">{{ Session::get('user_role') }}</div>
                    </a>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('super-admin/pending-users') }}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Pending Users</span></a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fas fa-fw fa-cog"></i>Functionalities</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ url('super-admin/dept') }}" class="dropdown-item">Create Department</a>
                                <a href="{{ url('super-admin/teacherCreate') }}" class="dropdown-item">Create
                                    Teacher</a>
                                <a href="{{ url('super-admin/adminCreate') }}" class="dropdown-item">Assign Admin</a>
                                <a href="{{ url('super-admin/studentCreate') }}" class="dropdown-item">Create
                                    Student</a>
                            </div>
                        </div>
                    </li>
                @endif



                @if (Session::has('user_role') && Session::get('user_role') == 'Admin')
                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center"
                        href="{{ url('/dashboard') }}">
                        <div class="sidebar-brand-icon rotate-n-15 sidebar-brand-text text-center m-3">
                            <i class="fas fa-laugh-wink"></i>
                            {{ Session::get('user_role') }} of
                            <br>
                            <?= App\Models\Department::find(session('user_department_id'))->dept_name ?>
                        </div>
                    </a>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/import-users') }}">
                            <i class="fas fa-fw fa-file-import"></i>
                            <span>Import User</span></a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/pending-users') }}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Pending Users</span></a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fas fa-fw fa-cog"></i>Create Users</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ url('admin/signupTeacher') }}" class="dropdown-item">Create Teacher</a>
                                <a href="{{ url('admin/adminUser') }}" class="dropdown-item">Assign Admin</a>
                                <a href="{{ url('admin/studentSignup') }}" class="dropdown-item">Create Student</a>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="far fa-file-alt me-2"></i>Courses & Session</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ url('admin/add_sessions/index') }}" class="dropdown-item">Create
                                    Session</a>
                                <a href="{{ url('admin/courses/index') }}" class="dropdown-item">Create Courses</a>
                                <a href="{{ url('admin/assigned_courses/index') }}" class="dropdown-item">Assign
                                    Courses</a>
                            </div>
                        </div>
                    </li>
                @endif



                @if (Session::has('user_role') && Session::get('user_role') == 'Student')
                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center"
                        href="{{ url('/dashboard') }}">
                        <div class="sidebar-brand-icon rotate-n-15 sidebar-brand-text text-center m-3">
                            <i class="fas fa-laugh-wink"></i>
                            {{ Session::get('user_role') }} of
                            <br>
                            <?= App\Models\Department::find(session('user_department_id'))->dept_name ?>
                        </div>
                    </a>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>

                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('student/enroll/create') }}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Enroll</span></a>
                    </li>
                    <hr class="sidebar-divider">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('student/project/index') }}">
                            <i class="fas fa-duotone fa-clipboard"></i>
                            <span>Project Submission</span></a>
                    </li>
                @endif



                @if (Session::has('user_role') && Session::get('user_role') == 'Teacher')
                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center"
                        href="{{ url('/dashboard') }}">
                        <div class="sidebar-brand-icon rotate-n-15 sidebar-brand-text text-center m-3">
                            <i class="fas fa-laugh-wink"></i>
                            {{ Session::get('user_role') }} of
                            <br>
                            <?= App\Models\Department::find(session('user_department_id'))->dept_name ?>
                        </div>
                    </a>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <hr class="sidebar-divider my-0">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('teacher/running-courses') }}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Running Courses</span></a>
                    </li>
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('teacher/marks-distribution') }}">
                            <i class="fas fa-duotone fa-clipboard"></i>
                            <span>Marks Distribution</span></a>
                    </li>
                @endif

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->

                <!-- Nav Item - Pages Collapse Menu -->


                <!-- Nav Item - Utilities Collapse Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="utilities-color.html">Colors</a>
                            <a class="collapse-item" href="utilities-border.html">Borders</a>
                            <a class="collapse-item" href="utilities-animation.html">Animations</a>
                            <a class="collapse-item" href="utilities-other.html">Other</a>
                        </div>
                    </div>
                </li> -->

                <!-- Divider -->
                <!-- <hr class="sidebar-divider"> -->

                <!-- Heading -->
                <div class="sidebar-heading mx-3">
                    Addons
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                            class="far fa-file-alt me-2"></i>Pages</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="signin.html" class="dropdown-item">Sign In</a>
                        <a href="signup.html" class="dropdown-item">Sign Up</a>
                        <a href="404.html" class="dropdown-item">404 Error</a>
                        <a href="blank.html" class="dropdown-item">Blank Page</a>
                    </div>
                </div>
                <!-- Nav Item - Charts -->


                <!-- Nav Item - Tables -->
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{url('/tables')}}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tables</span></a>
                </li> --}}

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>
        </div>
    </nav>
</div>
