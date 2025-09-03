 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">
     <div class="navbar-brand-box">
         <a data-href="#" class="logo logo-light">
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
                         <span class="logo-sm-text">e-Office</span>
                     </span>
                 </div>
             </span>
         </a>
     </div>

     <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
         <i class="fa fa-fw fa-bars"></i>
     </button>

     <div data-simplebar class="sidebar-menu-scroll">

         <div id="sidebar-menu">
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li>
                     <a data-href="{{ route('admin.office.dashboard') }}" class="no_link">
                         <i class="uil-home-alt"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 {{-- @php
                        // dd(Auth::guard('officer')->user()->getPermissionsViaRoles());
                     $userHasPermission = Auth::guard('officer')->user();
                    //  dd($userHasPermission);
                     $userHasPermission->hasPermissionTo('user-management-module','officer');
                     dd($userHasPermission); // Check if the user has the permission
                 @endphp --}}



                 @role('Eoffice Admin', 'officer')
                     <li>
                         <a data-href="javascript: void(0);" class="has-arrow waves-effect no_link">
                             <i class="uil-store font-size-12"></i>
                             <span>User Management</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             {{-- @can('role-module', 'officer') --}}
                             <li>
                                 <a data-href="{{ route('eoffice.admin.role.index') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Roles</a>
                             </li>
                             {{-- @endcan --}}
                             {{-- @can('user-module') --}}
                             <li>
                                 <a data-href="{{ route('admin.office.user.index') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Users</a>
                             </li>
                             {{-- @endcan --}}
                         </ul>
                     </li>
                 @endrole

                 @role('Eoffice Admin', 'officer')
                     <li>
                         <a data-href="javascript: void(0);" class="has-arrow waves-effect no_link">
                             <i class="uil-store font-size-12"></i>
                             <span>Master</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li>
                                 <a data-href="{{ route('deliverymode-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Delivery Mode </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('section-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Section Master </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('officegroup-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Office Group </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('officemain-catagory-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Main Category Master </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('officesub-catagory-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Sub Category Master </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('fileformat-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>File Format Master </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('mailcontent-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Mail Content Master </a>
                             </li>

                             <li>
                                 <a data-href="{{ route('priority-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Priority Master </a>
                             </li>
                             <li>
                                 <a data-href="{{ route('fileaction-master') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>File Action Master </a>
                             </li>

                            <li>
                                <a data-href="{{ route('dept-master') }}" class="no_link"><i
                                        class="fas fa-hand-point-right font-size-12"></i>Department Master </a>
                            </li>
                            <li>
                                <a data-href="{{ route('purpose-master') }}" class="no_link"><i
                                        class="fas fa-hand-point-right font-size-12"></i>Purpose Master </a>
                            </li>
                            <li>
                                <a data-href="{{ route('letter-type-master') }}" class="no_link"><i
                                        class="fas fa-hand-point-right font-size-12"></i>Letter Type Master </a>
                            </li>
                         </ul>
                     </li>
                 @endrole


                 {{-- @hasanyrole('Deputy Secretary|Secretary|Additional Secretary', 'officer')
                    <li>
                        <a data-href="{{ route('admin.office.user.index') }}" class="waves-effect">
                            <i class="uil-file-plus-alt"></i>
                            <span>My Team</span>
                        </a>
                    </li>
                 @endhasanyrole --}}

                 {{-- @hasanyrole('Deputy Secretary|Secretary|Additional Secretary', 'officer') --}}
                 {{-- <li>
                        <a data-href="{{ route('eoffice.my-appointments.index') }}" class="waves-effect">
                            <i class="uil-file-plus-alt"></i>
                            <span>My Appointments</span>
                        </a>
                    </li> --}}
                 {{-- @endhasanyrole --}}

                 @if (Auth::guard('officer')->user()->login_for == 'office')
                     @role('Eoffice User|Eoffice Deputy Secretary|Eoffice Secretary|Eoffice Additional Secretary', 'officer')
                         <li>
                             <a data-href="{{ route('admin.office.index') }}" class="waves-effect no_link">
                                 <i class="uil-file-plus-alt"></i>
                                 <span>Compose File</span>
                             </a>
                         </li>




                         <li>
                             <a data-href="{{ route('admin.office.adddispatchMode') }}" class="waves-effect no_link">
                                 <i class="uil-location-point"></i>
                                 <span class="">Assign Address</span>
                             </a>
                         </li>
                         <li>
                             <a data-href="{{ route('admin.office.inboxFile') }}" class="waves-effect no_link">
                                 <i class="uil-box"></i>
                                 <span>Inbox</span>
                             </a>
                         </li>
                         <li>
                             <a data-href="{{ route('admin.office.sentReceipt') }}" class="waves-effect no_link">
                                 <i class="uil-receipt"></i>
                                 <span>Sent</span>
                             </a>
                         </li>
                         <li>
                             <a data-href="{{ route('admin.office.draftFile') }}" class="waves-effect no_link">
                                 <i class="uil-modem"></i>
                                 <span>Drafts</span>
                             </a>
                         </li>
                         <li>
                             <a data-href="{{ route('admin.office.recyclebin') }}" class="waves-effect no_link">
                                 <i class="uil-trash"></i>
                                 <span>Recyclebin</span>
                             </a>
                         </li>


                         <li>
                             <a data-href="javascript: void(0);" class="has-arrow waves-effect no_link">
                                 <i class="uil-store font-size-12"></i>
                                 <span>Appointments</span>
                             </a>
                             <ul class="sub-menu" aria-expanded="true">
                                 {{-- @can('role-module') --}}
                                 <li>
                                     <a data-href="{{ route('admin.office.appointment.index') }}" class="no_link"><i
                                             class="fas fa-hand-point-right font-size-12"></i>My Appointments</a>
                                 </li>
                                 {{-- @endcan --}}
                                 {{-- @can('user-module') --}}
                                 <li>
                                     <a data-href="{{ route('admin.office.appointment.all-appointments') }}" class="no_link"><i
                                             class="fas fa-hand-point-right font-size-12"></i>All Appointments</a>
                                 </li>
                                 {{-- @endcan --}}
                             </ul>
                         </li>
                         <li>
                             <a data-href="{{ route('admin.office.office-report') }}" class="waves-effect no_link">
                                 <i class="uil-files-landscapes-alt"></i>
                                 <span>Reports</span>
                             </a>
                         </li>
                     @endrole
                 @else
                     <li>
                         <a data-href="javascript: void(0);" class="has-arrow waves-effect no_link">
                             <i class="uil-store font-size-12"></i>
                             <span>Appointments</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li>
                                 <a data-href="{{ route('eoffice.appointments.index') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Apply New</a>
                             </li>
                             <li>
                                 <a data-href="{{ route('eoffice.myappointments.all') }}" class="no_link"><i
                                         class="fas fa-hand-point-right font-size-12"></i>My Appointments</a>
                             </li>
                         </ul>
                     </li>
                 @endif

             </ul>
         </div>
     </div>
 </div>
