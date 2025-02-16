<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retribusi extends Model
{
    use HasFactory;
    protected $table = 'retribusi';
    protected $fillable = [
        'permohonanimb_id',
        'tanggal_tagihan',
        'tanggal_bayar',
        'jumlah_tagihan',
        'jumlah_bayar',
        'keterangan',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanImb::class, 'permohonanimb_id');
    }
}
