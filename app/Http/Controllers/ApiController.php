<?php

namespace App\Http\Controllers;

use App\Models\Course\CrTransactionTable;
use App\Models\Training\TrTransactionTable;
use App\Models\Workshop\WsTransactionTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class ApiController extends Controller
{
    public function getProfitDetails(){
        try{
            $dataFromTable1 = CrTransactionTable::where('status', 1)->get();
            $dataFromTable2 = TrTransactionTable::where('status', 1)->get();
            $dataFromTable3 = WsTransactionTable::where('status', 1)->get();

            $allData = $dataFromTable1->concat($dataFromTable2)->concat($dataFromTable3);
            return response()->json($allData);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function trainingTransactionDetails(){
        try{
            $training_data =  TrTransactionTable::with('User', 'Training')->get();
            return response()->json($training_data);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function courseTransactionDetails(){
        try{
            $course_data =  CrTransactionTable::with('User', 'Course')->get();
            return response()->json($course_data);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function workshopTransactionDetails(){
        try{
            $workshop_data =  WsTransactionTable::with('User', 'Workshop')->get();
            return response()->json($workshop_data);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }


    
}
