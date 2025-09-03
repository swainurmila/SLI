<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\OfficeDelivery_mode;
use Illuminate\Support\Facades\Auth;


class DeliveryModeController extends Controller
{
    public function deliverymodeMaster(){

        $delv = OfficeDelivery_mode::where('is_delete', 0)->get();
         return view("Eoffice.deliverymodemaster",compact('delv'));
    }
    public function deliverymodeAdd(Request $request){
        //return $request;

        $delv = new OfficeDelivery_mode();
        $delv->name = $request->name;
        $delv->created_by = Auth::guard('officer')->user()->id;
        $delv->status = $request->status;
        $delv->save();
        return redirect()->route('deliverymode-master')
        ->with('success', 'DeliveryMode Added Successfully');
    }
    public function deliverymodeUpdate(Request $request, $id){
        //return $request;

        // $rules = [
        //     'name' => 'required|string|max:255',
        //     'status' => 'required|boolean',
        // ];
        // $messages = [
        //     'name.required' => 'Name is required.',
        //     'name.string' => 'Name must be a string.',
        //     'name.max' => 'Name must not exceed 255 characters.',
        //     'status.required' => 'Status is required.',
        //     'status.boolean' => 'Status must be a boolean value.',
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput()
        //         ->with('error', 'Validation failed!');
        // }
        $delv = OfficeDelivery_mode::where('id', $id)->update([
            'name' => $request->name,
            'status'=>$request->status,

        ]);
        return redirect()->route('deliverymode-master')
        ->with('success', 'DeliveryMode Updated Successfully');
    }

    public function deliverymodeDelete($id){
        //return $id;
        $delv = OfficeDelivery_mode::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('deliverymode-master')
        ->with('success', 'DeliveryMode deleted Successfully');
    }
}
