<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBangunan extends Model
{
    use HasFactory;
    protected $table = 'jenis_bangunan';
    protected $fillable = ['nama','status'];
}
