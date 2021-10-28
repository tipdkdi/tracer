<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanLainnya extends Model
{
    use HasFactory;
    protected $fillable = [
        'pertanyaan_id',
        'jawaban'
    ];

    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Pertanyaan');
    }
}
