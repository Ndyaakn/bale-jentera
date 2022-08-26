<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\Waitress;
use App\User;
use Auth;

class WaitressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waitress['waitress'] = Waitress::orderBy('id', 'asc')->get();
        
        return view('dashboard-super-admin.waitress-management.index', $waitress);
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
        $user = User::create([
            'username' => request('username'),
            'password' => bcrypt(request('password'))
        ]);
        
        Waitress::create([
           'user_id' => $user->id
        ]);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Tambah Pelayan -> ' . $user->username
        ]);
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waitress  $waitress
     * @return \Illuminate\Http\Response
     */
    public function show(Waitress $waitress)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waitress  $waitress
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $waitress = Waitress::with('user')->findOrFail($id);
        
        return $waitress;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waitress  $waitress
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $waitress = Waitress::with('user')->findOrFail($id);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah Pelayan -> ' . $waitress->user->username . ' = ' . request('username')
        ]);
        
        $waitress->user->update([
           'username' => request('username')
        ]);
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }
    
    public function updatePassword($id)
    {
        $waitress = Waitress::with('user')->findOrFail($id);
        $waitress->user->update([
           'password' => bcrypt(request('password'))
        ]);
        
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Ubah Password Pelayan -> ' . $waitress->user->username
        ]);
        
        return redirect()->back()->with("OK", "Berhasil mengubah kata sandi");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waitress  $waitress
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $waitress = Waitress::with('user')->findOrFail($id);
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Hapus Pelayan -> ' . $waitress->user->username
        ]);
        $waitress->user->delete();
        
        return redirect()->back()->with("OK", "Berhasil menghapus data");
    }
}
