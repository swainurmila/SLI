 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">
     <div class="navbar-brand-box">
         <a href="#" class="logo logo-light">
             <span class="logo-sm">
                 <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
             </span>
             <span class="logo-lg logo-section">
                 <span>
                     <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                 </span>
                 <span class="ms-2">
                     <h6 class="logo-text">State Labour Institute</h6>
                     <span class="logo-sm-text">Institute of Govt. of Odisha</span>
                 </span>
             </span>
         </a>
     </div>

     <button type="button" class="btn btn-sm px-2 font-size-14 header-item waves-effect vertical-menu-btn">
         <i class="fa fa-fw fa-bars"></i>
     </button>

     <div data-simplebar class="sidebar-menu-scroll">

         <!--- Sidemenu -->
         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li>
                     <a href="{{ route('admin.home') }}" class="">
                         <i class="uil-home-alt"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="uil-user-circle"></i>
                         <span>User Management</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="true">
                         @can('role-module')
                             <li>
                                 <a href="{{ route('role.index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> Role</a>
                             </li>
                         @endcan

                         @can('user-module')
                             <li>
                                 <a href="{{ route('users.index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> User</a>
                             </li>
                         @endcan




                         @if (Auth::user()->role_id == 2)
                             @can('library_module')
                                 <li>
                                     <a href="{{ route('book.usersearch') }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i>User Search</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('user.approve-user') }}" class="active">
                                         <i class="fas fa-hand-point-right font-size-12"></i>
                                         <span>User Approval</span>
                                     </a>
                                 </li>
                             @endcan
                         @endif
                     </ul>
                 </li>


                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="uil-cog"></i>
                         <span>Master</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="true">
                         @can('languages-module')
                             <li>
                                 <a href="{{ route('language-master') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i> Languages </a>
                             </li>
                         @endcan




                         @if (Auth::user()->role_id == 2)
                             @can('library_module')
                                 <li>
                                     <a href="{{ route('category-master') }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i> Category</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('book.index') }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i> Book Details</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('book.mastersetting') }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i>Price Management</a>
                                 </li>
                             @endcan
                         @endif

                     </ul>
                 </li>


                 @if (Auth::user()->role_id == 2)
                 @can('library_module')
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="uil-clipboard-notes"></i>
                             <span>Report e-Library</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li>
                                 <?php

                                 $total_book_issue = App\Models\BookRequest::whereIn('issue_status', [0, 1, 3])
                                     ->orderBy('id', 'desc')
                                     ->count();
                                 $total_book_return = App\Models\BookRequest::whereIn('issue_status', [3, 4])
                                     ->orderBy('id', 'desc')
                                     ->count();
                                 $total_book_reject = App\Models\BookRequest::whereIn('issue_status', [2])
                                     ->orderBy('id', 'desc')
                                     ->count();

                                 ?>
                                 <a href="{{ route('book.bookIssueRequest') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Issue Book<span
                                         class="badge rounded-pill bg-primary float-end">{{ @$total_book_issue }}</span></a>
                             </li>
                             <li>
                                 <a href="{{ route('book.bookReturnRequest') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Return Book<span
                                         class="badge rounded-pill bg-primary float-end">{{ @$total_book_return }}</span></a>
                             </li>

                             <li>
                                 <a href="{{ route('book.rejectList') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Reject Book<span
                                         class="badge rounded-pill bg-primary float-end">{{ @$total_book_reject }}</span></a>
                             </li>
                         </ul>
                     </li>
                 @endcan
                 @endif
             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
 <!-- Left Sidebar End -->
