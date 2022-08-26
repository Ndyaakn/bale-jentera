<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use App\FinancialStatementDescription;
use Illuminate\Contracts\View\View;
use App\Menu;

class JournalTakeAwayExport implements FromView, WithTitle
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
        $data = FinancialStatementDescription::with('financial_statement_title', 'order.order_menus')->whereHas('order', function($q){
             $q->where([['order_category', 'personal'], ['order_status', 'pay']]);
         })
         ->whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to)->get();
         $journal_1 = [];
         foreach($data as $item)
         {  
            $journal_2 = [];
            $journal_3 = [];
            $journal_4 = [];
            $explode_1 = explode('<br>', $item->description);
            foreach($explode_1 as $item_1)
            {
                if($item_1 != "")
                {
                    $explode_2 = explode(' | ', $item_1);
                    $explode_3 = explode(' : ', $explode_2[1]);
                    $menu = Menu::where('name', $explode_2[0])->first();
                    array_push($journal_2, $explode_2[0]);
                    array_push($journal_3, $explode_3[1]);
                    if($menu != null)
                    {
                        array_push($journal_4, $menu->price);
                    } else {
                        array_push($journal_4, 0);
                    }
                }
            }
            $journal_4 = ['date' => $item->financial_statement_title->date, 'price' => $item->debit, 'menu' => $journal_2, 'jumlah_menu' => $journal_3, 'harga_menu' => $journal_4, 'rowspan' => count($journal_2)];
            array_push($journal_1, $journal_4);
         }
        //  dd($journal_1);
         $journal['journal'] = $journal_1;
         $journal['total'] = $data->sum('debit');

        return view('excel.journal', $journal);
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Take away';
    }
}
