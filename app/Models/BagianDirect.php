<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianDirect extends Model
{
    use HasFactory;
    protected $fillable = [
        'step_id',
        'step_id_direct',
        'step_id_direct_back',
        'is_direct_by_jawaban',
        'is_first',
        'is_last',
    ];

    public function step()
    {
        return $this->belongsTo('App\Models\Step');
    }
    public function stepDirect()
    {
        return $this->belongsTo('App\Models\Step', 'step_id_direct');
    }
    public function stepDirectBack()
    {
        return $this->belongsTo('App\Models\Step', 'step_id_direct_back');
    }
}
