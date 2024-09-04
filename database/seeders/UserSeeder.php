<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'username' => 'User User',
             'email' => 'user@gmail.com',
             'password' => '123123123',
         ]);
        User::factory()->count(10)->create();
    }
}
