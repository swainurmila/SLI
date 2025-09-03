<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class MakePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'finance-module',
            'finance-list',
            'finance-create',
            'finance-edit',
            'finance-delete',

            'finance-master',
            'finance-master-list',
            'finance-master-create',
            'finance-master-edit',
            'finance-master-delete',
        ];


        if(count($permissions) > 0){
            foreach ($permissions as $permission) {
                $model = Permission::where('name',$permission)->first();
                if(!$model){
                    Permission::create(['name' => $permission,'guard_name'=>'web']);
                }
            }
        }
    }
}
