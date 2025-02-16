<?php

namespace Database\Seeders;

use App\Models\Permohonanimb;
use App\Models\Retribusi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RetribusiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $maks = DB::table('permohonanimb')->count();
    	for($i = 1; $i < $maks; $i++){ 
            $permohonanData = DB::table('permohonanimb')->select('id')->get();
            // permohonan id unique random
            $permohonan_id = $faker->unique()->randomElement($permohonanData)->id;
            $status_bayar = $faker->randomElement(['Dibayar', 'Belum Dibayar','Pembayaran Diterima','Pembayaran Ditolak']);
            $jumlah_tagihan = $faker->numberBetween(100000, 1000000);
            Retribusi::create([
                'permohonanimb_id' => $permohonan_id,
                'tanggal_tagihan' => $faker->dateTimeBetween('-1 month', 'now'),
                'tanggal_bayar' =>$status_bayar == 'Dibayar' || $status_bayar == 'Pembayaran Diterima' ? $faker->dateTimeBetween('-1 month', 'now') : null,
                'jumlah_tagihan' => $jumlah_tagihan,
                'jumlah_bayar' =>$status_bayar == 'Dibayar' || $status_bayar == 'Pembayaran Diterima' ? $jumlah_tagihan : 0,
                'keterangan' => "Pembayaran Untuk Penerbitan dan Survie",
                'bukti_pembayaran' =>$status_bayar == 'Dibayar' || $status_bayar == 'Pembayaran Diterima' ? "bukti_pembayaran/FRrjaE82Mc1oPcX28iNcXlsj8nKRTB7BVEE4GTZI.png" : null,
                'status_pembayaran' => $status_bayar,
            ]);
            Permohonanimb::where('id', $permohonan_id)->update(['status_permohonan' => 'Diproses']);
        }
    }
}
