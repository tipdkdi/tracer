<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstOrLast extends Model
{
    use HasFactory;
    protected $fillable = [
        'step_id_first',
        'step_id_last',
    ];

    public function stepFirst()
    {
        return $this->belongsTo('App\Models\Step', 'step_id_first');
    }
    public function stepLast()
    {
        return $this->belongsTo('App\Models\Step', 'step_id_last');
    }
}
