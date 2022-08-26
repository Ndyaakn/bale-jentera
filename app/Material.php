<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function material_menus()
    {
        return $this->hasMany('App\MaterialMenu');
    }
}
