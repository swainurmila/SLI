<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Finance\BudgetCreation;
use App\Models\Finance\Expense;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewProfile(){

        $data = User::find(Auth::user()->id);



        $states = DB::table('states')->get();
        $cities =DB::table('cities')->where('state_id',Auth::user()->state_id)->get();


        return view('finance.admin.user.profile',compact('data','states','cities'));
    }

    public function updateProfile(Request $request){
        $data = $this->validate(
            $request,
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'user_name' => 'required|string|max:255',
                'present_address' => 'nullable|string|max:255',
                'permanent_address' => 'nullable|string|max:255',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
                'state_id' => 'nullable|integer',
                'district_id' => 'nullable|integer',
                'contact_no' => 'nullable|string|max:15',
                'password' => [
                    'nullable',
                    'string',
                    'min:8',
                    'regex:/[a-z]/', // must contain at least one lowercase letter
                    'regex:/[A-Z]/', // must contain at least one uppercase letter
                    'regex:/[0-9]/', // must contain at least one digit
                    'regex:/[@$!%*?&#]/', // must contain a special character
                ],
            ],
        );
        
        
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $request->id . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
        }else {
            $profile_photo = $request->profile_photo_old;
        }

        $update_user = User::where('id', Auth::user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' =>$request->user_name,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profile_photo' => $profile_photo,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'contact_no'=>$request->contact_no
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }
    public function index(Request $request)
    {


        if($request->financial_year){
            
            $financial_year = $request->financial_year;


            list($startYear, $endYear) = explode('-', $request->financial_year);

            $startYear = (int)$startYear;
            $endYear = (int)$endYear;

            $previousStartYear = $startYear - 1;
            $previousEndYear = substr($startYear, 2);

            $previousFinancialYear = $previousStartYear . '-' . $previousEndYear;


    
        }else{

            $current_year = date('Y');
            $next_year = date('y', strtotime('+1 year'));
    
    
            $previousFinancialYear = $current_year - 1 . '-' . substr($current_year, 2);
    
            $financial_year = $current_year . '-' . $next_year;
        }
        $current_year_budget = BudgetCreation::where('financial_year',$financial_year)->where('status','active')->sum('amount');
        $expense_year_budget = Expense::where('budget_type',$financial_year)->sum('amount');


        $previous_year_budget = BudgetCreation::where('financial_year',$previousFinancialYear)->where('status','active')->sum('amount');
        $previous_year_expense = Expense::where('budget_type',$previousFinancialYear)->sum('amount');


        $formatted_amount = number_format(@$current_year_budget, 2, '.', ',');

        // dd($expense_year_budget);

        $remaining_amount = number_format((@$current_year_budget - @$expense_year_budget), 2, '.', ',');
        
        
        if(date('n') > 3){
            
            $previous_year_remaining = number_format((@$previous_year_budget - @$previous_year_expense), 2, '.', ',');
        }else{
            $previous_year_remaining = null;
        }
        // dd($previous_year_remaining);
        // dd($total_currentyear_expenses);

        $currentYear = Carbon::now()->format('Y');
        $previousYear = $currentYear - 1;
        $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];
        return view('finance.dashboard',compact('expense_year_budget','remaining_amount','current_year_budget','years','previous_year_remaining','financial_year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
