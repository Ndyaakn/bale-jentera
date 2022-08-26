<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use Carbon\Carbon;
use App\Waitress;
use App\User;
use JWTAuth;

class ApiAuthenticationController extends Controller
{
    public function login()
    {
        if(request('username') == null || request('username') == '' || request('password') == null || request('password') == '') {
            $status = 'ERR';
            $status_code = 'DBC-419';
            $message = 'Semua kolom wajib diisi';
            return response()->json(compact('status', 'status_code', 'message'), 419);
        } else {
            $user = User::where('username', request('username'))->first();
            if($user == null){
                $status = 'ERR';
                $status_code = 'DBC-404';
                $message = 'Username yang anda masukkan tidak valid';
                return response()->json(compact('status', 'status_code', 'message'), 404);
            } else {
                $credentials = ['username' => $user->username, 'password' => request('password')];
                if (! $token = auth('api')->attempt($credentials)){
                    $status = 'ERR';
                    $status_code = 'DBC-401';
                    $message = 'Password yang anda masukkan tidak valid';
                    return response()->json(compact('status', 'status_code','message'), 401);
                } else {
                    ActivityHistory::create([
                        'user_id' => $user->id,
                        'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                        'description' => 'Login'
                    ]);
                    $status = 'OK';
                    $status_code = 'DBC-200';
                    $message = 'Berhasil login';
                    return response()->json(compact('status', 'status_code', 'message', 'user', 'token'), 200);
                }
            }
        }
    }
    
    public function logout()
    {
        $user = User::findOrFail(auth('api')->user()->id);
        ActivityHistory::create([
            'user_id' => auth('api')->user()->id,
            'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
            'description' => 'Logout'
        ]);
        auth('api')->logout();
        
        $status = 'OK';
        $status_code = 'DBC-200';
        $message = 'Berhasil logout';
        return response()->json(compact('status', 'status_code', 'message'), 200);
    }
}
