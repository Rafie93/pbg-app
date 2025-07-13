<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Survie extends Model
{
    use HasFactory;
    protected $table = 'survie';
    protected $fillable = [
        'permohonan_id',
        'jenis',
        'petugas_id',
        'tanggal_berangkat',
        'kecamatan_id',
        'kelurahan_id',
        'alamat',
        'latitude',
        'longitude',
        'fungsi_bangunan',
        'jenis_bangunan',
        'keterangan',
        'is_mangkrak',
        'is_kosong',
        'is_miring',
        'foto_survie',
        
    ];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanImb::class, 'permohonan_id');
    }
    public function permohonanreklame()
    {
        return $this->belongsTo(Reklame::class, 'permohonan_id');
    }
    public function petugas(){
        return $this->belongsTo(User::class,'petugas_id');
    }
    public function fungsiBangunan(){
        return $this->belongsTo(FungsiBangunan::class, "fungsi_bangunan");
    }
    public function jenisBangunan(){
        return $this->belongsTo(JenisBangunan::class, "jenis_bangunan");
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
