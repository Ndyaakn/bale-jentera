<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function order_date()
    {
        return $this->belongsTo('App\OrderDate');
    }
    
    public function table()
    {
        return $this->belongsTo('App\Table');
    }
    
    public function order_menus()
    {
        return $this->hasMany('App\OrderMenu');
    }
}
