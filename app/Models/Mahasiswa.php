<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'iddata',
        'nim',
        'data_diri_id',
        'organisasi_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function dataDiri()
    {
        return $this->belongsTo('App\Models\DataDiri');
    }
    public function prodi()
    {
        return $this->belongsTo('App\Models\Organisasi', 'organisasi_id');
    }
}
