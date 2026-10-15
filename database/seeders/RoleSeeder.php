<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'name_ar' => 'مدير عام'],
            ['name' => 'project_manager', 'name_ar' => 'مشرف مشاريع'],
            ['name' => 'volunteer', 'name_ar' => 'متطوع'],
            ['name' => 'donor', 'name_ar' => 'متبرع'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
