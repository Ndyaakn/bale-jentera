<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function category_menu()
    {
        return $this->belongsTo('App\CategoryMenu');
    }
    
    public function material_menus()
    {
        return $this->hasMany('App\MaterialMenu');
    }
}
