<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeLetterType;

class LetterTypeController extends Controller
{
    //

    public function LetterTypeMaster()
    {

        $letter = OfficeLetterType::where('is_delete', 0)->get();
        return view("Eoffice.lettertypemaster", compact('letter'));
    }

    public function LetterTypeAdd(Request $request)
    {
        // return $request;
        $letter = new OfficeLetterType();
        $letter->name = $request->name;
        $letter->user_id = Auth::guard('officer')->user()->id;
        $letter->status = $request->status;
        $letter->save();
        return redirect()->route('letter-type-master')
            ->with('success', 'Letter Type Added Successfully');
    }

    public function LetterTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Ensure name is required and not empty
            'status' => 'required|in:0,1', // Assuming status can be either 0 or 1
        ]);
        $letter = OfficeLetterType::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,

        ]);
        return redirect()->route('letter-type-master')
            ->with('success', 'Letter Type Updated Successfully');
    }

    public function LetterTypeDelete($id)
    {
        //return $id;
        $letter = OfficeLetterType::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('letter-type-master')
            ->with('success', 'letter type deleted Successfully');
    }
}
