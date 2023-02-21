<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create([
        //     'name' => 'Mirza Maulana',
        //     'email' => 'mirzamaulana.dev@gmail.com',
        //     'role' => 'SuperAdmin',
        //     'jenis_kelamin' => 'Laki-Laki'
        // ]);
        // \App\Models\User::factory(100)->create(
        //     ['status' => 'Active']
        // );
        $this->call(UserSeeder::class);

        \App\Models\Category::factory()->create([
            'name' => 'Web Programming',
            'created_by' => 'Mamang Moonton',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Web Design',
            'created_by' => 'Mamang Moonton',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'UI/UX',
            'created_by' => 'Mamang Moonton',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Android Devoloper',
            'created_by' => 'Mamang Moonton',
        ]);

        \App\Models\Tags::factory()->create([
            'name' => 'Programming',
            'created_by' => 'Mamang Moonton',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Design',
            'created_by' => 'Mamang Moonton',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'UI/UX',
            'created_by' => 'Mamang Moonton',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Game',
            'created_by' => 'Mamang Moonton',
        ]);
    }
}
