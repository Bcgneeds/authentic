<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Admin2',
            'email'    => 'admin2@authenticeclectics.com',
            'password' => Hash::make('admin12345'),
            'is_admin' => true,
        ]);
    }
}
