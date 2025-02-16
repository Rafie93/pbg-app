<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pemohon extends Model
{
    use HasFactory;
    protected $table = "pemohon";
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_identitas',
        'no_identitas',
        'no_hp',
        'pekerjaan',
        'alamat',
        'city_id',
        'kecamatan_id',
        'kelurahan_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
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
