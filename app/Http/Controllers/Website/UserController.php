<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // $user = User::find(1); // Assuming you have the user instance

        // foreach ($user->roles as $role) {
        //     $roleName = $role->name;
        //     // Do something with the role name
        //     dd($roleName);
        // }


        $user = User::all();
        // foreach ($user as $item) {
        //     foreach ($item->roles as $role) {
        //         $roleName = $role->name;
        //         dd($roleName);
        //     }
        // }
       // return $user->roles;
        return view('admin.users.index', compact('user'));
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        $role = Role::all();
        return view('admin.users.edit', compact('user', 'id', 'role'));
    }

    public function update_user(Request $request, $id)
    {
        //return $id;
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role
        ]);
        $user->assignRole([$request->role]);
        return redirect()->route('user.index');
    }

    public function create_user()
    {

        $role = Role::all();
        return view('admin.users.create', compact('role'));
    }

    public function store_user(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('user.index');
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
