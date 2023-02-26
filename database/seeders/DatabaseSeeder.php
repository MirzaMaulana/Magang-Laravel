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
        $this->call(PostSeeder::class);

        \App\Models\Category::factory()->create([
            'name' => 'Web Programming',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Web Design',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'UI/UX',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Mobile Development',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Data Science',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Cloud Computing',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Artificial Intelligence',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Front End Devoloper',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Game Devoloper',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Personal',
        ]);

        \App\Models\Tags::factory()->create([
            'name' => 'Programming',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Design',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'UI/UX',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Game',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Database',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Machine Learning',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Networking',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Security',
        ]);

        \App\Models\Tags::factory()->create([
            'name' => 'Web',
        ]);
        \App\Models\Tags::factory()->create([
            'name' => 'Negara',
        ]);
    }
}
