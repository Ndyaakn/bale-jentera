<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\MaterialMenu;
use Carbon\Carbon;

class ApiMaterialMenuController extends Controller
{
    public function index()
    {
        $material_menu = MaterialMenu::with('menu', 'material')->where('menu_id', $_GET['menu_id'])->orderBy('id', 'asc')->get();
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'material_menu'), 200);
    }
    
    public function store()
    {
        $material_menu = MaterialMenu::create([
            'material_id' => request('material_id'),
            'menu_id' => request('menu_id'),
            'stock_required' => request('stock_required')
        ]);
        
        ActivityHistory::create([
            'user_id' => '1',
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Tambah bahan menu -> ' . $material_menu->menu->name . ', '  . $material_menu->material->material
        ]);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil membuat data";
        return response()->json(compact('status', 'status_code', 'message', 'material_menu'), 200);
    }
    
    public function edit($id)
    {
        $material_menu = MaterialMenu::with('material', 'menu')->findOrFail($id);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'material_menu'), 200);
    }
    
    public function update($id)
    {
        $material_menu = MaterialMenu::findOrFail($id);
        
        ActivityHistory::create([
            'user_id' => '1',
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah bahan menu -> ' . $material->menu->name . ', '  . $material->material->material
        ]);
        
        $material_menu->update([
            'material_id' => request('material_id'),
            'stock_required' => request('stock_required')
        ]);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mengubah data";
        return response()->json(compact('status', 'status_code', 'message', 'material_menu'), 200);
    }
}
