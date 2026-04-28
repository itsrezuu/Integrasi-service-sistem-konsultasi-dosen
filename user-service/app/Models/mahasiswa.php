<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(
    'nim',
    'nama',
    'kelas',
    'prodi',
    'telp',
    'email',
)]

class mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
}