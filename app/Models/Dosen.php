<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_dosen',
        'nama',
        'alamat',
        'tgl_lahir',
        'email',
        'telp',
        'prodi',
        'fakultas',
        'foto',
    ];
}
