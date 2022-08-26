<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityHistory;
use App\CategoryMenu;
use Carbon\Carbon;

class ApiCategoryMenuController extends Controller
{
    public function index()
    {
        $category_menu = CategoryMenu::orderBy('index', 'asc')->get();
        
        $status = "OK";
        $status_code = "DBC-200";
        $message = "Berhasil mendapatkan data";
        return response()->json(compact('status', 'status_code', 'message', 'category_menu'), 200);
    }
    
    public function store()
    {
        if(request('category') == null){
            $status = "ERR";
            $status_code = "DBC-200";
            $message = "Semua kolom wajib diisi";
            return response()->json(compact('status', 'status_code', 'message'), 200);
        } else {
            $category = CategoryMenu::where('index', request('index'))->first();
            if($category != null){
                $status = "ERR";
                $status_code = "DBC-401";
                $message = "Index telah digunakan";
                return response()->json(compact('status', 'status_code', 'message', 'category_menu'), 401);
            }
            $category_menu = CategoryMenu::create([
                'category' => request('category'),
                'index' => request('index'),
            ]);
            
            ActivityHistory::create([
                'user_id' => '1', //auth('api')->user()->id
                'date_time' => Carbon::now(8)->format('d-m-Y H:i'),
                'description' => 'Tambah kategori menu -> ' . request('category')
            ]);
            
            $status = "OK";
            $status_code = "DBC-200";
            $message = "Berhasil membuat data";
            return response()->json(compact('status', 'status_code', 'message', 'category_menu'), 200);
        }
    }
}
