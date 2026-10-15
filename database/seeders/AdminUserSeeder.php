<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@charity.test'],
            [
                'name' => 'مدير الجمعية',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole?->id,
            ]
        );
    }
}
