<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FungsiBangunan extends Model
{
    use HasFactory;
    protected $table = 'fungsi_bangunan';
    protected $fillable = ['nama','status'];
}
