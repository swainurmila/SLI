<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Models\Finance\CategoryMaster;
use App\Models\Finance\SubCategoryMaster;
use App\Models\Finance\BudgetCreation;
use Session;
use Auth;
use App\Models\Finance\Expense;

class BudgetController extends Controller
{
    public function budgetCreation(Request $request)
    {
        try{
            //Financial Year
            $currentYear = Carbon::now()->format('Y'); 
            $previousYear = $currentYear - 1;
            $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];

            // $years = [$currentYear . '-' . substr($currentYear + 1, 2)];

            //category
            $category =  CategoryMaster::where('status', 'active')->get(); 

            $current_year = date('Y');
            $next_year = date('y', strtotime('+1 year'));
            


            if($request->financial_year){
                $financial_year = $request->financial_year;
            }else{
                $financial_year = $current_year . '-' . $next_year;
            }

            // $budget =  BudgetCreation::with('Category', 'SubCategory')->get();
            $budget =  BudgetCreation::with(['Category', 'SubCategory' => function($query) {
                $query->withSum('expenses', 'amount');
            }])->where('financial_year', $financial_year)->get();


            // return $years;

            return view('finance.user.budget.create_budget', compact('years', 'category', 'budget', 'financial_year'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }


    // public function budgetCreationByYear(Request $request){
    //     dd($request->all());

    //     $budget =  BudgetCreation::with(['Category', 'SubCategory' => function($query) {
    //         $query->withSum('expenses', 'amount');
    //     }])->where('financial_year', $financial_year)->get();
    // }


    public function budgetStore(Request $request){
        try{
            //return $request;
            $data = new BudgetCreation();
            $data->category_id = $request->category_id;
            $data->sub_category_id = $request->subcategory_id;
            $data->financial_year = $request->financial_year;
            $data->amount = $request->amount;
            $data->save();
            // Session::flash('success', trans('flash.AddedSuccessfully'));
            Session::flash('success', 'Budget Added Successfully');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function getSubCategory(Request $request)
    {
        try{
            $sub_category = SubCategoryMaster::where('category_id', $request->category_id)->where('status', 'active')->orderBy('sub_category_name', 'asc')->get();
            return response()->json(['sub_category' => $sub_category]);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function getBankAccount(Request $request)
    {
        try{
            $acc_no = SubCategoryMaster::where('id', $request->subcategory_id)->where('status', 'active')->orderBy('sub_category_name', 'asc')->first();
            return response()->json(['account_number' => $acc_no->account_number]);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function checkBudgetExist(Request $request)
    {
        try{
            $count = BudgetCreation::where('sub_category_id', $request->subcategory_id)
            ->where('financial_year', $request->financial_year)
            ->count();

            return response()->json(['count' => $count]);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function subCategoryBudget(Request $request,$id){
        try{

            $currentYear = Carbon::now()->format('Y'); 
            $previousYear = $currentYear - 1;
            $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];

            // $years = [ $currentYear . '-' . substr($currentYear + 1, 2)];

            $data =  SubCategoryMaster::with('Category')->where('id', $id)->first(); 


            $current_year = date('Y');
            $next_year = date('y', strtotime('+1 year'));
            

            if($request->financial_year){
                $financial_year = $request->financial_year;
                $budget =  BudgetCreation::with(['Category', 'SubCategory' => function($query) {
                    $query->withSum('expenses', 'amount');
                }])->where('financial_year', $request->financial_year)->where('sub_category_id', $id)->get();
            }else{

                $financial_year = $current_year . '-' . $next_year;
                $budget =  BudgetCreation::with(['Category', 'SubCategory' => function($query) {
                    $query->withSum('expenses', 'amount');
                }])->where('financial_year', $financial_year)->where('sub_category_id', $id)->get();

            }
            
            
            // $budget =  BudgetCreation::with('Category', 'SubCategory.expenses')->where('financial_year',$financial_year)->where('sub_category_id', $id)->get();

            return view('finance.user.budget.sub_category_budget', compact('data', 'years', 'budget', 'financial_year','id'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    
    public function subCategoryBudgetExpenses(Request $request,$category_id,$sub_id){

        //Financial Year
        $currentYear = Carbon::now()->format('Y'); 
        $previousYear = $currentYear - 1;
        $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];

        // $years = [$currentYear . '-' . substr($currentYear + 1, 2)];


        $current_year = date('Y');
        $next_year = date('y', strtotime('+1 year'));
        

        $sanctioned_amount = BudgetCreation::where('category_id',$category_id)->where('sub_category_id',$sub_id)->first();
        


        if($request->financial_year){
            $financial_year = $request->financial_year;
            $balance_available = Expense::where('category',$category_id)->where('sub_category',$sub_id)->where('budget_type',$financial_year)->sum('amount');
            $budgetExpenses = Expense::with('Category','SubCategory','BankDetails')->where('category',$category_id)->where('sub_category',$sub_id)->where('budget_type',$financial_year)->orderBy('id','desc')->get();
        }else{
            $financial_year = $current_year . '-' . $next_year;
            $balance_available = Expense::where('category',$category_id)->where('sub_category',$sub_id)->sum('amount');
            $budgetExpenses = Expense::with('Category','SubCategory','BankDetails')->where('category',$category_id)->where('sub_category',$sub_id)->orderBy('id','desc')->get();
        }

        $category_name = CategoryMaster::where('id', $category_id)->first();
        $sub_category_name = SubCategoryMaster::where('id', $sub_id)->first();
        return view('finance.user.budget.sub-budget.add-expenses',compact('years','financial_year','sanctioned_amount','balance_available','category_id','sub_id','budgetExpenses', 'category_name', 'sub_category_name'));
    }
}
