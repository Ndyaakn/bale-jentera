<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\MaterialMenu;
use Carbon\Carbon;
use App\Material;
use App\Menu;
use Auth;

class MaterialMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $material = request('material_id');
        $stock = request('stock_required');
        for ($i=0; $i < count($material) ; $i++) {
            $material_menu = MaterialMenu::create([
               'menu_id' => request('menu_id'),
               'material_id' => $material[$i],
               'stock_required' => $stock[$i]
            ]);
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah bahan menu -> ' . $material_menu->menu->name . ', '  . $material_menu->material->material
            ]);
        }
        
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialMenu  $materialMenu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material_menu['material_menu'] = MaterialMenu::where('menu_id', $id)->orderBy('id', 'desc')->get();
        $material_menu['material'] = Material::orderBy('material', 'desc')->get();
        $material_menu['menu'] = Menu::where('id', $id)->first();;
        $material_menu['menu_id'] = $id;
        
        return view('dashboard-super-admin.material-menu.show', $material_menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialMenu  $materialMenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = MaterialMenu::findOrFail($id);
        
        return $material;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialMenu  $materialMenu
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $material = MaterialMenu::findOrFail($id);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah bahan menu -> ' . $material->menu->name . ', '  . $material->material->material
        ]);
        
        $material->update([
           'material_id' => request('material_id'),
           'stock_required' => request('stock_required'),
        ]);
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialMenu  $materialMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = MaterialMenu::findOrFail($id);
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus bahan menu -> ' . $material->menu->name . ', '  . $material->material->material
        ]);
        $material->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
