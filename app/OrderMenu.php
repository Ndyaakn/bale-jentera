<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    protected $guarded = [
        'id'  
    ];
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
