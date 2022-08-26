<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;

class ActivityHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activity_history['activity_history'] = ActivityHistory::orderBy('id', 'desc')->get();
        
        return view('dashboard-super-admin.activity-history.index', $activity_history);
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
     * @param  \App\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityHistory $activityHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityHistory $activityHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityHistory $activityHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivityHistory  $activityHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityHistory $activityHistory)
    {
        //
    }
}
