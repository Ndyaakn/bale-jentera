<?php

namespace App\Http\Controllers;

use App\Exports\JournalMultiSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDate;
use App\Order;

class JournalOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journal['journal'] =  OrderDate::orderBy('created_at', 'desc')->get();
        return view('dashboard-super-admin.journal-management.index', $journal);
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
     * @param  \App\JournalOrder  $journalOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $journal['journal'] =  Order::where([['order_date_id', $id], ['order_status', 'pay']])->get();
        return view('dashboard-super-admin.journal-management.show', $journal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JournalOrder  $journalOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(JournalOrder $journalOrder)
    {   
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JournalOrder  $journalOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JournalOrder $journalOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JournalOrder  $journalOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(JournalOrder $journalOrder)
    {
        //
    }
    
    public function export() 
    {
        $get_date_from = explode("-", request('date_from'));
        $date_from = $get_date_from[2] . "-" . $get_date_from[1] . "-" . $get_date_from[0];
        $get_date_to = explode("-", request('date_to'));
        $date_to = $get_date_to[2] . "-" . $get_date_to[1] . "-" . $get_date_to[0];
        
        return (new JournalMultiSheetExport)
            ->dateFrom($date_from)
            ->dateTo($date_to)
            ->download('Jurnal-WP(' .  $date_from . '|' . $date_to  . ').xlsx');
    }
}
