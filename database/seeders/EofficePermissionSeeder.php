<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\e_office\officeUser;

class EofficePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existAdmin = officeUser::where('email','superadmin@admin.com')->first();


        $permissions = [
            'eoffice_module',
            'eoffice_module-list',
            'eoffice_module-create',
            'eoffice_module-edit',
            'eoffice_module-delete',
        ];

        if(!$existAdmin){

            $user= new officeUser;
            $user->first_name = 'Superadmin';
            $user->last_name = 'Superadmin';
            $user->user_name = 'Superadmin';
            $user->email = 'superadmin@admin.com';
            $user->password = Hash::make('12345678');
            $user->status = '1';
            $user->role_id = 1;
            $user->role = 'Eoffice Admin';
            $user->save();

            if($user->save()){
                $role = Role::where('name', 'Admin')->where('guard_name', 'officer')->first();

                

                if($role){
                    foreach ($permissions as $permission) {
                        Permission::create(['name' => $permission,'guard_name'=>'officer']);
                        $permission = Permission::where('name', $permission)->where('guard_name', 'officer')->first();
                        $role->givePermissionTo($permission);
                    }

                    $user->assignRole('Eoffice Admin');
                }
    
            }
        }else{
            $role = Role::where('name', 'Eoffice Admin')->where('guard_name', 'officer')->first();

            $existAdmin->role_id = 1;
            $existAdmin->role = 'Eoffice Admin';
            $existAdmin->save();

            if($role){
                foreach ($permissions as $permission) {
                    $model = Permission::where('name', $permission)->where('guard_name', 'officer')->first();
                    if($model){
                        $role->givePermissionTo($model);
                    }else{
                        Permission::create(['name' => $permission,'guard_name'=>'officer']);
                        $permission = Permission::where('name', $permission)->where('guard_name', 'officer')->first();
                        $role->givePermissionTo($permission);
                    }
                }

                $existAdmin->assignRole('Eoffice Admin');
            } 
        }
    }
}
