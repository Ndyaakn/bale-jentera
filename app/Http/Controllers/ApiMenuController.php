<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\Storage;
use App\Table;
use App\Menu;
use Link;

class ApiMenuController extends Controller
{
    public function index()
    {
        $category_menu_id = $_GET['category_menu_id'];
        if($category_menu_id == 0) {
            $menu = Menu::with('material_menus.material')->orderBy('index', 'asc')->get();
        } else {
            $menu = Menu::with('material_menus.material')->where('category_menu_id', $category_menu_id)->orderBy('index', 'asc')->get();
        }
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
    }
    
    public function menuSearch()
    {
        $search = $_GET['search'];
        $menu = Menu::with('material_menus.material')->where('name','LIKE',"%{$search}%")->orderBy('index', 'asc')->get();
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
    }
    
    public function indexPaginate()
    {
        $category_menu_id = $_GET['category_menu_id'];
        if($category_menu_id == 0) {
            $menu = Menu::with('material_menus.material')->orderBy('index', 'asc')->paginate(10);
        } else {
            $menu = Menu::with('material_menus.material')->where('category_menu_id', $category_menu_id)->orderBy('index', 'asc')->paginate(10);
        }
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
    }
    public function indexTable()
    {
        $table = Table::orderBy('id', 'desc')->get();
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'table'), 200);
    }
    
    public function orderCategory()
    {
        $order_category = [['category' => 'dine in'], ['category' => 'grabfood'], ['category' => 'gofood']];

        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'order_category'), 200);
    }

    public function store(Request $request)
    {
        if(request('name') == null || request('description') == null || request('price') == null || request('category_menu_id') == null || request('image') == null){
            $status = "ERR";
            $status_code = "DBC-200";
            $message = "Semua kolom wajib diisi";
            return response()->json(compact('status', 'status_code', 'message'), 200);
        } else {
            if ($request->hasFile('image')) {
                $save = $request->file('image')->store('public/image');
                $filename = $request->file('image')->hashName();
                $image = url('/').'/storage/image/'.$filename;
            }
            
            $check_index = Menu::where([['index', request('index')], ['category_menu_id', request('category_menu_id')]])->first();
            if($check_index != null){
                $status = "ERR";
                $status_code = "DBC-401";
                $message = "Index telah digunakan";
                $menu = null;
            }
            if(request('index') == '' || request('index') == null)
            {
                $status = "ERR";
                $status_code = "DBC-401";
                $message = "Index wajib diisi";
                $menu = null;
            }
            $menu = Menu::create([
                'category_menu_id' => request('category_menu_id'),
                'category_order' => request('category_order'),
                'index' => request('index'),
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'price_gofood'  => request('price_gofood'),
                'price_gofood2'  => request('price_gofood2'),
                'price_shopee'  => request('price_shopee'),
                'price_grabfood'  => request('price_grabfood'),
                'additional_information' => request('additional_information'),
                'discount'  => request('discount'),
                'discount_gofood2'  => request('discount_gofood2'),
                'discount_shopee'  => request('discount_shopee'),
                'image' => $image
            ]);
            
            ActivityHistory::create([
                'user_id' => auth('api')->user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah menu -> ' . $menu->name . ', ' . $menu->price . ', ' . $menu->price_gofood . ', ' . $menu->price_grabfood
            ]);
            
            $status = "OK";
            $status_code = "DBC-200";
            $message = "Berhasil membuat data";
            return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
        }
    }
    
    public function edit($id)
    {
        $menu = Menu::with('material_menus.material')->findOrFail($id);
        $menu = Menu::with('material_menus.material')->orderBy('index', 'asc')->findOrFail($id);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
    }
    
    public function update($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update([
           'stock'  => request('stock')
        ]);
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mengubah stock";
        return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
    }
    
    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $image = $menu->image;
        if ($request->hasFile('image')) {
            $save = $request->file('image')->store('public/image');
            $filename = $request->file('image')->hashName();
            $image = url('/').'/storage/image/'.$filename;
        }
        
        ActivityHistory::create([
            'user_id' => auth('api')->user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah menu -> ' . $menu->name . ' = ' . request('name') . ', ' . $menu->price . ' = ' . request('price') . ', ' . ', ' . $menu->price_gofood . ' = ' . request('price_gofood') . ', ' . ', ' . $menu->price_grabfood . ' = ' . request('price_grabfood')
        ]);
        
        $check_index = Menu::where([['index', request('index')], ['category_menu_id', $menu->category_menu_id]])->first();
        if($check_index != null){
            if($check_index->id != $menu->id){
                return redirect()->back()->with("ERR", "Index pada category tersebut telah digunakan");
            }
        }
        
        $menu->update([
            'category_order' => request('category_order'),
            'name' => request('name'),
            'index' => request('index'),
            'description' => request('description'),
            'price' => request('price'),
            'price_gofood'  => request('price_gofood'),
            'price_grabfood'  => request('price_grabfood'),
            'additional_information' => request('additional_information'),
            'discount'  => request('discount'),
            'image' => $image
        ]);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mengubah data";
        return response()->json(compact('status', 'status_code', 'message', 'menu'), 200);
    }
    
    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        ActivityHistory::create([
            'user_id' => auth('api')->user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus menu -> ' . $menu->name . ', ' . $menu->price . ', ' . $menu->price_gofood . ', ' . $menu->price_grabfood
        ]);
        $menu->delete();
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil menghapus menu";
        return response()->json(compact('status', 'status_code', 'message'), 200);
    }
}
