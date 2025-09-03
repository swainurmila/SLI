 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu" id="finance-sidebar">
     <div class="navbar-brand-box">
         <a href="{{ route('finance.dashboard.show') }}" class="logo logo-light">
             <span class="logo-sm ps-2">
                 <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
             </span>

             <span class="logo-lg">
                 <div class="d-flex">
                     <span>
                         <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                     </span>
                     <span class="ms-2">
                         <h6 class="logo-text">State Labour Institute</h6>
                         <span class="logo-sm-text">Finance Module Year-{{ date('Y') }}</span>
                     </span>
                 </div>
             </span>
         </a>
     </div>

     <button type="button" class="btn btn-sm px-2 font-size-14 header-item waves-effect vertical-menu-btn">
         <i class="fa fa-fw fa-bars"></i>
     </button>

     <div data-simplebar class="sidebar-menu-scroll">

         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->

             {{-- @can('finance-module') --}}
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li>
                     <a href="{{ route('finance.dashboard.show') }}" class="waves-effect">
                         <i class="uil-home-alt"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 @if (auth()->user()->hasRole('Finance Admin') && auth()->user()->can('finance-master'))
                     <li>
                         <a href="{{ route('admin.user-index') }}" class=""><i
                                 class="fas fa-hand-point-right font-size-12"></i>
                             <span>Users</span>
                         </a>
                     </li>
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="uil-box"></i>
                             <span>Master</span>
                         </a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li>
                                 <a href="{{ route('bank-details-index') }}" class="active"><i
                                         class="fas fa-hand-point-right font-size-12"></i>Bank Details</a>
                             </li>
                             {{-- <li>
                                    <a href="scheme.html" class=""><i class="fas fa-hand-point-right font-size-12"></i>Scheme Master</a>
                                </li> --}}
                             <li>
                                 <a href={{ route('category-master-index') }} class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Scheme Master</a>
                             </li>
                             <li>
                                 <a href={{ route('sub-category-master-index') }} class=""><i
                                         class="fas fa-hand-point-right font-size-12"></i>Sub Scheme Master</a>
                             </li>
                         </ul>
                     </li>
                 @endif

                    @if (auth()->user()->can('finance-list'))
                        <li>
                            <a href="{{ route('yearly-budget-creation') }}" class="waves-effect">
                                <i class="uil-book"></i>
                                <span class="">Budget Planning</span>
                                
                            </a>
                        </li>
                    @endif
                    @role('Finance User')
                     <li>
                         <a href="javascript: void(0);" class="has-arrow waves-effect">
                             <i class="uil-bill"></i>
                             <span>GIA-Budget Planning</span>
                         </a>
                         @php
                             $category = App\Models\Finance\CategoryMaster::where('status', 'active')->get();

                         @endphp
                         <ul class="sidebar-menu">
                             @foreach ($category as $category)
                                 @php
                                     $all_sub_categories = App\Models\Finance\SubCategoryMaster::where(
                                         'category_id',
                                         $category->id,
                                     )
                                         ->where('status', 'active')
                                         ->get();
                                 @endphp
                                 <li>
                                     <a href="javascript:void(0);"
                                         class="{{ count($all_sub_categories) > 0 ? 'has-arrow' : '' }}">
                                         <i class="uil-money-stack"></i>{{ $category->category_name }}
                                     </a>

                                     <!-- Display subcategories -->
                                     @if ($all_sub_categories->isNotEmpty())
                                         <ul class="sub-menu" aria-expanded="true">
                                             @foreach ($all_sub_categories as $sub_category)
                                                 <li>
                                                     <a href={{ route('subcategory-budget-creation', $sub_category->id) }}>
                                                         <i
                                                             class="fas fa-hand-point-right font-size-12"></i>{{ $sub_category->sub_category_name }}
                                                     </a>
                                                 </li>
                                             @endforeach
                                         </ul>
                                     @endif
                                 </li>
                             @endforeach
                         </ul>

                     <li>
                     </li>

                     <li>
                         <a href="{{ route('yearly-budget-expenses') }}" class="waves-effect">
                             <i class="uil-book"></i>
                             <span class="">Budget Expenses</span>

                         </a>
                     </li>
                     
                     
                 @endrole


                @if (auth()->user()->can('finance-list'))
                    <li>
                        <a href="{{ route('fund-collected-sources') }}" class="waves-effect">
                            <i class="uil-book"></i>
                            <span class="">Fund Collected</span>

                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-bill"></i>
                            <span>Report</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('report.budget-report') }}"><i
                                        class="fas fa-hand-point-right font-size-12"></i>Budget Report</a></li>
                            <li><a href="{{ route('report.opening-closing-report') }}"><i
                                        class="fas fa-hand-point-right font-size-12"></i>Opening / Closing Balance</a>
                            </li>
                        </ul>
                    </li>
                    
                @endif

             </ul>
             {{-- @endcan --}}
         </div>
         <!-- Sidebar -->
     </div>
 </div>
