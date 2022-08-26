<?php

namespace App\Http\Controllers;

use App\FinancialStatementDescription;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\User;
use App\Order;
use Auth;

class AuthenticationController extends Controller
{
     /**
     * Show the form login for the given user.
     *
     *
     * @return View
     */
    public function index() {
        // $financial = FinancialStatementDescription::whereHas('order', function($q){
        //     $q->where('order_status', '!=', 'pay');
        // })->delete();
        return view("authentication.index");
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function signIn() {
        $user = User::where('email', request('email'))->first();
        
        if ($user == null)
        {
            return redirect()->back()->with('ERR', 'Alamat e-mail yang anda masukkan salah');
        }

        
        if (!Auth::attempt(['id' => $user->id, 'password' => request('password')]))
        {
            return redirect()->back()->with('ERR', 'Password yang anda masukkan salah');
        }
        
        ActivityHistory::create([
            'user_id' => $user->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Login'
        ]);
        
        return redirect()->route('home');
    }

    /**
     * Handle an authentication attempt for logout.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function signOut() {
        ActivityHistory::create([
            'user_id' => Auth::user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Logout'
        ]);
        
        Auth::logout();

        return redirect()->route('login');
    }
}