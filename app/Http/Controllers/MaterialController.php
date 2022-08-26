<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\Material;
use Auth;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material['material'] = Material::orderBy('id', 'desc')->get();
        
        return view('dashboard-super-admin.material-management.index', $material);
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
        if(request('infinity_stock') == 'on')
        {
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah bahan -> ' . request('material') . ', '  . 'Tidak terbatas' . ', ' . request('satuan')
            ]);
        } else {
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah bahan -> ' . request('material') . ', '  . request('stock') . ', ' . request('satuan')
            ]);
        }
        
        $material = Material::create([
           'material' => request('material'),
           'stock' => request('stock'),
           'satuan' => request('satuan')
        ]);
        
        if(request('infinity_stock') == 'on')
        {
            $material->update([
               'stock'  => '999999'
            ]);
        }
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        
        return $material;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $material = Material::findOrFail($id);
        
        if(request('infinity_stock') == 'on')
        {
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . 'Tidak terbatas' . ', ' . $material->satuan . ' = ' . request('satuan')
            ]);
        } else {
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah bahan -> ' . $material->material . ' = ' . request('material') . ', ' . $material->stock . ' = ' . request('stock') . ', ' . $material->satuan . ' = ' . request('satuan')
            ]);
        }
        $material->update([
           'material' => request('material'),
           'stock' => request('stock'),
           'satuan' => request('satuan'),
        ]);
        
        if(request('infinity_stock') == 'on')
        {
            $material->update([
               'stock'  => '999999'
            ]);
        }
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus bahan -> ' . $material->material . ', ' . $material->stock  . ', ' . $material->satuan
        ]);
        $material->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
