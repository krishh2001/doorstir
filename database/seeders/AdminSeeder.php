<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
{
    Admin::create([
        'email' => 'admin@gmail.com',
        'password' => Hash::make('admin123'),
    ]);
}
}