<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password'),
            ],
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('password'),
            ],
        ];
        foreach($users as $user){
            $userRole=User::create($user);
            if($userRole['name']=='Admin'){
                $userRole->assignRole(Role::where('name','Admin')->first());

            }
            if($userRole['name']=='User'){
                $userRole->assignRole(Role::where('name','User')->first());

            }
        }
    }
}
