<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerbitanImb extends Model
{
    use HasFactory;
    protected $table = 'penerbitan_imb';
    protected $fillable = [
        'nomor_imb',
        'permohonanimb_id',
        'tanggal_penerbitan',
        'penanda_tangan',
        'jabatan_penanda_tangan',
        'nip_penanda_tangan'
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonanimb::class, 'permohonanimb_id');
    }
}
