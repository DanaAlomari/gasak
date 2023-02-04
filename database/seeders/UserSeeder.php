<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name_en' => 'Super Admin',
            'email' => 'admin@admin.com',
            'phone' => '0799999999',
            'password' => Hash::make('12345678'),
            'user_status' => 1, // Active
            'user_type' => 1, // Admin
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
