<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_applicant = Role::where('name', 'applicant')
        ->first();
        $role_admin = Role::where('name', 'admin')
        ->first();
        
        $applicant = new User();
        $applicant->name = 'Applicant Name';
        $applicant->email = 'applicant@example.com';
        $applicant->password = bcrypt('secret');
        $applicant->save();
        $applicant->roles()->attach($role_applicant);
        
        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
