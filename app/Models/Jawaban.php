<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $fillable = [
        'sesi_id',
        'pertanyaan_id',
        'jawaban',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo('App\Models\Pertanyaan');
    }

    public function userSesi()
    {
        return $this->belongsTo('App\Models\UserSesi', 'sesi_id');
    }

    public function jawabanLainnya()
    {
        return $this->hasMany('App\Models\JawabanLainnya');
    }
}
