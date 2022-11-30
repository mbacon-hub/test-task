<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::factory()->create([
            "email" => "admin@test.com"
        ]);

        //Client
        User::factory()->create([
            "email" => "test@test.com"
        ]);
    }
}
