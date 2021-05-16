<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'admin',
               'email'=>'admin@yoursite.com',
               'company_id'=>'1',
               'role_id'=>'1',
               'password'=> bcrypt('87654321'),
            ],
            [
               'name'=>'user',
               'email'=>'user@yoursite.com',
               'company_id'=>'11',
               'role_id'=>'0',
               'password'=> bcrypt('12345678'),
            ],
            [
               'name'=>'guest',
               'email'=>'guest@yoursite.com',
               'company_id'=>'111',
                'role_id'=>'2',
               'password'=> bcrypt('12345678'),
            ],
        ];
  
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}