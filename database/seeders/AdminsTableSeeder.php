<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
       public function run()
    {
               // Create 'admin' role (if not exists)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Assign all existing permissions to admin role
        $adminRole->syncPermissions(Permission::all());

        // Create admin user
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );

        // Assign role
        $admin->assignRole('admin');
    }
        // Create "admin" role if not exists
        
}