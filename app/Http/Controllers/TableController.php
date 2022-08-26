<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\Table;
use Auth;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table['table'] = Table::orderBy('id_tables', 'desc')->get();
        
        return view('dashboard-super-admin.table-management.index', $table);
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
    public function store()
    {
        $number = request('number');
        for ($i=0; $i < count($number) ; $i++) {
            Table::create([
               'number' => $number[$i],
            ]);
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah Meja -> ' . $number[$i]
            ]);
        }
        
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::findOrFail($id);
        
        return $table;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $table = Table::findOrFail($id);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah Meja -> ' . $table->number . ' = ' . request('number')
        ]);
        
        $table->update([
           'number' => request('number'),
        ]);
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus Meja -> ' . $table->number
        ]);
        $table->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
