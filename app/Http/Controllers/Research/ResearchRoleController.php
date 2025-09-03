<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ResearchRoleController extends Controller
{
    public function index(){

        $roles = Role::where('role_for','4')->get();
        return view('research.admin.role.index',compact('roles'));
    }

    public function create(){
        return view('research.admin.role.create');
    }

    public function store(){

        $this->validate($request, [
            "role_title" => "required|unique:roles,name",
            "role_for"=>'required'
        ]);

        $role = Role::create(["name" => $request->role_title,"role_for"=>'4',"guard_name"=>'web']);
        return redirect()->route("research.admin.role.index")->with("success", "Role created successfully");
    }


    public function edit($id){
        $role = Role::find($id);

        return view('research.admin.role.edit',compact('role'));
    }

    public function update(Request $request,$id){
        $role = Role::find($id);

        $role->name = $request->role_title;
        $role->save();

        return redirect()->route('research.admin.role.index');
    }
}
