<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSesi extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sesi_tanggal',
        'sesi_periode',
        'sesi_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Models\Jawaban', 'sesi_id');
    }
}
