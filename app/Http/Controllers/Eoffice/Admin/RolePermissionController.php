<?php

namespace App\Http\Controllers\Eoffice\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('guard_name','officer')->orderBy('id','DESC')->get();
        return view("Eoffice.admin.role_permission.index",compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Eoffice.admin.role_permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            "role_title" => "required|unique:roles,name",
        ]);

        $role = Role::create(["name" => $request->role_title,"guard_name"=>'officer']);
        return redirect()->route("eoffice.admin.role.index")->with("success", "Role created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permission = Permission::where('guard_name','officer')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();



        return view('Eoffice.admin.role_permission.edit',compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $this->validate($request, [
            "role_title" => "required",
        ]);
        
        $user = Auth::guard('officer')->user();
        $role = Role::find($id);
        $role->name = $request->role_title;
        $role->save();

        $selectedPermissions = $request->input('permission', []);

        $permissions = array_filter($request->all(), function($key) {
            return is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);


        $permissionNames = Permission::whereIn('id', $permissions)->get();


        $role->syncPermissions($permissionNames);
        $user->syncPermissions($permissionNames);
    
        return redirect()->route("eoffice.admin.role.index")->with("success", "Role and Permission updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
