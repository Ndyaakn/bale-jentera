<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\OrderMenu;
use App\Menu;

class JournalAllCategoryExport implements FromView, WithTitle
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
        $menu['menu'] = Menu::orderBy('id', 'desc')->get();
        foreach($menu['menu'] as $key => $item)
        {
            $menu['menu'][$key]['amount'] = OrderMenu::whereHas('order', function($q){
                $q->whereHas('order_date', function($q1){
                    $q1->whereDate('created_at', '>=', $this->date_from)->whereDate('created_at', '<=', $this->date_to);
                });
            })->where('menu_id', $item->id)->get()->sum('amount');
        }

        return view('excel.journal-all-category', $menu);
    }
    
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Menu terlaris';
    }
}
