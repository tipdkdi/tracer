<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $fillable = [
        'step_nama',
        'step_kode',
        'step_urutan',
        'step_parent'
    ];

    public function stepChild()
    {
        return $this->hasMany('App\Models\Step', 'step_parent');
    }
    public function pertanyaan()
    {
        return $this->hasMany('App\Models\Pertanyaan');
    }
    public function bagianDirect()
    {
        return $this->hasOne('App\Models\BagianDirect');
    }
}
