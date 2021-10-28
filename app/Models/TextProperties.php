<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextProperties extends Model
{
    use HasFactory;
    protected $fillable = [
        'pertanyaan_id',
        'jenis'
    ];

    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Pertanyaan');
    }
}
