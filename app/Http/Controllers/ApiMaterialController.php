<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\JournalMaterial;
use Carbon\Carbon;
use App\Material;

class ApiMaterialController extends Controller
{
    public function index()
    {
        $material = Material::where('stock', '!=', '999999')->orderBy('id', 'asc')->get();
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'material'), 200);
    }
    
    public function store()
    {
        if(request('stock') == '99999')
        {
            ActivityHistory::create([
                'user_id' => '1',
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . 'Tidak terbatas' . ', ' . $material->satuan . ' = ' . request('satuan')
            ]);
        } else {
            ActivityHistory::create([
                'user_id' => '1',
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah bahan -> ' . request('material') . ', '  . request('stock') . ', ' . request('satuan')
            ]);
        }
        
        $material = Material::create([
            'material' => request('material'),
            'stock' => request('stock'),
            'satuan' => request('satuan'),
        ]);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil membuat data";
        return response()->json(compact('status', 'status_code', 'message', 'material'), 200);
    }
    
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'material'), 200);
    }
    
    public function update($id)
    {
        $material = Material::findOrFail($id);
        
        if(request('stock') == '999999')
        {
            ActivityHistory::create([
                'user_id' => '1',
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . 'Tidak terbatas' . ', ' . $material->satuan . ' = ' . request('satuan')
            ]);
        } else {
            ActivityHistory::create([
                'user_id' => '1',
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . request('stock') . ', ' . $material->satuan . ' = ' . request('satuan')
            ]);
        }
        
        $material->update([
            'material' => request('material'),
            'stock' => request('stock'),
            'satuan' => request('satuan'),
        ]);
        
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mengubah data";
        return response()->json(compact('status', 'status_code', 'message', 'material'), 200);
    }
    
    public function updateStock($id)
    {
        $material = Material::findOrFail($id);
        $stock = request('stock');
        if(request('stock') == '999999')
        {
            ActivityHistory::create([
                'user_id' => '1',
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah stok bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . 'Tidak terbatas'
            ]);
            $stock = 'Tidak terbatas';
        } else {
            ActivityHistory::create([
                'user_id' => '1',
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah stok bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . request('stock') 
            ]);
        }
        
        if(request('type') == 'penambahan')
        {
            $material->update([
                'stock' => $material->stock + $stock
            ]);
            
            JournalMaterial::create([
               'material_id'  => $material->id,
               'user_id' => '1',
               'type' => 'penambahan',
               'reason' => request('reason'),
               'stock' => $stock,
               'date' => Carbon::now(8)->format('d-m-Y')
            ]);
        } else {
            $material->update([
                'stock' => $material->stock - request('stock')
            ]);
            
            JournalMaterial::create([
               'material_id'  => $material->id,
               'user_id' => '1',
               'type' => 'pengurangan',
               'reason' => request('reason'),
               'stock' => $stock,
               'date' => Carbon::now(8)->format('d-m-Y')
            ]);
        }
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mengubah stok";
        return response()->json(compact('status', 'status_code', 'message', 'material'), 200);
    }
}
