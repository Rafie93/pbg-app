<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permohonanimb extends Model
{
    use HasFactory;
    protected $table = 'permohonanimb';
    protected $fillable = [
        "nomor",
        "tanggal_permohonan",
        "pemohon_id",
        "jenis_permohonan",
        "pemilik_bangunan",
        "kecamatan_id",
        "kelurahan_id",
        "alamat",
        "latitude",
        "longitude",
        "nama_bangunan",
        "fungsi_bangunan",
        "luas_bangunan",
        "jumlah_lantai",
        "tinggi_bangunan",
        "jenis_bangunan",
        "kondisi_bangunan",
        "durasi_pemanfaatan",
        "status_permohonan",
        "foto_bangunan",
        "keterangan"
    ];

    public function fungsiBangunan(){
        return $this->belongsTo(FungsiBangunan::class, "fungsi_bangunan");
    }
    public function jenisBangunan(){
        return $this->belongsTo(JenisBangunan::class, "jenis_bangunan");
    }

    public function pemohon(){
        return $this->belongsTo(Pemohon::class);
    }

    public function district(){
        $d = DB::table("districts")->where("id",$this->kecamatan_id)->first();
        return $d ? $d->name :"";
    }

    public function village(){
        $d = DB::table("villages")->where("id",$this->kelurahan_id)->first();
        return $d ? $d->name :"";
    }
}
