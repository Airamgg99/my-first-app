<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['role' => 'Admin']);
        Role::create(['role' => 'User']);
    }
}
