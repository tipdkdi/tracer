<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanJenis extends Model
{
    use HasFactory;
    protected $fillable = [
        'pertanyaan_id',
        'pilihan_jawaban',
        'urutan'
    ];

    public function pertanyaan()
    {
        return $this->belongsTo('App\Models\Pertanyaan',);
    }

    public function jawabanRedirect()
    {
        return $this->hasOne('App\Models\JawabanRedirect',);
    }
    // public function jawabanRedirect()
    // {
    //     return $this->hasMany('App\Models\jawabanRedirect');
    // }
}
