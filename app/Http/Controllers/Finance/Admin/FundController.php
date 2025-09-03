<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\CategoryMaster;
use App\Models\Finance\SubCategoryMaster;
use App\Models\Training\TrTransactionTable;
use App\Models\Course\CrTransactionTable;
use App\Models\Workshop\WsTransactionTable;
use App\Models\LibTransaction;
use Session;

class FundController extends Controller
{
    public function fundCollected(){
        try{
            $training_amount =  TrTransactionTable::sum('amount');
            $course_amount =  CrTransactionTable::sum('amount');
            $workshop_amount =  WsTransactionTable::sum('amount');
            $library_amount =  LibTransaction::sum('amount');
            return view("finance.user.fund.all_transaction",compact('training_amount','course_amount','workshop_amount','library_amount'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function trainingTransactions(){
        try{
            $training_data =  TrTransactionTable::with('User', 'Training')->get();
            return view("finance.user.fund.training_transaction", compact('training_data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function courseTransactions(){
        try{
            $course_data =  CrTransactionTable::with('User', 'Course')->get();
            return view("finance.user.fund.course_transaction", compact('course_data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function workshopTransactions(){
        try{
            $workshop_data =  WsTransactionTable::with('User', 'Workshop')->get();
            return view("finance.user.fund.workshop_transaction", compact('workshop_data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function libraryTransactions(){
        try{
            $library_data =  LibTransaction::with('User', 'Book')->get();
            return view("finance.user.fund.library_transaction", compact('library_data'));
        }catch (ValidationException $e){
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    
    
}