<?php

namespace App\Http\Controllers;

use App\FinancialStatementDescription;
use App\Http\Controllers\Controller;
use App\FinancialStatementTitle;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\OrderDate;
use App\OrderMenu;
use App\Material;
use App\Order;
use App\Menu;

class ApiBillController extends Controller
{
    public function index()
    {
        $status = 'OK';
        $status_code = 'DBC-200';
        $message = 'Berhasil menampilkan data bill';
        $order_date = OrderDate::where('date', Carbon::now()->format('d-m-Y'))->first();
        $dataorder = Order::with('order_menus.menu.material_menus')->where([
            // ['order_date_id', $order_date->id],
            ['order_status', 'bill']])->get();
       
        return response()->json(compact('status', 'status_code', 'message', 'dataorder'), 200);
    }
    
    public function updatestatus()
    {
        $status = 'OK';
        $status_code = 'DBC-200';
        $message = 'Berhasil mengubah data';
        $dataorder = Order::with('order_menus.menu.material_menus')->findOrFail(request('id'));
        
        if(request('status') == 'pay')
        {
            $financial = FinancialStatementTitle::where('date', Carbon::now()->format('d-m-Y'))->first();
            if($financial == null){
                $financial = FinancialStatementTitle::create([
                    'date' => Carbon::now()->format('d-m-Y')
                ]);
            }
            $desc = null;
            foreach($dataorder->order_menus as $item)
            {
                $desc = $desc . '<br>' . $item->menu->name . ' | Jumlah : ' . $item->amount;
            }
            FinancialStatementDescription::create([
                'order_id' => $dataorder->id,
                'financial_statement_id' => $financial->id,
                'debit' => $dataorder->total_payment ?? 0,
                'description' => $desc
            ]);
        }
        
        $dataorder->update(['order_status' => request('status')]);
       
        return response()->json(compact('status', 'status_code', 'message', 'dataorder'), 200);
    }
}
