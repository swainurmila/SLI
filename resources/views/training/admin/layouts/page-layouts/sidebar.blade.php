 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">
     <!-- LOGO -->
     <div class="d-flex">
         <div class="navbar-brand-box ps-2">
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
                             <span class="logo-sm-text">e-Training</span>
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
                     <a href="{{ route('admin.training.dashboard') }}" class="">
                         <i class="uil-home-alt"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>

                 @can('user-module')
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="uil-user-circle"></i>
                             <span>User Management</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             @can('role-module')
                                 <li>
                                     <a href="{{ '/role' }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i> Role</a>
                                 </li>
                             @endcan

                             <li>
                                 <a href="{{ route('training.users') }}" class="">
                                     <i class="fas fa-hand-point-right font-size-1"></i>
                                     <span>Users</span>
                                 </a>
                             </li>


                                <li>
                                    <a href="{{ route('trainer.index') }}" class="">
                                        <i class="fas fa-hand-point-right font-size-1"></i>
                                        <span>Trainers</span>
                                    </a>
                                </li>
                                @role('Training Admin')
                                <li>
                                    <a href="{{ route('training.sponsor.index') }}" class="">
                                        <i class="fas fa-hand-point-right font-size-1"></i>
                                        <span>Sponsored</span>
                                    </a>
                                </li>
                                @endrole
                            </ul>
                        </li>
                    @endcan

                 @can('master_settings-module')
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="uil-store"></i>
                             <span>Master</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             @can('languages-module')
                                 <li>
                                     <a href="{{ route('language-master') }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i> Languages</a>
                                 </li>
                             @endcan

                             @can('category-module')
                                 <li>
                                     <a href="{{ route('category-master') }}" class=""><i
                                             class="fas fa-hand-point-right font-size-12"></i> Category</a>
                                 </li>
                             @endcan
                             <li>
                                 <a href="{{ route('training-category-index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Training Category</a>
                             </li>

                             <li>
                                 <a href="{{ route('training-place-index') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Training Place</a>
                             </li>
                             <li>
                                 <a href="{{ route('training.CertificateSetting') }}" class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Certificate Setting</a>
                             </li>
                         </ul>
                     </li>
                 @endcan

                 @can('training_module')
                     <li>
                         <a href="{{ route('training.admin.trainingList') }}" class="">
                             <i class="uil-notebooks"></i>
                             <span>Training</span>
                         </a>
                     </li>


                     <li>
                         <a href="{{ route('training.admin.student.list') }}" class="">
                             <i class="uil-users-alt"></i>
                             <span>Enrolled Students</span>
                         </a>
                     </li>

                     <li>
                         <a href="{{ route('training.admin.review.list') }}" class="">
                             <i class="uil-star"></i>
                             <span>Reviews</span>
                         </a>
                     </li>
                 @endcan


                    @if (Auth::user()->role_id == 6)
                        <li>
                            <a href="{{ route('trainer.trainingAssignClass') }}" class="">
                                <i class="fas fa-book-reader"></i>
                                <span>Assigned Class</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role_id == 3)
                        <li>
                            <a href="{{route("training.admin.sponsor-added-training")}}" class="">
                                <i class="fas fa-book-reader"></i>
                                <span>Training By Sponsors</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('training.transactiondetails')}}" class="">
                                <i class="fas fa-info"></i>
                                <span>Transaction</span>
                            </a>
                        </li>

                    @endif


             </ul>
         </div>
     </div>
 </div>
