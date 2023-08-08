<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'role_id'=>Role::where('slug','super-admin')->first()->id,
            'name'=>'Super Admin',
            'full_name'=>'Super Admin',
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make('password'),
            'is_active'=>1,
            'profile_pic'=>'',
        ]);
        User::updateOrCreate([
            'role_id'=>Role::where('slug','admin')->first()->id,
            'name'=>'Admin',
            'full_name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('password'),
            'is_active'=>1,
            'profile_pic'=>'',
        ]);
        User::updateOrCreate([
            'role_id'=>Role::where('slug','teacher')->first()->id,
            'name'=>'Teacher',
            'full_name'=>'Teacher',
            'email'=>'teacher@gmail.com',
            'password'=>Hash::make('password'),
            'is_active'=>1,
            'profile_pic'=>'',
        ]);
        User::updateOrCreate([
            'role_id'=>Role::where('slug','student')->first()->id,
            'name'=>'Student',
            'full_name'=>'Student',
            'email'=>'student@gmail.com',
            'password'=>Hash::make('password'),
            'is_active'=>1,
            'profile_pic'=>'',
        ]);
    }
}
