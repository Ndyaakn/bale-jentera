<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\CategoryMenu;
use Carbon\Carbon;
use App\Menu;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu['menu'] = Menu::orderBy('index', 'asc')->get();
        
        $menu['category_menu'] = CategoryMenu::orderBy('id', 'desc')->get();
        
        return view('dashboard-super-admin.menu-management.index', $menu);
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
        if ($request->hasFile('image')) {
            $save = $request->file('image')->store('public/image');
            $filename = $request->file('image')->hashName();
            $image = url('/').'/storage/image/'.$filename;
        }
        $category_order = null;
        if(count($request->category_order) > 0)
        {
            $category_order = implode(",", $request->category_order);
        }
        // foreach(request('category_order') as $category_orders)
        // {
        //     $category_order = $category_order . $category_orders . ',';
        // }
        $check_index = Menu::where([['index', request('index')], ['category_menu_id', request('category_menu_id')]])->first();
        if($check_index != null){
            return redirect()->back()->with("ERR", "Index pada category tersebut telah digunakan");
        }
        $menu_id = Menu::create([
           'category_menu_id'  => request('category_menu_id'),
           'index' => request('index'),
           'category_order' => $category_order,
           'name'  => request('name'),
           'description'  => request('description'),
           'price'  => request('price'),
           'price_gofood'  => request('price_gofood'),
           'price_gofood2'  => request('price_gofood2'),
           'price_shopee'  => request('price_shopee'),
           'price_grabfood'  => request('price_grabfood'),
           'additional_information'  => request('additional_information'),
           'discount'  => request('discount'),
           'discount_takeaway'  => request('discount_takeaway'),
           'discount_gofood'  => request('discount_gofood'),
           'discount_gofood2'  => request('discount_gofood2'),
           'discount_shopee'  => request('discount_shopee'),
           'discount_grabfood'  => request('discount_grabfood'),
           'image' => $image
        ]);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Tambah menu -> ' . $menu_id->name . ', ' . $menu_id->price . ', ' . $menu_id->price_gofood . ', ' . $menu_id->price_grabfood
        ]);
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::with('category_menu')->findOrFail($id);
        
        return $menu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::with('category_menu')->findOrFail($id);
        $image = $menu->image;
        if ($request->hasFile('image')) {
            $save = $request->file('image')->store('public/image');
            $filename = $request->file('image')->hashName();
            $image = url('/').'/storage/image/'.$filename;
        }
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah menu -> ' . $menu->name . ' = ' . request('name') . ', ' . $menu->price . ' = ' . request('price') . ', ' . ', ' . $menu->price_gofood . ' = ' . request('price_gofood') . ', ' . ', ' . $menu->price_grabfood . ' = ' . request('price_grabfood')
        ]);
        
        $check_index = Menu::where([['index', request('index')], ['category_menu_id', request('category_menu_id')]])->first();
        if($check_index != null){
            if($check_index->id != $menu->id){
                return redirect()->back()->with("ERR", "Index pada category tersebut telah digunakan");
            }
        }
        
        $category_order = null;
        if(count($request->category_order) > 0)
        {
            $category_order = implode(",", $request->category_order);
        }
        
        $menu->update([
           'category_menu_id'  => request('category_menu_id'),
           'index' => request('index'),
           'category_order' => $category_order,
           'name'  => request('name'),
           'description'  => request('description'),
           'price'  => request('price'),
           'price_gofood'  => request('price_gofood'),
           'price_gofood2'  => request('price_gofood2'),
           'price_shopee'  => request('price_shopee'),
           'price_grabfood'  => request('price_grabfood'),
           'additional_information'  => request('additional_information'),
           'discount'  => request('discount'),
           'discount_takeaway'  => request('discount_takeaway'),
           'discount_gofood'  => request('discount_gofood'),
           'discount_gofood2'  => request('discount_gofood2'),
           'discount_shopee'  => request('discount_shopee'),
           'discount_grabfood'  => request('discount_grabfood'),
           'discount_takeaway'  => request('discount_takeaway'),
           'image'  => $image
        ]);
        
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::with('category_menu')->findOrFail($id);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus menu -> ' . $menu->name . ', ' . $menu->price . ', ' . $menu->price_gofood . ', ' . $menu->price_grabfood
        ]);
        
        $menu->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
