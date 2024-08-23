<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statuses\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create(['status' => 'Activo']);
        Status::create(['status' => 'Inactivo']);
    }
}
