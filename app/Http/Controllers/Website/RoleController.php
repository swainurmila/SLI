<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Str;

class RoleController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:role|role-list|role-create|role-edit|role-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }
    public function index()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('admin.roles.index',compact('roles'));
    }
    public function create_role(Request $request)
    {

        $role = new Role();
     return   $permission = Permission::get();


        return view('admin.roles.create',compact('role','permission'));
    }

    public function store_role(Request $request)
    {
        //return $request;
        // $request->validate([
        //     'name' => 'required|unique:roles,name',
        //     'permission' => 'required',
        // ]);

        $role = Role::create(['name' => Str::lower($request->name)]);
        $role->syncPermissions($request->permission);

        return redirect()->route('role.index');
    }

    public function edit_role($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit',compact('role','rolePermissions','permission','id'));
    }

    public function update_role(Request $request,$id)
    {
        $role = Role::find($id);
        $role->name = Str::lower($request->name);
        $role->save();

        $role->syncPermissions($request->permission);
        return redirect()->route('role.edit',[$id]);
    }

    public function delete_role($id)
    {
        Role::find($id)->delete();
        //DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('role.index');
    }


}
