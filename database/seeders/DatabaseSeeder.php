<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Super Admin',
        //     'email' => 'super@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'role'=>1
        // ]);
        // $this->call(PemohonSeeder::class);
        // $this->call(PermohonanSeeder::class);
        // $this->call(RetribusiSeeder::class);
        // $this->call(SurvieSeeder::class);
        $this->call(PenerbitanSeeder::class);
        
    }
}
