<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nbi',
        'nama',
        'telp',
        'alamat',
        'email',
        'tgl_lahir',
        'prodi',
        'fakultas',
        'ipk',
        'dosen_wali',
        'foto',
    ];
}
