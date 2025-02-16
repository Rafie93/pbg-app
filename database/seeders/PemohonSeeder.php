<?php

namespace Database\Seeders;

use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PemohonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){ 
            $option_kecamatan = [
                6371030, 6371020, 6371010, 6371040, 6371031
            ];
            $kecamatan_id = $faker->randomElement($option_kecamatan);
            $kelurahan_id = DB::table('villages')
                        ->where('district_id', $kecamatan_id)
                        ->inRandomOrder()->first()->id;
            $name = $faker->name;
            $user = User::create([
                'name' => $name,
                'email' => $faker->email,
                'password' => bcrypt('12345678'),
                'role' => 3
            ]);
    		Pemohon::create([
    			'nama' =>$name,
    			'no_hp' => $faker->phoneNumber,
    			'jenis_identitas' => $faker->randomElement(['KTP', 'KITAS', 'SIM', 'Passport']),
    			'no_identitas' => $faker->nik,
                'pekerjaan' => $faker->jobTitle,
                'alamat' => $faker->streetAddress,
                'kecamatan_id' => $kecamatan_id,
                'kelurahan_id' => $kelurahan_id,
                'user_id' => $user->id
    		]);
 
    	}
    }
}
