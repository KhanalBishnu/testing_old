<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            [
                'name'=>'Admin',
                'guard_name'=>'web'
            ],
            [
                'name'=>'User',
                'guard_name'=>'web'
            ],
        ];
        foreach($roles as $role)
        {
            Role::create($role);
        }
    }
}
