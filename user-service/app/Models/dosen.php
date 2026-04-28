<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(
    'nip',
    'nama',
    'prodi',
    'telp',
    'email',
)]
class dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
}
