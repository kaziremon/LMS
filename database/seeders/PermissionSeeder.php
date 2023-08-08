<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleappdashboard=Module::updateOrCreate(['name'=>'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id'=>$moduleappdashboard->id,
            'name'=>'Access Dashboard',
            'slug'=>'home',
        ]);

// Role Managment
        $moduleAppRole=Module::updateOrCreate(['name'=>'Role Managment']);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Access Role',
            'slug'=>'roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Create Role',
            'slug'=>'roles.create',
        ]);

        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Edit Role',
            'slug'=>'roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppRole->id,
            'name'=>'Delete Role',
            'slug'=>'roles.destroy',
        ]);

// User Managment
        $moduleAppuser=Module::updateOrCreate(['name'=>'User Managment']);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Access User',
            'slug'=>'users.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Create Users',
            'slug'=>'users.create',
        ]);

        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Edit User',
            'slug'=>'users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppuser->id,
            'name'=>'Delete User',
            'slug'=>'users.destroy',
        ]);

        //Module Managment
        $moduleAppmodule=Module::updateOrCreate(['name'=>'Module Managment']);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppmodule->id,
            'name'=>'Access Module',
            'slug'=>'modules.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppmodule->id,
            'name'=>'Create Module',
            'slug'=>'modules.create',
        ]);

        Permission::updateOrCreate([
            'module_id'=>$moduleAppmodule->id,
            'name'=>'Edit Module',
            'slug'=>'modules.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleAppmodule->id,
            'name'=>'Delete Module',
            'slug'=>'modules.destroy',
        ]);

        // Permission Managment
        $moduleApppermission=Module::updateOrCreate(['name'=>'Permission Managment']);
        Permission::updateOrCreate([
            'module_id'=>$moduleApppermission->id,
            'name'=>'Access Permission',
            'slug'=>'permissions.index',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleApppermission->id,
            'name'=>'Create Permission',
            'slug'=>'permissions.create',
        ]);

        Permission::updateOrCreate([
            'module_id'=>$moduleApppermission->id,
            'name'=>'Edit Permission',
            'slug'=>'permissions.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'=>$moduleApppermission->id,
            'name'=>'Delete Permission',
            'slug'=>'permissions.destroy',
        ]);

        

    }
}
