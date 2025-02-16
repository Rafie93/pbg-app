<?php

namespace Database\Seeders;

use App\Models\PenerbitanImb;
use App\Models\Permohonanimb;
use App\Models\Survie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class PenerbitanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $maks = Survie::count();
        for($i = 1; $i < $maks; $i++){ 
            $option_permohonan = Permohonanimb::whereIn('status_permohonan',
                                ['Diproses'])
                                ->whereIn('id',Survie::whereNotNull('foto_survie')
                                ->pluck('id'))
                                ->get();

            $permohonan_id = $faker->unique()->randomElement($option_permohonan)->id;

            PenerbitanImb::create([
                'nomor_imb' => $faker->unique()->numerify('####/PBG/2025'),
                'permohonanimb_id' => $permohonan_id,
                'tanggal_penerbitan' => $faker->dateTimeBetween('now'),
                'penanda_tangan' => 'Ir. Suri Sudarmadiyah, M.T',
                'jabatan_penanda_tangan'=> 'Ketua',
                'nip_penanda_tangan'=>'-'
            ]);

            Permohonanimb::where('id',$permohonan_id)->update([
                'status_permohonan' => "PBG Diterbitkan"
            ]);
        }
    }
}
