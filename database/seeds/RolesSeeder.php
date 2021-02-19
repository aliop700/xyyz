<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Consts\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id'    =>  Roles::ADMIN,
            'name'  =>  'admin'
        ]);
        Role::create([
            'id'    =>  Roles::USER,
            'name'  =>  'client'
        ]);
    }
}
