<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable('tanggal', 'waktu_mulai', 'waktu_selesai', 'kode_mk')]
class Jadwal extends Model
{
    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'kode_mk',
    ];
}
