<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  => 'admin',
            'email' =>'admin@cars.com',
            'password' => Hash::make('1234'),
            'lang'      =>  'en',
            'phone'      =>  '1111',
            'street'      =>  '1111',
            'country'      =>  '1111',
            'city'      =>  '1111',
            'role_id'      =>  '1',

        ]);
        User::create([
            'name'  => 'user',
            'email' =>'user@cars.com',
            'password' => Hash::make('1234'),
            'lang'      =>  'en',
            'phone'      =>  '1111',
            'street'      =>  '1111',
            'country'      =>  '1111',
            'city'      =>  '1111',
            'role_id'      =>  '2',

        ]);
    }
}
