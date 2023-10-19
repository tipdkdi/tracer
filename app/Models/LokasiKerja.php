<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'sesi_id',
        'pertanyaan_id',
        'jawaban',
        'is_provinsi',
        'is_kabupaten',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo('App\Models\Pertanyaan');
    }

    public function userSesi()
    {
        return $this->belongsTo('App\Models\UserSesi', 'sesi_id');
    }
}
