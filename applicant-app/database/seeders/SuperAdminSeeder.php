<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Prevent duplicate super admin
        if (User::where('role', 'super_admin')->exists()) {
            return;
        }

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@mtdc.com',
            'password' => Hash::make('SuperAdmin@123'),
            'role' => 'super_admin',
        ]);
    }
}
