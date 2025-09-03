
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box p-3">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/light-logo.png') }}" alt="" height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="uil-search"></span>
                </div>
            </form> --}}
            <div class="">
                {{-- <img src="assets/images/SLI -logo.png" alt="" class="ps-3"> --}}
                {{-- <img src="{{ asset('assets/images/SLI -logo.png') }}" alt="Header Avatar"> --}}
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
           

            @role('Finance User')
                @php
                    $current_year = date('Y');
                    $next_year = date('y', strtotime('+1 year'));
                    $financial_year = $current_year . '-' . $next_year;

                    $previousFinancialYear = $current_year - 1 . '-' . substr($current_year, 2);

                    $current_year_budget = App\Models\Finance\BudgetCreation::where('financial_year', $financial_year)
                        ->where('status', 'active')
                        ->sum('amount');
                    $expense_year_budget = App\Models\Finance\Expense::where('budget_type', $financial_year)->sum(
                        'amount',
                    );

                    $previous_year_budget = App\Models\Finance\BudgetCreation::where('financial_year',$previousFinancialYear)->where('status','active')->sum('amount');
                    $previous_year_expense = App\Models\Finance\Expense::where('budget_type',$previousFinancialYear)->sum('amount');

                    $formatted_amount = number_format(@$current_year_budget, 2, '.', ',');


                    if(date('n') > 3){
                        $previous_year_remaining = number_format((@$previous_year_budget - @$previous_year_expense), 2, '.', ',');
                    }else{
                        $previous_year_remaining = null;
                    }

                    $total_currentyear_expenses = number_format(
                        @$current_year_budget - @$expense_year_budget,
                        2,
                        '.',
                        ',',
                    );
                @endphp
                @if (!Request::is('portal/finance/dashboard'))
                    <div class="d-flex tab-sec">
                        <div class="tab-one"><span class="badge bg-danger p-2"><span class="font-size-14"> Total Sanctioned
                                    Amount : ₹ {{ @$formatted_amount }}</span></span></div>
                        <div class="tab-two"><span class="badge bg-warning p-2"><span class="font-size-14">Total Balance : ₹ {{@$previous_year_remaining }} 
                            
                            @if (@$previous_year_remaining && $previous_year_remaining > 0)
                                <span class="text-success" ><i class="ri-arrow-up-s-fill" ></i> + {{@$total_currentyear_expenses}} </span>
                            @endif
                            
                            {{-- @if (@$previous_year_remaining && $previous_year_remaining > 0)
                                <span class="text-success" ><i class="ri-arrow-up-s-fill" ></i> Previous Year : ₹ {{@$previous_year_remaining}} </span>
                            @endif     --}}
                        </span></span></div>
                    </div>
                @endif

            @endrole


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ Auth::user()->profile_photo }}"
                        alt="Header Avatar">

                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Hi,
                        {{ Auth::user()->first_name }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route("admin.finance.uprofile")}}"><i
                            class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span
                            class="align-middle">View Profile</span></a>
                    <form id="logout-form" action="{{ route('finance.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a class="dropdown-item" id="logout-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                        <span class="align-middle">Sign out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
