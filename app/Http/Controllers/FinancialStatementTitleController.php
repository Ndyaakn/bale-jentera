<?php

namespace App\Http\Controllers;

use App\FinancialStatementDescription;
use App\Http\Controllers\Controller;
use App\FinancialStatementTitle;
use Illuminate\Http\Request;
use App\JournalMaterial;
use App\ActivityHistory;
use App\MaterialMenu;
use Carbon\Carbon;
use App\Material;
use App\Order;
use App\Menu;
use Auth;

class FinancialStatementTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financial['financial'] = FinancialStatementTitle::orderBy('id', 'desc')->get();
        
        return view('dashboard-super-admin.financial-statement-management.index', $financial);
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
        if(request('material_id') != null)
        {
            $material = Material::where('id', request('material_id'))->first();
            $material->update([
               'stock'  => $material->stock + request('stock')
            ]);
            
            FinancialStatementDescription::create([
               'financial_statement_id' => request('financial_statement_id'),
               'credit' => request('credit'),
               'description' => $material->material . " | " . request('stock')
            ]);
            
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah Stok -> ' . $material->material . ', ' . request('stock')  . ', ' . request('credit')
            ]);
            
            JournalMaterial::create([
               'user_id' => Auth::user()->id,
               'material_id' => $material->id,
               'type' => 'penambahan',
               'reason' => request('reason'),
               'stock' => request('stock'),
               'date' => Carbon::now(8)->format('d-m-Y')
            ]);
        
        } else {
            FinancialStatementDescription::create([
               'financial_statement_id' => request('financial_statement_id'),
               'credit' => request('credit'),
               'description' => request('description')
            ]);
            
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah pengeluaran -> ' . request('credit')
            ]);
        }
        
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }
    
    public function decreaseStock()
    {
        $material = Material::where('id', request('material_id'))->first();
            $material->update([
               'stock'  => $material->stock - request('stock')
            ]);
            
            FinancialStatementDescription::create([
               'financial_statement_id' => request('financial_statement_id'),
               'credit' => 0,
               'description' => 'pengurangan | ' . $material->material . " | " . request('stock')
            ]);
            
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Kurang Stok -> ' . $material->material . ', ' . request('stock')  . ', ' . 0
            ]);
            
            JournalMaterial::create([
               'user_id' => Auth::user()->id,
               'material_id' => $material->id,
               'type' => 'pengurangan',
               'reason' => request('reason'),
               'stock' => request('stock'),
               'date' => Carbon::now(8)->format('d-m-Y')
            ]);
            
            return redirect()->back()->with('OK', 'Berhasil mengurangi stok bahan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinancialStatementTitle  $financialStatementTitle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $financial['financial'] = FinancialStatementDescription::where('financial_statement_id', $id)->orderBy('id', 'desc')->get();
        $financial['material'] = Material::where('material', '!=', null)->where('stock', '!=', '999999')->orderBy('material', 'asc')->get();
        $financial['id'] = $id;
        
        return view('dashboard-super-admin.financial-statement-management.show', $financial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinancialStatementTitle  $financialStatementTitle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $financial = FinancialStatementDescription::findOrFail($id);
        
        return $financial;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinancialStatementTitle  $financialStatementTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(request('type') == 1)
        {
            $material = Material::where('material', request('material'))->first();
            $financial = FinancialStatementDescription::findOrFail($id);
            $stock_financial = explode(" | ", $financial->description);
            $financial->update([
               'credit' => request('credit'),
               'description' => $material->material . " | " . request('stock')
            ]);
            
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah stok -> ' . $material->material . ', ' . $stock_financial[1] . ' = ' . request('stock') . ', ' . $financial->credit . ' = ' . request('credit')
            ]);
            
            $material->update([
                'stock' => ($material->stock - $stock_financial[1]) + request('stock')
            ]);
        } else {
            $financial = FinancialStatementDescription::findOrFail($id);
            
            ActivityHistory::create([
                'user_id' => Auth::user()->id,
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Ubah pengeluaran -> ' . $financial->credit . ' = ' . request('credit')
            ]);
            
            $financial->update([
               'credit' => request('credit'),
               'description' => request('description')
            ]);
        }
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinancialStatementTitle  $financialStatementTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $financial = FinancialStatementDescription::findOrFail($id);
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus laporan keuangan'
        ]);
        $financial->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
