<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerbitanImb extends Model
{
    use HasFactory;
    protected $table = 'penerbitan';
    protected $fillable = [
        'nomor',
        'jenis',
        'permohonan_id',
        'tanggal_penerbitan',
        'tanggal_kadaluarsa',
        'penanda_tangan',
        'jabatan_penanda_tangan',
        'nip_penanda_tangan'
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonanimb::class, 'permohonan_id');
    }
    public function permohonanreklame()
    {
        return $this->belongsTo(Reklame::class, 'permohonan_id');
    }
}
