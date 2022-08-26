<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use App\FinancialStatementDescription;
use Illuminate\Contracts\View\View;

class FinancialCreditExport implements FromView, WithTitle
{
    use Exportable;
    
    private $dateFrom;
    private $dateTo;

    public function __construct($dateFrom, $dateTo)
    {
        $split_df = explode('-', $dateFrom);
        $this->date_from = $split_df[2] . '-' . $split_df[1] . '-' . $split_df[0];
        $split_dt = explode('-', $dateTo);
        $this->date_to = $split_dt[2] . '-' . $split_dt[1] . '-' . $split_dt[0];
    }
    
    public function view(): View 
    {
        $financial_statement['financial_statement'] = FinancialStatementDescription::with('financial_statement_title')->where('credit', '!=', 0)->whereHas('financial_statement_title', function($q){
            $q->whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to);
        })->get();
        
        $financial_statement['total_financial_statement'] = FinancialStatementDescription::with('financial_statement_title')->where('credit', '!=', 0)->whereHas('financial_statement_title', function($q){
            $q->whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to);
        })->sum('credit');

        return view('excel.financial_credit_export', $financial_statement);
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan pengeluaran';
    }
}
