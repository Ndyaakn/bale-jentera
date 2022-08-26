<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialStatementDescription extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    
    public function financial_statement_title()
    {
        return $this->belongsTo('App\FinancialStatementTitle', 'financial_statement_id');
    }
}
