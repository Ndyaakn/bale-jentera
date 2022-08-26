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

class ApiOrderController extends Controller
{
    public function orderCategory()
    {
        $order_category = [['category' => 'dine in'], ['category' => 'grabfood'], ['category' => 'gofood'], ['category' => 'po'], ['category' => 'take away']];

        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'order_category'), 200);
    }
    
    public function store()
    {
        $order_date = OrderDate::where('date', Carbon::now()->format('d-m-Y'))->first();
        if($order_date == null){
            $order_date = OrderDate::create([
                'date' => Carbon::now()->format('d-m-Y')
            ]);
        }
        $order = Order::create([
          'order_date_id' => $order_date->id,
          'table_id' => request('table_id'),
          'customer_name' => request('customer_name'),
        //   'information' => request('information'),
          'order_category' => request('order_category'),
          'pembayaran' => request('pembayaran'),
          'order_status' => 'bill',
          'discount_order' => request('discount_order'),
          'total_payment' => request('total_payment'),
          'total_payment_before_discount' => request('total_payment_before_discount') ?? 0
        ]);
        
        ActivityHistory::create([
            'user_id' => '1',
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Tambah order -> ' . $order_date->date . ', ' . request('customer_name') . ', ' . request('order_category') 
        ]);

        $menu_id = explode(",", request('menu_id'));
        $amount = explode(",", request('amount'));
        
        if(request('information') != null){
            $information = explode(",", request('information'));
        }
        
        // $price = 0;
        for ($i=0; $i < count($menu_id) ; $i++) {
            if(request('information') != null){
                $order_menu = OrderMenu::create([
                    'order_id' => $order->id,
                    'menu_id' => (int)$menu_id[$i],
                    'information' => $information[$i],
                    'amount' => (int)$amount[$i]
                ]);
            } else {
                $order_menu = OrderMenu::create([
                    'order_id' => $order->id,
                    'menu_id' => (int)$menu_id[$i],
                    'information' => '',
                    'amount' => (int)$amount[$i]
                ]);
            }
            
            // if(request('order_category') == 'gofood'){
            //     if($order->discount_grabfood != 0)
            //     {
            //         $price = ($price + ($order_menu->menu->price_gofood * $order_menu->amount));
            //         $price = $price - ($order->discount_grabfood/100 * $price);
            //     } else {
            //         $price = $price + ($order_menu->menu->price_gofood * $order_menu->amount);
            //     }   
            // } elseif(request('order_category') == 'grabfood'){
            //     if($order->discount_gofood != 0)
            //     {
            //         $price = ($price + ($order_menu->menu->price_grabfood * $order_menu->amount));
            //         $price = $price - ($order->discount_gofood/100 * $price);
            //     } else {
            //         $price = $price + ($order_menu->menu->price_grabfood * $order_menu->amount);
            //     }   
            // } else {
            //     if($order->discount != 0)
            //     {
            //         $price = ($price + ($order_menu->menu->price * $order_menu->amount));
            //         $price = $price - ($order->discount/100 * $price);
            //     } else {
            //         $price = $price + ($order_menu->menu->price * $order_menu->amount);
            //     }   
            // }
            
            $menu_order = Menu::where('id', $order_menu->menu_id)->first();
            if(count($menu_order->material_menus) > 0)
            {
                foreach($menu_order->material_menus as $item)
                {
                    $material = Material::where([['id', $item->material_id], ['stock', '!=', '999999']])->first();
                    if($material != null)
                    {
                        $material->update([
                          'stock' =>  $material->stock - ($item->stock_required * $order_menu->amount)
                        ]);
                    }
                }
                
            }
        }
        
        // if(request('total_payment_manual') != '' || request('total_payment_manual') != null || request('total_payment_manual') != 0)
        // {
        //     $order->update([
        //       'total_payment' => request('total_payment_manual')
        //     ]);
        // } else {
        //     $order->update([
        //       'total_payment' => $price
        //     ]);
        // }
        
        // $financial = FinancialStatementTitle::where('date', Carbon::now()->format('d-m-Y'))->first();
        // $desc = null;
        // foreach($order->order_menus as $item)
        // {
        //     $desc = $desc . '<br>' . $item->menu->name . ' | Jumlah : ' . $item->amount;
        // }
        // FinancialStatementDescription::create([
        //     'order_id' => $order->id,
        //     'financial_statement_id' => $financial->id,
        //     'debit' => request('total_payment_before_discount') ?? 0,
        //     'description' => $desc
        // ]);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil membuat data";
        return response()->json(compact('status', 'status_code', 'message', 'order'), 200);
        // return response()->json(compact('order_date'), 200);
    }
    
    public function edit($id)
    {
        $order = Order::with('order_menus.menu')->where('id', $id)->first();
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'order'), 200);
    }
    
    public function update($id)
    {
        $order = Order::with('order_menus.menu')->where('id', $id)->first();
        $order->update([
           'table_id' => request('table_id'),
           'customer_name' => request('customer_name'),
           'order_category' => request('order_category'),
           'pembayaran' => request('pembayaran'),
           'discount_order' => request('discount_order'),
           'total_payment' => request('total_payment'),
           'total_payment_before_discount' => request('total_payment_before_discount')
        ]);
        
        $menu_id = explode(",", request('menu_id'));
        $amount = explode(",", request('amount'));
        $price = request('total_payment_before_discount');
        if(request('information') != null){
            $information = explode(",", request('information'));
        }
        
        if(count($order->order_menus) > 0) {
            foreach($order->order_menus as $order_menu) {
                $menu_order = Menu::where('id', $order_menu->menu_id)->first();
                if(count($menu_order->material_menus) > 0)
                {
                    foreach($menu_order->material_menus as $item)
                    {
                        $material = Material::where([['id', $item->material_id], ['stock', '!=', '999999']])->first();
                        if($material != null)
                        {
                            $material->update([
                               'stock' =>  $material->stock + ($item->stock_required * $order_menu->amount)
                            ]);
                        }
                    }
                    
                }
            }
            $order_menu = OrderMenu::where('order_id', $id)->delete();
        }
        for ($i=0; $i < count($menu_id) ; $i++) {
            if(request('information') != null){
                $order_menu = OrderMenu::create([
                    'order_id' => $order->id,
                    'menu_id' => (int)$menu_id[$i],
                    'information' => $information[$i],
                    'amount' => (int)$amount[$i]
                ]);
            } else {
                $order_menu = OrderMenu::create([
                    'order_id' => $order->id,
                    'menu_id' => (int)$menu_id[$i],
                    'information' => '',
                    'amount' => (int)$amount[$i]
                ]);
            }
            
            // if(request('order_category') == 'gofood'){
            //     if($order->discount_grabfood != 0)
            //     {
            //         $price = ($price + ($order_menu->menu->price_gofood * $order_menu->amount));
            //         $price = $price - ($order->discount_grabfood/100 * $price);
            //     } else {
            //         $price = $price + ($order_menu->menu->price_gofood * $order_menu->amount);
            //     }   
            // } elseif(request('order_category') == 'grabfood'){
            //     if($order->discount_gofood != 0)
            //     {
            //         $price = ($price + ($order_menu->menu->price_grabfood * $order_menu->amount));
            //         $price = $price - ($order->discount_gofood/100 * $price);
            //     } else {
            //         $price = $price + ($order_menu->menu->price_grabfood * $order_menu->amount);
            //     }   
            // } else {
            //     if($order->discount != 0)
            //     {
            //         $price = ($price + ($order_menu->menu->price * $order_menu->amount));
            //         $price = $price - ($order->discount/100 * $price);
            //     } else {
            //         $price = $price + ($order_menu->menu->price * $order_menu->amount);
            //     }   
            // }
            
            $menu_order = Menu::where('id', $order_menu->menu_id)->first();
            if(count($menu_order->material_menus) > 0)
            {
                foreach($menu_order->material_menus as $item)
                {
                    $material = Material::where([['id', $item->material_id], ['stock', '!=', '999999']])->first();
                    if($material != null)
                    {
                        $material->update([
                           'stock' =>  $material->stock - ($item->stock_required * $order_menu->amount)
                        ]);
                    }
                }
                
            }
        }
        
        // if(request('total_payment_manual') != '' || request('total_payment_manual') != null || request('total_payment_manual') != 0)
        // {
        //     $order->update([
        //       'total_payment' => request('total_payment_manual')
        //     ]);
        // } else {
        //     $order->update([
        //       'total_payment' => $price
        //     ]);
        // }
        
        // $financial_statement_description = FinancialStatementDescription::where('order_id', $id)->first();
        // $desc = null;
        // foreach($order->order_menus as $item)
        // {
        //     $desc = $desc . '<br>' . $item->menu->name . ' | Jumlah : ' . $item->amount;
        // }
        // $financial_statement_description->update([
        //     'debit' => $price,
        //     'description' => $desc
        // ]);
        
        // ActivityHistory::create([
        //     'user_id' => '1',
        //     'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
        //     'description' => 'Mengubah order'. 'Order id-' . $id
        // ]);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mengubah pesanan";
        return response()->json(compact('status', 'status_code', 'message', 'order'), 200);
    }
}
