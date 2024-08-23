<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => "Airam",
            'email' => "airam.guedes@eivor.es",
            'password' => "Infor1212",
            'role_id' => 1,
            'status_id' => 1,
        ]);
    }
}
