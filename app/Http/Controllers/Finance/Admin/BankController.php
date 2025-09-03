<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\BankDetails;
use Session;

class BankController extends Controller
{
    public function bankDetails(){
        try{
            $bank = BankDetails::get();
            return view("finance.user.bank.bank_details_master", compact('bank'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function storeBankDetails(Request $request){
        try{
            $request->validate([
                'bank_name' => 'required|string|max:100',
                'account_number' => 'required|string|max:20|unique:fi_bank_details,account_number',
                'ifsc_code' => 'required|string|max:11|unique:fi_bank_details,ifsc_code',
                'branch_name' => 'required|string|max:100',
            ]);
            $bankDetails = new BankDetails();
            $bankDetails->bank_name = $request->bank_name;
            $bankDetails->account_number = $request->account_number;
            $bankDetails->ifsc_code = $request->ifsc_code;
            $bankDetails->branch_name = $request->branch_name;
            $bankDetails->save();
            Session::flash('success', 'Bank details added successfully');
            return redirect()->back();

        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function updateBankDetails(Request $request, $id){
        try{
            $request->validate([
                'bank_name' => 'required|string|max:100',
                'account_number' => 'required|string|max:20',
                'ifsc_code' => 'required|string|max:11',
                'branch_name' => 'required|string|max:100',
            ]);
            //return $id;
            // return $request;
            $bankDetails = BankDetails::find($id);
            $bankDetails->bank_name = $request->bank_name;
                $bankDetails->account_number = $request->account_number;
                $bankDetails->ifsc_code = $request->ifsc_code;
                $bankDetails->branch_name = $request->branch_name;
                $bankDetails->update();
            Session::flash('success', 'Bank details updated successfully');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
