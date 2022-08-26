<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialMenu extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
    
    public function material()
    {
        return $this->belongsTo('App\Material');
    }
}
