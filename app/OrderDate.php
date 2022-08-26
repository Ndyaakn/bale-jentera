<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDate extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
