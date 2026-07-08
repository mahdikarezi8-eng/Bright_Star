<aside class="sidebar-nav-wrapper">







    <div class="navbar-logo">



        <a href="{{ route('dashboard') }}">



            <img src="{{ asset('backend/assets/images/logo/logo.svg') }}" alt="logo" />



        </a>



    </div>







    <nav class="sidebar-nav">







        <ul>







            {{-- Dashboard --}}



            <li class="nav-item">



                <a href="{{ route('dashboard') }}">



                    <span class="fa-solid fa-gauge text-primary" style="margin-right: 13px; font-size:18px;"></span>



                    <span class="text-dark">Dashboard</span>



                </a>



            </li>







            {{-- Employees --}}



            @if (Auth::user()->can('employee_menu'))



                <li class="nav-item nav-item-has-children">



                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_1">



                        <span class="icon text-primary fa fa-user"></span>



                        <span class="text-dark">Employees</span>



                    </a>







                    <ul id="ddmenu_1" class="collapse dropdown-nav">







                        @if (Auth::user()->can('employee_add'))



                            <li><a href="{{ route('employee_add') }}">Employee Add</a></li>



                        @endif







                        @if (Auth::user()->can('employee_list'))



                            <li><a href="{{ route('employee_list') }}">Employee List</a></li>



                        @endif







                        @if (Auth::user()->can('employee_document_list'))



                            <li><a href="{{ route('emp_document_list') }}">Employee Documents</a></li>



                        @endif







                        @if (Auth::user()->can('employee_attendance_list'))



                            <li><a href="{{ route('emp_attendance_list') }}">Employee Attendance</a></li>



                        @endif







                        @if (Auth::user()->can('employee_salary_list'))



                            <li><a href="{{ route('employee_salary_list') }}">Employee Salary</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            {{-- Teachers --}}



            @if (Auth::user()->can('teacher_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2">







                        <span class="icon fa-solid fa-chalkboard-teacher text-primary"></span>



                        <span class="text-dark">Teachers</span>







                    </a>







                    <ul id="ddmenu_2" class="collapse dropdown-nav">







                        @if (Auth::user()->can('teacher_add'))



                            <li><a href="{{ route('teacher_add') }}">Teacher Add</a></li>



                        @endif







                        @if (Auth::user()->can('teacher_list'))



                            <li><a href="{{ route('teacher_list') }}">Teacher List</a></li>



                        @endif







                        @if (Auth::user()->can('teacher_document_list'))



                            <li><a href="{{ route('teacher_document_list') }}">Teacher Documents</a></li>



                        @endif







                        @if (Auth::user()->can('teacher_attendance_list'))



                            <li><a href="{{ route('teacher_attendance_list') }}">Teacher Attendance</a></li>



                        @endif







                        @if (Auth::user()->can('teacher_salary_list'))



                            <li><a href="{{ route('teacher_salary_list') }}">Teacher Salary</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            {{-- Class & Subjects --}}



            @if (Auth::user()->can('class_&_subject_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_3">







                        <span class="icon text-primary fa-solid fa-book"></span>



                        <span class="text-dark">Class & Subjects</span>







                    </a>







                    <ul id="ddmenu_3" class="collapse dropdown-nav">







                        @if (Auth::user()->can('class_list'))



                            <li><a href="{{ route('class_list') }}">Classes</a></li>



                        @endif







                        @if (Auth::user()->can('subject_list'))



                            <li><a href="{{ route('subject_list') }}">Subjects</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            {{-- Students --}}



            @if (Auth::user()->can('student_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_4">







                        <span class="icon text-primary fa-solid fa-user-graduate"></span>



                        <span class="text-dark">Students</span>







                    </a>







                    <ul id="ddmenu_4" class="collapse dropdown-nav">







                        @if (Auth::user()->can('student_add'))



                            <li><a href="{{ route('student_add') }}">Student Add</a></li>



                        @endif







                        @if (Auth::user()->can('student_list'))



                            <li><a href="{{ route('student_list') }}">Student List</a></li>



                        @endif







                        @if (Auth::user()->can('student_document_list'))



                            <li><a href="{{ route('student_document_list') }}">Student Document</a></li>



                        @endif







                        @if (Auth::user()->can('student_attendance_list'))



                            <li><a href="{{ route('student_attendance_list') }}">Student Attendance</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            {{-- Exam & Score --}}



            @if (Auth::user()->can('exam_&_score_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_5">







                        <span class="icon text-primary fa-solid fa-clipboard-list"></span>



                        <span class="text-dark">Exam & Score</span>







                    </a>







                    <ul id="ddmenu_5" class="collapse dropdown-nav">







                        @if (Auth::user()->can('score_add'))



                            <li><a href="{{ route('score_add') }}">Score Add</a></li>



                        @endif







                        @if (Auth::user()->can('score_list'))



                            <li><a href="{{ route('score_list') }}">Score List</a></li>



                        @endif







                        {{-- @if (Auth::user()->can('time_table_list')) --}}



                            <li><a href="{{ route('timetable_list') }}">Time Table</a></li>



                        {{-- @endif --}}







                    </ul>



                </li>



            @endif











            {{-- Finance --}}



            @if (Auth::user()->can('finance_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_6">







                        <span class="icon text-primary fa-solid fa-money-bill-wave"></span>



                        <span class="text-dark">Finance</span>







                    </a>







                    <ul id="ddmenu_6" class="collapse dropdown-nav">







                        @if (Auth::user()->can('employee_salary_payment_list'))



                            <li><a href="{{ route('employee_salary_payment') }}">Employee Salary Payment</a></li>



                        @endif







                        @if (Auth::user()->can('teacher_salary_payment_list'))



                            <li><a href="{{ route('teacher_salary_payment') }}">Teacher Salary Payment</a></li>



                        @endif







                        @if (Auth::user()->can('income_list'))



                            <li><a href="{{ route('income_list') }}">Income</a></li>



                        @endif







                        @if (Auth::user()->can('outcome_list'))



                            <li><a href="{{ route('outcome_list') }}">Outcome</a></li>



                        @endif







                        @if (Auth::user()->can('student_fees_list'))



                            <li><a href="{{ route('student_fees_list') }}">Student Fees</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            {{-- User Manage --}}



            @if (Auth::user()->can('user_manage_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_7">







                        <span class="icon text-primary fa-solid fa-user-minus"></span>



                        <span class="text-dark">User Manage</span>







                    </a>







                    <ul id="ddmenu_7" class="collapse dropdown-nav">







                        @if (Auth::user()->can('employee_user_list'))



                            <li><a href="{{ route('emp_user_list') }}">Employee User List</a></li>



                        @endif







                        @if (Auth::user()->can('teacher_user_list'))



                            <li><a href="{{ route('teacher_user_list') }}">Teacher User List</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            {{-- Backup --}}



            <li class="nav-item">



                <a href="{{ route('backup_list') }}">



                    <span class="fa-solid fa-cloud-arrow-down text-primary" style="margin-right: 13px; font-size:18px;"></span>



                    <span class="text-dark">Backup</span>



                </a>



            </li>



            {{-- Website Setting --}}



            <li class="nav-item nav-item-has-children">







                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_8">







                    <span class="icon text-primary fa-solid fa-gear"></span>



                    <span class="text-dark">Website Setting</span>







                </a>







                <ul id="ddmenu_8" class="collapse dropdown-nav">







                    <li><a href="{{ route('about_list') }}">About</a></li>



                    <li><a href="{{ route('contact_list') }}">Contact</a></li>



                    <li><a href="{{ route('testimonial_list') }}">Testimonial</a></li>







                </ul>



            </li>











            <span class="divider">



                <hr />



            </span>







            {{-- Role & Permission --}}



            @if (Auth::user()->can('role_&_permission_menu'))



                <li class="nav-item nav-item-has-children">







                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_9">







                        <span class="icon text-primary fa-solid fa-user-shield"></span>



                        <span class="text-dark">Role & Permission</span>







                    </a>







                    <ul id="ddmenu_9" class="collapse dropdown-nav">







                        @if (Auth::user()->can('role_list'))



                            <li><a href="{{ route('role_list') }}">Role List</a></li>



                        @endif







                        @if (Auth::user()->can('permission_list'))



                            <li><a href="{{ route('permission_list') }}">Permission List</a></li>



                        @endif







                        @if (Auth::user()->can('role_to_permission_list'))



                            <li><a href="{{ route('role_to_permission_list') }}">Role To Permission</a></li>



                        @endif







                    </ul>



                </li>



            @endif











            <span class="divider">



                <hr />



            </span>







            {{-- Logout --}}



            <li class="nav-item">



                <form action="{{ route('logout') }}" method="post">



                    @csrf



                    <button type="submit" style="border:none; background-color:transparent">



                        <span class="icon fas fa-right-from-bracket text-primary ml-4 fs-5"></span>



                        Sign Out



                    </button>



                </form>



            </li>







        </ul>







    </nav>



</aside>



