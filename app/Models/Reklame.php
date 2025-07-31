<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reklame extends Model
{
    use HasFactory;
    protected $table = 'reklame';
    protected $fillable = [
        "nomor",
        "pemohon_id",
        "tanggal_permohonan",
        "jenis_reklame",
        "teks_reklame",
        "jumlah_reklame",
        "ukuran",
        "kecamatan_id",
        "kelurahan_id",
        "durasi_pemanfaatan",
        "foto_bangunan",
        "keterangan",
        "alamat",
        "latitude",
        "longitude",
        "status_permohonan"
    ];
    public $timestamps = false;


    public function status_survei(){
        $sur = Survie::where('permohonan_id',$this->id)
                ->where('jenis','Reklame')
                ->whereNotNull('foto_survie')
                ->first();
        return $sur ? 'Sudah Survei' : 'Belum Survei';
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
