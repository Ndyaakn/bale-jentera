<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Exportable;

class JournalMultiSheetExport implements WithMultipleSheets
{
    use Exportable;
    
    public function dateFrom($from)
    {
        $this->date_from = $from;
        
        return $this;
    }
    
    public function dateTo($to)
    {
        $this->date_to = $to;
        
        return $this;
    }
    
     /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            'Laporan keuangan' => new FinancialStatementExport($this->date_from, $this->date_to),
            'Laporan pengeluaran' => new FinancialCreditExport($this->date_from, $this->date_to),
            'Menu terlaris' => new JournalAllCategoryExport($this->date_from, $this->date_to),
            'Bahan keluar' => new JournalMaterialExport($this->date_from, $this->date_to),
            'Stok Bahan' => new MaterialExport($this->date_from, $this->date_to),
            'Dine in' => new JournalDineInExport($this->date_from, $this->date_to),
            'Go food' => new JournalGoFoodExport($this->date_from, $this->date_to),
            'Go food2' => new JournalGoFood2Export($this->date_from, $this->date_to),
            'Shopee' => new JournalShopeeExport($this->date_from, $this->date_to),
            'Grab food' => new JournalGrabFoodExport($this->date_from, $this->date_to),
            'PO' => new JournalPoExport($this->date_from, $this->date_to),
            'Take away' => new JournalTakeAwayExport($this->date_from, $this->date_to),
        ];
    }
}
