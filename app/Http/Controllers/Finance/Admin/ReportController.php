<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Models\Finance\CategoryMaster;
use App\Models\Finance\SubCategoryMaster;
use App\Models\Finance\BudgetCreation;
use App\Models\Finance\Expense;

class ReportController extends Controller
{
    public function budgetReport(){
        try{
            $currentYear = Carbon::now()->format('Y'); 
            $previousYear = $currentYear - 1;
            $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];

            // $years = [$currentYear . '-' . substr($currentYear + 1, 2)];

            $category =  CategoryMaster::where('status', 'active')->get(); 
            $budget =  BudgetCreation::with('Category', 'SubCategory')->get();

            $expenses = Expense::with('BankDetails', 'Category', 'SubCategory')->get();

            return view("finance.admin.report.budget_report", compact('category', 'years', 'expenses'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    //filter report
    public function budgetReportFilter(Request $request){
        try{
            $currentYear = Carbon::now()->format('Y'); 
            $previousYear = $currentYear - 1;
            $years = [$previousYear . '-' . substr($currentYear, 2), $currentYear . '-' . substr($currentYear + 1, 2)];
            //category
            $category =  CategoryMaster::where('status', 'active')->get(); 
            $expenses = Expense::with('BankDetails', 'Category', 'SubCategory')
            ->where(function ($query) use ($request) {
                if ($request->filled('category_id') && $request->filled('subcategory_id')) {
                    $query->where('category', $request->category_id)
                        ->where('sub_category', $request->subcategory_id);
                } else {
                    $query->where('category', $request->category_id);
                }
            })
            ->orWhere(function ($query) use ($request) {
                if ($request->filled('category_id') && $request->filled('subcategory_id') && $request->filled('financial_year')) {
                    $query->where('category', $request->category_id)
                        ->where('sub_category', $request->subcategory_id)
                        ->where('budget_type', $request->financial_year);
                } else {
                    $query->where('budget_type', $request->financial_year);
                }
            })
            // ->orWhere('budget_type', $request->financial_year)
            ->orWhereHas('BankDetails', function ($query) use ($request) {
                if ($request->filled('category_id') && $request->filled('subcategory_id') && $request->filled('financial_year') && $request->filled('budget_type')) {
                    $query->where('category', $request->category_id)
                        ->where('sub_category', $request->subcategory_id)
                        ->where('budget_type', $request->financial_year)
                        ->where('account_number', $request->account_no);
                } else {
                    $query->where('account_number', $request->account_no);
                }
                // $query->where('account_number', $request->account_no);
            })
            ->get();

        
            return view("finance.admin.report.budget_report", compact('category', 'years', 'expenses'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function openingReport(){
        try{
            $expenses = Expense::with('BankDetails', 'Category', 'SubCategory')->get();
            return view('finance.admin.report.opening_closing_report', compact('expenses'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function openingReportFilter(Request $request){
        try{
            $request->validate([
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
            ]);
            $expenses = Expense::with('BankDetails', 'Category', 'SubCategory')
            ->where('expense_date', '>=', $request->from_date)
            ->where('expense_date', '<=', $request->to_date)
            ->get();
            return view('finance.admin.report.opening_closing_report', compact('expenses'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    
}
