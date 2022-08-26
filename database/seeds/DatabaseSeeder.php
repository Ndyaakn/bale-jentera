<?php

use Illuminate\Database\Seeder;
use App\AdminPermission;
use App\Admin;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin_permission = AdminPermission::create([
            'permission_name' => 'super admin',
            'view_admin_permission' => 1,
            'create_admin_permission' => 1,
            'edit_admin_permission' => 1,
            'delete_admin_permission' => 1,
            'view_management_user' => 1,
            'create_management_user' => 1,
            'edit_management_user' => 1,
            'delete_management_user' => 1
        ]);

        $user = User::create([
            'email' => 'admin@rtkita.com',
            'phone_number' => '081234567890',
            'password' => bcrypt('Rtk1t4_')
        ]);

        $admin = Admin::create([
            'admin_permission_id' => $admin_permission->id,
            'user_id' => $user->id,
            'admin_name' => 'RT Kita'
        ]);
    }
}
