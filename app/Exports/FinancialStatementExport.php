<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\FinancialStatementTitle;

class FinancialStatementExport implements FromView, WithTitle
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
        $financial_statement['financial_statement'] = FinancialStatementTitle::whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to)->get();
        
        $financial_statement['total_debit'] = FinancialStatementTitle::whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to)->sum('total_debit');
        
        $financial_statement['total_credit'] = FinancialStatementTitle::whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to)->sum('total_credit');
        
        $financial_statement['total_saldo'] = FinancialStatementTitle::whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to)->sum('total_saldo');

        return view('excel.financial_statement', $financial_statement);
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan keuangan';
    }
}
