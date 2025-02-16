<?php

namespace Database\Seeders;

use App\Models\Permohonanimb;
use App\Models\Retribusi;
use App\Models\Survie;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class SurvieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');
        $maks = Retribusi::where('status_pembayaran', 'Pembayaran Diterima')->count();
        for($i = 1; $i < $maks; $i++){ 
            $option_permohonan =  Permohonanimb::whereIn('id',Retribusi::where('status_pembayaran','Pembayaran Diterima')
                                            ->pluck('permohonanimb_id'))
                                            ->get();
            
            $permohonan_id = $faker->unique()->randomElement($option_permohonan)->id;
            $petugas_id = $faker->randomElement(User::where('role',3)->get())->id;
            $permohonanData = Permohonanimb::where('id',$permohonan_id)->first();
            Survie::create(
            [
                'permohonanimb_id' => $permohonan_id,
                'petugas_id' => $petugas_id,
                'tanggal_berangkat' => $faker->dateTimeBetween('now'),
                'kecamatan_id' => $permohonanData->kecamatan_id,
                'kelurahan_id' => $permohonanData->kelurahan_id,
                'alamat' => $permohonanData->alamat,
                'latitude' => $permohonanData->latitude,
                'longitude' => $permohonanData->longitude,
                'fungsi_bangunan' => $permohonanData->fungsi_bangunan,
                'jenis_bangunan' => $permohonanData->jenis_bangunan,
                'keterangan' => $permohonanData->keterangan,
                'is_mangkrak' => $faker->randomElement([0,1]),
                'is_kosong'  => $faker->randomElement([0,1]),
                'is_miring'  => $faker->randomElement([0,1]),
                'foto_survie' => 'survie/1.jpg'
            ]
            );
        }
    }
}
