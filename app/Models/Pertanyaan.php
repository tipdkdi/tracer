<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'step_id',
        'pertanyaan',
        'pertanyaan_urutan',
        'pertanyaan_jenis_jawaban',
        'required',
        'lainnya',
        'is_lokasi_kerja'
    ];

    public function step()
    {
        return $this->belongsTo('App\Models\Step',);
    }
    public function jawabanJenis()
    {
        return $this->hasMany('App\Models\JawabanJenis',);
    }
    public function jawaban()
    {
        return $this->hasMany('App\Models\Jawaban',);
    }
    public function textProperties()
    {
        return $this->hasOne('App\Models\TextProperties',);
    }
    public function jawabanLainnya()
    {
        return $this->hasOne('App\Models\JawabanLainnya',);
    }
    public function sum()
    {
        return $this->hasMany('App\Models\Jawaban')->selectRaw('id, sum(jawabans.jawaban) as sum_all')
            ->groupBy('jawabans.jawaban');
    }
}
