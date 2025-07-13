<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penandatangan extends Model
{
    use HasFactory;
    protected $table = "penanda_tangan";
    protected $fillable = ["nama","nip","jabatan"];
}
