<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\CategoryMaster;
use App\Models\Finance\SubCategoryMaster;
use App\Models\Finance\BankDetails;
use App\Models\Finance\Expense;
use App\Models\Finance\BudgetCreation;
use \Carbon\Carbon;
use Session;


class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $mainCategory =  CategoryMaster::where('status','active')->get();
        $subCategory =  SubCategoryMaster::where('status','active')->get();
        $bankAccounts = BankDetails::where('status','active')->get();


        



        //Financial Year
        $currentYear = Carbon::now()->format('Y'); 
        $previousYear = $currentYear - 1;
        $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];

        // $years = [$currentYear . '-' . substr($currentYear + 1, 2)];



        $current_year = date('Y');
        $next_year = date('y', strtotime('+1 year'));
        $financial_year = $current_year . '-' . $next_year;
        $last_expense = Expense::with('Category', 'SubCategory', 'BankDetails')
        ->orderBy('id', 'desc')
        ->first();

        if($request->financial_year){
            $financial_year = $request->financial_year;
            $budgetExpenses = Expense::with('Category','SubCategory','BankDetails')->where('budget_type',$request->financial_year)->orderBy('id','desc')->get();
        }else{
            $budgetExpenses = Expense::with('Category','SubCategory','BankDetails')->orderBy('id','desc')->get();
            $financial_year = $current_year . '-' . $next_year;
        }

        return view('finance.user.expenses.index',compact('mainCategory','subCategory','bankAccounts','budgetExpenses','years', 'financial_year', 'last_expense'));
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

        $request->validate([
            'budget_type'=>'required',
            'category'=>'required',
            'sub_category'=>'required',
            'pay_form'=>'required',
            'amount_paid'=>'required',
            'pay_to'=>'required',
            'bank_name'=>'required',
            'account_number'=>'required',
            'ifsc_code'=>'required',
            'expense_date'=>'required',
            'purpose'=>'required',
            'supporting_documents' => 'file|max:2048'
        ]);



        $expenses = Expense::where('category',$request->category)->where('sub_category',$request->sub_category)->where('budget_type',$request->budget_type)->orderBy('id','desc')->first();
        $budget =  BudgetCreation::with('SubCategory')->where('category_id',$request->category)->where('sub_category_id',$request->sub_category)->where('financial_year',$request->budget_type)->where('status','active')->first();
        if ($budget) {
            $category_name = CategoryMaster::where('id', $request->category)->first();
            $sub_category_name = SubCategoryMaster::where('id', $request->sub_category)->first();
            $sanction_amount = $budget->amount;
            if($budget){
                
                if(!$expenses){
                    $previous_amount = $budget->amount - $request->amount_paid;
    
                    $returnData = $this->insertExpenses($request,$previous_amount);
        
                    if ($returnData) {
                        return response()->json([
                            'success' => true,
                            'data' => $returnData,
                            'category_name' => $category_name->category_name,
                            'sub_category_name' => $sub_category_name->sub_category_name,
                            'sanction_amount' => $sanction_amount,
                            'message' => 'Expenses added successfully!'
                        ]);
                    }
        
                }else{
        
                    if($request->amount_paid < $expenses->previous_amount){
                        $previous_amount = $expenses->previous_amount - $request->amount_paid;
    
                        $returnData = $this->insertExpenses($request,$previous_amount);
        
                        if ($returnData) {
                            return response()->json([
                                'success' => true,
                                'data' => $returnData,
                                'category_name' => $category_name->category_name,
                                'sub_category_name' => $sub_category_name->sub_category_name,
                                'sanction_amount' => $sanction_amount,
                                'message' => 'Expenses added successfully!'
                            ]);
                        }
                    }else{
        
                        return response()->json([
                            'success' => false,
                            'message' => "You don't have sufficient balance on this " . $budget->SubCategory->sub_category_name
                        ], 400);
                    }
                    
        
                }
            }else{
                return response()->json([
                    'success' => false,
                    'message' => "You don't have any budget on this " . $budget->SubCategory->sub_category_name
                ], 400);
            }
    
        }else {


            return response()->json([
                'success' => false,
                'message' => 'Budget is not available for the specified category and sub-category.'
            ], 400);

        }
        
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

    private function insertExpenses($data,$previousExpenses){

        $newExpenses = new Expense;
        if ($data->hasFile('supporting_documents')) {
            $file = $data->file('supporting_documents');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('upload/finance/expenses/');
            $upload = $file->move($path, $filename);

            $newExpenses->document = $filename;
            
        }

        $newExpenses->budget_type = $data->budget_type;
        $newExpenses->category = $data->category;
        $newExpenses->sub_category = $data->sub_category;
        $newExpenses->pay_form = $data->pay_form;
        $newExpenses->amount = $data->amount_paid;
        $newExpenses->pay_to = $data->pay_to;
        $newExpenses->bank_name = $data->bank_name;
        $newExpenses->account_number = $data->account_number;
        $newExpenses->ifsc_code = $data->ifsc_code;
        $newExpenses->purpose = $data->purpose;
        $newExpenses->expense_date = $data->expense_date;
        $newExpenses->previous_amount = $previousExpenses;
        $newExpenses->save();

        return $newExpenses;    
    }
}
