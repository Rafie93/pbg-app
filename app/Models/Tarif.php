<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $table = 'tarif';
    protected $fillable = [
        'jenis_permohonan',
        'kepemilikan',
        'fungsi_bangunan_id',
        'durasi_pemanfaatan',
        'min_luas_bangunan',
        'max_luas_bangunan',
        'min_jumlah_lantai',
        'max_jumlah_lantai',
        'tarif'
    ];

    public function fungsibangunan()
    {
        return $this->belongsTo(FungsiBangunan::class, 'fungsi_bangunan_id');
    }
}
