<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
       public function run()
    {
        $password = Hash::make('password');

        $admins = array(
            array(
                'name' => 'BooksCity',
                'email' => 'admin@gmail.com',
                'password' => $password
            ),
        );
        foreach($admins as $admin)
        {
            Admin::create($admin);
        }
    }

}
