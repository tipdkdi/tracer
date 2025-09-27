<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniSurvei extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun_lulus',
        'nama',
        'nim',
        'prodi',
        'desa_kel',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'nama_ortu',
        'ortu_desa_kel',
        'ortu_kecamatan',
        'ortu_kabupaten',
        'ortu_provinsi',
        'no_hp',
    ];
}
