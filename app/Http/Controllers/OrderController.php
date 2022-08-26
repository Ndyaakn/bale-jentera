<?php

namespace App\Http\Controllers;

use App\FinancialStatementDescription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\MaterialMenu;
use Carbon\Carbon;
use App\OrderMenu;
use App\Material;
use App\Order;
use App\Menu;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order['order'] = Order::orderBy('id', 'desc')->get();
        
        return view('dashboard-super-admin.order-management.index', $order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        foreach($order->order_menus as $item)
        {
            $menu = Menu::where('id', $item->menu_id)->first();
            if($menu != null)
            {
                $material_menu = MaterialMenu::where('menu_id', $menu->id)->get();
                foreach($material_menu as $item_1)
                {
                    $material = Material::where([['id', $item->material_id], ['stock', '!=', '999999']])->first();
                    if($material != null)
                    {
                        $material->update([
                           'stock' => $material->stock + ($item->amount * $item_1->stock_required)
                        ]);
                    }
                }
            }
        }
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus Jurnal -> ' . $order->order_date->date . ', ' . $order->order_category . ', ' . $order->customer_name . ', ' . $order->total_payment
        ]);
        $order->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
