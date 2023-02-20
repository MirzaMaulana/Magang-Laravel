<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->SuperAdmin()->count(1)->create([
            'email' => 'admin@test.com'
        ]);
        User::factory()->count(50)->create();
    }
}
