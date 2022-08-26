<?php

namespace App\Console\Commands;

use App\FinancialStatementTitle;
use Illuminate\Console\Command;
use App\OrderDate;
use Carbon\Carbon;
use App\Menu;

class FinancialStatementSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'financial:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Financial Schedule';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $menu = Menu::where('category_order', '["dinein"]')->update([
           'category_order' => 'dinein'
        ]);
        
        $jurnal = OrderDate::where('date', Carbon::now(8)->format('d-m-Y'))->first();
        if($jurnal == null) {
            OrderDate::create([
               'date' => Carbon::now(8)->format('d-m-Y')
            ]);
        }
        
        $financial = FinancialStatementTitle::where('date', Carbon::now(8)->format('d-m-Y'))->first();
        if($financial == null) {
            FinancialStatementTitle::create([
               'date' => Carbon::now(8)->format('d-m-Y')
            ]);
        }
        
        $financial_statement = FinancialStatementTitle::orderBy('id', 'desc')->get();
        foreach($financial_statement as $item_1)
        {
            $total_debit = 0;
            $total_credit = 0;
            $total_saldo = 0;
            if($item_1->financial_statement_descriptions == true)
            {
                foreach($item_1->financial_statement_descriptions as $item_2)
                {
                    $total_debit += $item_2->debit;
                    $total_credit += $item_2->credit;
                }
                $item_1->update([
                    'total_debit' => $total_debit,
                    'total_credit' => $total_credit,
                    'total_saldo' => $total_debit - $total_credit,
                ]);
            } else {
                $item_1->update([
                    'total_debit' => 0,
                    'total_credit' => 0,
                    'total_saldo' => 0,
                ]);
            }
        }
    }
}