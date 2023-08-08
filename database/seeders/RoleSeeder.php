<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions=Permission::all();
        Role::updateOrCreate([
            'name'=>'Super Admin',
            'slug'=>'super-admin',
            'description'=>'This is Super Admin',
            'delteable'=>false,
        ])->permissions()->sync($adminPermissions->pluck('id'));
        Role::updateOrCreate([
            'name'=>'Admin',
            'slug'=>'admin',
            'description'=>'This is Admin',
            'delteable'=>false,

        ])->permissions()->sync($adminPermissions->pluck('id'));
        Role::updateOrCreate([
            'name'=>'Teacher',
            'slug'=>'teacher',
            'description'=>'This is Teacher',
            'delteable'=>true,

        ]);
        Role::updateOrCreate([
            'name'=>'Student',
            'slug'=>'student',
            'description'=>'This is Student',
            'delteable'=>true,
        ]);
    }
}
