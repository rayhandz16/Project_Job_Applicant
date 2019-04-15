<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_applicant = new Role();
        $role_applicant->name = 'Applicant';
        $role_applicant->description = 'A applicant User';
        $role_applicant->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'A Admin User';
        $role_admin->save();
    }
}
