<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\JournalOrder;
use Carbon\Carbon;
use App\OrderDate;
use App\Menu;

class JournalAllCategorySchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'journal-all-category:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Journal all category Schedule';

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
        $journal_1 = JournalOrder::where('date', Carbon::now(8)->format('d-m-Y'))->get();
        foreach($journal_1 as $item_1)
        {
            $journal_2 = JournalOrder::where([['menu', $item_1->menu], ['order_category', 'AllCategory']])->first();
            $journal_3 = JournalOrder::where([['menu', $item_1->menu], ['order_category', '!=', 'AllCategory']])->get();    
            $amount = 0;
            foreach($journal_3 as $item_2)
            {
                $amount += $item_2->amount;
            }
            if($journal_2 != null) {
                $journal_2->update([
                   'amount' => $amount
                ]);
            } else {
                JournalOrder::create([
                   'date' => $item_1->date,
                   'menu' => $item_1->menu,
                   'amount' => $amount,
                   'order_category' => 'AllCategory'
                ]);
            }
        }
        
        $order_date = OrderDate::orderBy('id', 'desc')->get();
        foreach($order_date->orders as $order) 
        {
            foreach($order->order_menus as $order_menu)
            {
                $journal = JournalOrder::where([['menu', $order_menu->menu->name], ['order_category', $order->order_category]])->first();
                if($journal != null) {
                    $journal->update([
                       'amount'  => $journal->amount + $order_menu->amount
                    ]);
                } else {
                    JournalOrder::create([
                        'date' => Carbon::now(8)->format('d-m-Y'),
                        'menu'  => $order_menu->menu->name,
                        'amount' => $order_menu->amount,
                        'order_category' => $order->order_category
                    ]);
                }
            }
        }
    }
}