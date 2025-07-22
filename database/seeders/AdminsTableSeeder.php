<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Step 1: Create admin user
        $admin = Admin::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Step 2: Create admin role with 'admin' guard
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'admin']
        );

        // Step 3: Define admin-only permissions
        $adminPermissions = [
            'view dashboard',
            'create users',
            'edit users',
            'delete users',
            'view users',
            'create roles',
            'edit roles',
            'delete roles',
             'view roles',
             'create permissions',
            'edit permissions',
            'delete permissions',
            'view permissions',
            'create permissions',
            'edit categories',
            'delete categories',
            'view categories',
            'create categories',
            'edit tags',
            'delete tags',
            'view tags',
            'create tags',
            'edit posts',
            'delete posts',
            'view posts',
            'create posts',
            'view comments',
            
           
                    ];

        // Step 4: Create permissions with 'admin' guard
        foreach ($adminPermissions as $permName) {
            Permission::firstOrCreate([
                'name' => $permName,
                'guard_name' => 'admin',
            ]);
        }

        // Step 5: Assign permissions to admin role
        $adminRole->syncPermissions($adminPermissions);

        // Step 6: Assign role to admin user
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // Optional: Output for confirmation
        $this->command->info('Admin user, role, and permissions created successfully.');
    }
}
