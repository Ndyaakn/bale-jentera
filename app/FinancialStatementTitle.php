<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialStatementTitle extends Model
{
    protected $guarded = [
        'id'
    ];
    
    public function financial_statement_descriptions()
    {
        return $this->hasMany('App\FinancialStatementDescription', 'financial_statement_id');
    }
}
