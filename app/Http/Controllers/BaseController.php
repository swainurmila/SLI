<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $model;

    public function index()
    {
        $data = $this->model::all();
        return $data;
    }

    public function store(Request $request)
    {
        $data = $this->model::create($request->all());
        return $data;
    }

    public function edit($id)
    {
        $item = $this->model::findOrFail($id);
        return $item;
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    public function destroy($id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();
        return $item;
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=> captcha_img('black_white')]);
    }
}
