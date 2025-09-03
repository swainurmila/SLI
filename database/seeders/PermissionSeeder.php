<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $existAdmin = User::where('email','superadmin@admin.com')->first();


        $permissions = [
            'role-module',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-module',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            
            'languages-module',
            'languages-list',
            'languages-create',
            'languages-edit',
            'languages-delete',
            

        ];

        if(!$existAdmin){

            $user= new User;
            $user->first_name = 'Superadmin';
            $user->last_name = 'Superadmin';
            $user->user_name = 'Superadmin';
            $user->email = 'superadmin@admin.com';
            $user->password = Hash::make('12345678');
            $user->status = '1';
            $user->save();

            if($user->save()){
                $role = Role::findByName('Admin');
                $user->assignRole('Admin');

                if($role){
                    foreach ($permissions as $permission) {
                        $model = Permission::whereName($permission);
                        if ($model->count() == 0) {
                            Permission::create(['name' => $permission,'guard_name'=>'web']);
                            $permission = Permission::findByName($permission);
                            $role->givePermissionTo($permission);
                        }
            
                    }
                }
    
            }
        }else{
            $role = Role::findByName('Admin');
            $existAdmin->assignRole('Admin');

            if($role){
                foreach ($permissions as $permission) {
                    $model = Permission::where('name',$permission)->first();
                    if($model){
                        $role->givePermissionTo($model);
                    }else{
                        Permission::create(['name' => $permission,'guard_name'=>'web']);
                        $permission = Permission::findByName($permission);
                        $role->givePermissionTo($permission);
                    }
                }
            } 
        }


    }
}
