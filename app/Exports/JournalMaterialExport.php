<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\JournalMaterial;

class JournalMaterialExport implements FromView, WithTitle
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
        $journal_material['journal_material'] = JournalMaterial::whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to)->get();
        
        return view('excel.journal-material', $journal_material);
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Bahan masuk & keluar';
    }
}
