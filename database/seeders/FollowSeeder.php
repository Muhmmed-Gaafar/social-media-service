<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FollowSeeder extends Seeder
{
    public function run()
    {

        \App\Models\Follow::factory()->count(50)->create();
    }
}

