<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanRedirect extends Model
{
    use HasFactory;
    protected $fillable = [
        'step_id_redirect',
        'jawaban_jenis_id'
    ];

    public function step()
    {
        return $this->belongsTo('App\Models\Step', 'step_id_redirect');
    }
    public function jawabanJenis()
    {
        return $this->belongsTo('App\Models\jawabanJenis');
    }
}
