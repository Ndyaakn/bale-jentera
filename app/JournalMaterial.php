<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalMaterial extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function material()
    {
        return $this->belongsTo('App\Material');
    }
}
