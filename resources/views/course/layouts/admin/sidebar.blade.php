 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">
     <!-- LOGO -->
     <div class="d-flex">
         <div class="navbar-brand-box ecourse ps-2">
             <a href="#" class="logo logo-light">
                 <span class="logo-sm ps-2">
                     <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="50">
                 </span>

                 <span class="logo-lg">
                     <div class="d-flex">
                         <span>
                             <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                         </span>
                         <span class="ms-2">
                             <h6 class="logo-text">State Labour Institute</h6>
                             <span class="logo-sm-text">e-Course</span>
                         </span>
                     </div>
                 </span>
             </a>
         </div>

         <button type="button" class="btn btn-sm px-1 font-size-16 header-item waves-effect vertical-menu-btn">
             <i class="fa fa-fw fa-bars"></i>
         </button>
     </div>

     <div data-simplebar class="sidebar-menu-scroll">

         <div id="sidebar-menu">
             <ul class="metismenu list-unstyled" id="side-menu">

                 <li>
                     <a href="{{ route('admin.course.dashboard') }}" class="">
                         <i class="fas fa-home"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>

                 @role('Trainer')
                     <li>
                         <a href="{{ route('trainer.courseAssignClass',Auth::user()->id) }}" class="">
                             <i class="fas fa-book-reader"></i>
                             <span>Assigned Class</span>
                         </a>
                     </li>
                 @endrole
                 @can('course_module')
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="fas fa-user-edit"></i>
                             <span>User Management</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li>
                                 <a href="{{ route('course.users') }}" class="">
                                     <i class="fas fa-hand-point-right font-size-1"></i>
                                     <span>Users</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="{{ route('admin.course.trainers') }}" class="">
                                     <i class="fas fa-hand-point-right font-size-1"></i>
                                     <span>Trainers</span>
                                 </a>
                             </li>
                         </ul>
                     </li>



                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="uil-store"></i>
                             <span>Master</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">

                             <li>
                                 <a href="{{ route('course-category-index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> Course Category</a>
                             </li>
                             <li>
                                 <a href="{{ route('course-place-index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> Course Place</a>
                             </li>
                             <li>
                                 <a href="{{ route('course-notification-index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> Exam Notification</a>
                             </li>

                             <li>
                                 <a href="{{ route('course.admin.certificate.list') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> Certificate Template</a>
                             </li>

                         </ul>
                     </li>
                     <li>
                         <a href="{{ route('course.admin.courseList') }}" class="">
                             <i class="fas fa-book-reader"></i>
                             <span>Course </span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('course.admin.enrollList') }}" class="">
                             <i class="fas fa-user-graduate"></i>
                             <span>Enroll Students </span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('course.admin.reviewList') }}" class="">
                             <i class="fas fa-star-half-alt"></i>
                             <span>Reviews </span>
                         </a>
                     </li>
                     <li>
                        <a href="{{ route('course.admin.course-transaction') }}" class="">
                            <i class="far fa-credit-card"></i>
                            <span>Transactions </span>
                        </a>
                    </li>
                 @endcan
             </ul>
         </div>
     </div>
 </div>
