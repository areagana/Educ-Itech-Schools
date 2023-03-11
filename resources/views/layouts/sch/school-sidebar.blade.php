
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light bg-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">{{$school->school_code}}</div>
                    <a class="nav-link" href="{{route('home')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Manage</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStudents" aria-expanded="false" aria-controls="collapseStudents">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Students
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseStudents" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('schoolStudents',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                                Add Student
                            </a>
                            <a class="nav-link" href="{{route('schoolStudents',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                Manage 
                            </a>
                            <a class="nav-link" href="{{route('schoolStudents',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                Archived
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseExams" aria-expanded="false" aria-controls="collapseExams">
                        <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                        Exams
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseExams" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('addSchool')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                                New Exam
                            </a>
                            <a class="nav-link" href="{{route('schoolAssessments',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                View Exams
                            </a>
                            <a class="nav-link" href="{{route('schoolReports',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                Reports
                            </a>
                            <a class="nav-link" href="{{route('marksheetGenerate',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                Marksheets
                            </a>
                            <a class="nav-link" href="{{route('gradesheetGenerate',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                Gradesheets
                            </a>
                            <a class="nav-link" href="{{route('schoolTimetables',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                Analysis
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                        Classes
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('addSchool')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                                Add Class
                            </a>
                            <a class="nav-link" href="{{route('schoolForms',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                View Classes
                            </a>
                            <a class="nav-link" href="{{route('Streams')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chain-broken"></i></div>
                                Streams
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSubjects" aria-expanded="false" aria-controls="collapseSubjects">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Subjects
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseSubjects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('addSchool')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                                Add Subject
                            </a>
                            <a class="nav-link" href="{{route('schoolSubjects',$school->id)}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                View Subjects
                            </a>
                            <a class="nav-link" href="{{route('schools')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-contact"></i></div>
                                Course works
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link" href="{{route('messages')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                        Messages
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('allUsers')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>
                                New User
                            </a>
                            <a class="nav-link" href="{{route('allUsers')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                View All
                            </a>
                        </nav>
                    </div>
                    <!-- <a class="nav-link collapsed" href="{{route('allUsers')}}" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="{{route('allUsers')}}" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                View All
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div> -->
                    <div class="sb-sidenav-menu-heading">Settings</div>
                    <a class="nav-link" href="{{route('schoolTerms',$school->id)}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Terms
                    </a>
                    <a class="nav-link" href="{{route('schoolNotices',$school->id)}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                        Notice
                    </a>
                    <a class="nav-link" href="{{route('schoolLevels',$school->id)}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Levels
                    </a>
                    <a class="nav-link" href="{{route('gradingScale',$school->id)}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Grade scale
                    </a>
                    <a class="nav-link" href="{{route('academicyears',$school->id)}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Academic year
                    </a>
                    <a class="nav-link" href="{{route('schoolProfile',$school->id)}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Profile
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{Auth::user()->firstName}} {{Auth::user()->lastName}}
            </div>
        </nav>
    </div>
    
        
