<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat roles (kalau belum ada)
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $operatorRole = Role::create(['name' => 'operator', 'guard_name' => 'admin']);
        $magangRole = Role::create(['name' => 'operator magang', 'guard_name' => 'admin']);

        // Admin
        $admin = Admin::factory()->create([
            'username' => 'admin',
        ]);
        $admin->assignRole($adminRole);

        // Operator
        $operator = Admin::factory()->create([
            'username' => 'operator',
        ]);
        $operator->assignRole($operatorRole);

        // Operator Magang
        $magang = Admin::factory()->create([
            'username' => 'operator magang',
        ]);
        $magang->assignRole($magangRole);
    }
}
