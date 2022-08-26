<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\CategoryMenu;
use Carbon\Carbon;
use Auth;

class CategoryMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_menu['category_menu'] = CategoryMenu::orderBy('index', 'asc')->get();
        
        return view('dashboard-super-admin.category-menu-management.index', $category_menu);
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
        $category = request('category');
        $index = request('index');
        for ($i=0; $i < count($category) ; $i++) {
            $category_menu = CategoryMenu::where('index', $index[$i])->first();
            if($category_menu != null)
            {
                return redirect()->back()->with("ERR", "Index yang anda masukkan telah digunakan");
            }
            CategoryMenu::create([
                'index' => $index[$i],
                'category' => $category[$i],
            ]);
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah kategori menu -> ' . $category[$i]
            ]);
        }
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryMenu $categoryMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_menu = CategoryMenu::findOrFail($id);
        
        return $category_menu;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryMenu  $categoryMenu
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $categoryMenu = CategoryMenu::findOrFail($id);
        $category_menu = CategoryMenu::where('index', request('index'))->first();
        if($category_menu != null)
        {
            if($categoryMenu->id != $category_menu->id)
            {
                return redirect()->back()->with("ERR", "Index yang anda masukkan telah digunakan");
            }
        }
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah kategori menu -> ' . $categoryMenu->category . ' = ' . request('category')
        ]);
        
        $categoryMenu->update([
           'category' => request('category'),
           'index' => request('index')
        ]);
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryMenu = CategoryMenu::findOrFail($id);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus kategori menu -> ' . $categoryMenu->category
        ]);
        
        $categoryMenu->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
