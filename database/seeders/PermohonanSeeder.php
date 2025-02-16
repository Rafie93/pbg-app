<?php

namespace Database\Seeders;

use App\Models\Pemohon;
use App\Models\Permohonanimb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 60; $i++){ 
            $option_pemohon = Pemohon::all()->pluck('id')->toArray();
            $pemohon_id = $faker->randomElement($option_pemohon);
            $pemohonData = Pemohon::find($pemohon_id);
            $kecamatan_id = $pemohonData->kecamatan_id;
            $kelurahan_id = $pemohonData->kelurahan_id;
            $alamat = $pemohonData->alamat;


            Permohonanimb::create([
                'nomor' =>  $faker->unique()->numerify('240216-###'),
                'tanggal_permohonan' => $faker->dateTimeBetween('-1 month', 'now'),
                'pemohon_id' => $pemohon_id,
                'jenis_permohonan' => 'PBG',
                'pemilik_bangunan' => $faker->randomElement(['Perseorangan', 'Perusahaan','Badan Hukum','Pemerintah']),
                'kecamatan_id' => $kecamatan_id,
                'kelurahan_id' => $kelurahan_id,
                'alamat' => $alamat,
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'nama_bangunan' => $faker->company,
                'fungsi_bangunan' =>  $faker->numberBetween(1, 5),
                'jenis_bangunan' => $faker->numberBetween(1, 3),
                'luas_bangunan' => $faker->numberBetween(100, 1000),
                'jumlah_lantai' => $faker->numberBetween(1, 3),
                'tinggi_bangunan' => $faker->numberBetween(1, 10),
                'kondisi_bangunan' => $faker->randomElement(['Sudah Berdiri', 'Belum Berdiri','Sedang Dibangun']),
                'durasi_pemanfaatan'  => $faker->randomElement(['> 5 Tahun', '< 5 Tahun']),
                'status_permohonan' => 'Diajukan'
            ]);
        }
    }
}
