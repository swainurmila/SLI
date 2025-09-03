<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Auth;
class RoleController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:role-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = DB::table('roles')->orderBy('id','DESC')->get();

        $roles=[
            [
                "id"=>'1',
                "name"=>'Library'
            ],
            [
                "id"=>'2',
                "name"=>'Training'
            ],
            [
                "id"=>'3',
                "name"=>'Course'
            ],
            [
                "id"=>'4',
                "name"=>'Research'
            ],
            [
                "id"=>'5',
                "name"=>"E-Office"
            ],
            [
                "id"=>'6',
                "name"=>"Workshop"
            ],
            [
                "id"=>'7',
                "name"=>"Finance"
            ]
        ];

        return view("role.index",compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("role.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        // return $request;
        $this->validate($request, [
            "role_title" => "required|unique:roles,name",
            "role_for"=>'required'
            //'permission' => 'required',
        ]);

        if(Auth::guard('officer')->user()){
            $role = Role::create(["name" => $request->role_title,"role_for"=>$request->role_for,"guard_name"=>'officer']);
        }else{
            $role = Role::create(["name" => $request->role_title,"role_for"=>$request->role_for,"guard_name"=>'web']);
        }
        return redirect()->route("role.index")->with("success", "Role created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        if($id == 1){
            $role_for = 'Library';
        }else if($id == 2){
            $role_for = 'Training';
        }else if($id == 3){
            $role_for = 'Course';
        }else if($id == 4){
            $role_for = 'Research';
        }else if($id == 5){
            $role_for = "E-Office";
        }else if($id == 6){
            $role_for = "Workshop";
        }else{
            $role_for = "Finance";
        }
        $roles = Role::where("role_for",$id)->get();
        return view('role.role-list',compact('roles','role_for'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
         $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();


        return view('role.edit',compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        $this->validate($request, [
            "role_title" => "required",
            // "permission" => "required|array",
        ]);
    
        $role = Role::find($id);

        $role->name = $request->role_title;
        $role->save();

        // Get the selected permission IDs from the form
        $selectedPermissions = $request->input('permission', []);
        
        // // Get the names of selected permissions
        // $permissionNames = DB::table('permissions')->whereIn('id', $selectedPermissions)->pluck('name')->toArray();
        // // Sync the selected permissions
        // $role->syncPermissions($permissionNames);

        // Extract the permissions from the request
        $permissions = array_filter($request->all(), function($key) {
            return is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);


        // Get only the permission values
        $selectedPermissions = array_values($permissions);


        // if ($request->permission) {
        //     $selectedPermissions = array_values($request->permission);
        // } else {
        //     $selectedPermissions = array();
        // }
        $role->permissions()->sync($selectedPermissions);
        return redirect()->route("role.index")->with("success", "Role updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     return $id;
    //     $role = Role::find($id);
    //     $role->delete();
    //     return redirect()->route('role.index')
    //                     ->with('success','Role deleted successfully');
    // }
}
