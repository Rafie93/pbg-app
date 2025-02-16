<?php

namespace App\Imports;

use App\Models\PelakuEkraf;
use App\Models\Sektor;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EkrafImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // DB::beginTransaction();
        // try {
             foreach ($rows as $row) {
               
                $data_sektor = Sektor::where("name","LIKE","%".$row['sektor']."%")->first();
                $sektor_id = $data_sektor ? $data_sektor->id : 15;
                $city_id=6371;
                $kecamatan = DB::table("districts")
                                ->where("city_id",$city_id)
                                ->where("name","LIKE","%".$row['kecamatan']."%")
                                ->first();
                $district_id = $kecamatan ? $kecamatan->id : 6371010;

                $kelurahan = DB::table("villages")
                                ->where("district_id",$district_id)
                                ->where("name","LIKE","%".$row['kelurahan']."%")
                                ->first();
                $village_id = $kelurahan ? $kelurahan->id : 6371010001;
                $email = $row["email"];
                $isAdaUser = User::where('email',$email)->first();
                if( $isAdaUser ) {
                    $explode =explode('@',$row['email']);
                    $randoom = rand(1,20);
                    $email = $explode[0].$randoom.'@'.$explode[1];
                    $isAdaUser2 = User::where('email',$email)->first();
                    if( $isAdaUser2 ) {
                        $explode2 =explode('@',$row['email']);
                        $randoom2 = rand(20,30);
                        $email = $explode2[0].$randoom2.'@'.$explode2[1];
                    }
                }
                $user = User::create([
                    "name"=> $row['owner'],
                    "email" => $email,
                    "password"=> bcrypt($email),
                    "role" => 4
                ]);
                $pelaku_ekraf = PelakuEkraf::create([
                    "sektor_id" => $sektor_id,
                    "city_id" => $city_id,
                    "district_id" =>$district_id,
                    "village_id" => $village_id,
                    "user_id" => $user->id,
                    "nama"  => $row["nama_usaha"],
                    "alamat"  => $row["alamat_usaha"],
                    "kontak"  => $row["kontak"],
                    "email"  => $row["email"],
                    "website"  => "",
                    "medsos"  => $row["medsos"],
                    "legalitas"  => $row["legalitas"],
                    "punya_izin"  => $row["punya_izin"],
                    "tanggal_berdiri"  => null,//$row["tanggal_berdiri"],
                    "no_nib"  => $row["no_nib"],
                    "no_akta" => $row["no_akta"],
                    "no_kemenkumham"  => $row["no_kemenkumham"],
                    "status" => 2,
                    "owner"  => $row["owner"],
                    "nik"  => $row["nik"],
                    "domisili"  => $row["domisili"],
                    "jk"  => $row["jk"],
                    "tgl_lahir"  =>null,// $row["tgl_lahir"],
                    "npwp"  => $row["npwp"],
                    "no_hp_owner"  => $row["no_hp_owner"],
                    "tenaga_kerja" => $row["tenaga_kerja"], 
                    "omzet_rata_rata" =>""
                ]);
             }
             DB::commit();
        //     }catch (\Throwable $th) {
        //         DB::rollback();
        //  }
    }
}
