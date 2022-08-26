<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminPermission;
use App\Admin;
use App\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin == null){
            if(Auth::user()->admin->admin_permission->view_admin == 0) {
                return redirect()->back()->with("ERR", "Tidak memiliki hak akses");    
            }
        }
        $admin['admin'] = Admin::whereHas('admin_permission', function($q){
           $q->where('rukun_tetangga_id', Auth::user()->admin->admin_permission->rukun_tetangga_id);
        })
        ->orderBy('admin_name', 'asc')
        ->get();
        
        $admin['admin_permission'] = AdminPermission::where('rukun_tetangga_id', Auth::user()->admin->admin_permission->rukun_tetangga_id)
        ->orderBy('id', 'asc')
        ->get();
        
        return view('dashboard-admin.admin-management.index', $admin);
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
        $email_unvailable = User::where('email', request('email'))->first();
        if($email_unvailable != null){
            return redirect()->back()->with("ERR", "Alamat e-mail tidak dapat digunakan");
        }
        $phone_number_unvailable = User::where('phone_number', request('phone_number'))->first();
        if($phone_number_unvailable != null){
            return redirect()->back()->with("ERR", "Nomor telepon tidak dapat digunakan");
        }
        $user = User::create([
           'email' => request('email'),
           'phone_number' => request('phone_number'),
           'password' => bcrypt(request('password'))
        ]);
        
        Admin::create([
           'user_id'  => $user->id,
           'admin_permission_id' => request('admin_permission_id'),
           'admin_name' => request('admin_name')
        ]);
        
        return redirect()->back()->with("OK", "Berhasil menambahkan data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::with('user', 'admin_permission')->findOrFail($id);
        
        return $admin;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $admin = Admin::findOrFail($id);
        $email_unvailable = User::where('email', request('email'))->first();
        if($email_unvailable != null){
            if($admin->user_id != $email_unvailable->id){
                return redirect()->back()->with("ERR", "Alamat e-mail tidak dapat digunakan");
            }
        }
        $phone_number_unvailable = User::where('phone_number', request('phone_number'))->first();
        if($phone_number_unvailable != null){
            if($admin->user_id != $phone_number_unvailable->id){
                return redirect()->back()->with("ERR", "Nomor telepon tidak dapat digunakan");
            }
        }
        $admin->user->update([
           'email' => request('email'),
           'phone_number' => request('phone_number'),
        ]);
        
        $admin->update([
           'admin_permission_id' => request('admin_permission_id'),
           'admin_name' => request('admin_name')
        ]);
        
        return redirect()->back()->with("OK", "Berhasil mengubah data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if($admin->admin_permission->view_admin_permission == 1){
            return redirect()->back()->with("ERR", "Tidak dapat menghapus data");    
        }
        $admin->user->delete();
        
        return redirect()->back()->with("ERR", "Berhasil menghapus data");    
    }
}
