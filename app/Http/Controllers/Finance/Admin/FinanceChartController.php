<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\BudgetCreation;
use App\Models\Finance\Expense;

class FinanceChartController extends Controller
{


    function convertStringToInt($str) {
        // Remove commas from the string
        $cleanedStr = str_replace(',', '', $str);
        
        // Convert the cleaned string to a float
        $floatNumber = floatval($cleanedStr);
        
        // Convert the float to an integer
        $intNumber = intval($floatNumber);
        
        return $intNumber;
    }


    public function getExpenses(Request $request){

        $financialYear = $request->query('financial_year');


        if(isset($financialYear)){
            $financial_year = $financialYear;
        }else{
    
            $current_year = date('Y');
            $next_year = date('y', strtotime('+1 year'));
            $financial_year = $current_year . '-' . $next_year;

        }
        $current_year_budget = BudgetCreation::where('financial_year',$financial_year)->where('status','active')->sum('amount');

        
        $expenses = Expense::where('budget_type',$financial_year)->sum('amount');


        $total_sanctioned_amount = number_format(@$current_year_budget, 2, '.', ',');

        $total_remaining_amount = number_format((@$current_year_budget - @$expenses), 2, '.', ',');
        $returnData = [$this->convertStringToInt($expenses),$this->convertStringToInt($total_remaining_amount)];
        return response()->json($returnData);
    }

    public function fetchCurrentExpensesBudget(){
        $current_year = date('Y');
        $next_year = date('y', strtotime('+1 year'));

        $previous_year_full = date('Y', strtotime('last year'));

        $previous_financial_year =  $previous_year_full . '-' .date('y');
        $current_financial_year = $current_year . '-' . $next_year;

        $current_year_budget = BudgetCreation::where('financial_year',$current_financial_year)->where('status','active')->sum('amount');
        $previous_year_budget = BudgetCreation::where('financial_year',$previous_financial_year)->where('status','active')->sum('amount');

        $current_year_expenses = Expense::where('budget_type',$current_financial_year)->sum('amount');

        $previous_year_expenses = Expense::where('budget_type',$previous_financial_year)->sum('amount');


        // $total_sanctioned_amount = number_format(@$current_year_budget, 2, '.', ',');

        // $total_remaining_amount = number_format((@$current_year_budget - @$expenses), 2, '.', ',');
        $budget = [$this->convertStringToInt($current_year_budget),$this->convertStringToInt($previous_year_budget)];
        $expenses = [$this->convertStringToInt($current_year_expenses),$this->convertStringToInt($previous_year_expenses)];

        $year = [$current_financial_year , $previous_financial_year ];
        return response()->json(['budget'=>$budget,'expenses'=>$expenses,'year'=>$year]);
    }
}
