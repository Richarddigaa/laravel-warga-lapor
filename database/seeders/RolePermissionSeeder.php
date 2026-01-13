<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage categories',
            'manage reports',
            'manage rewards',
            'manage redemptions',
            'create report',
            'view reports history'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        // Citizen Role
        $citizenRole = Role::firstOrCreate([
            'name' => 'citizen'
        ]);
        $citizenPermissions = [
            'create report',
            'manage redemptions',
            'view reports history'
        ];
        $citizenRole->syncPermissions($citizenPermissions);

        // Super Admin Role
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);
        $user = User::create([
            'nik' => '3212345678901234',
            'name' => 'Super Admin',
            'phone' => '08123456789',
            'email' => 'super@admin.com',
            'password' => bcrypt('123123123')
        ]);
        $user->assignRole($superAdminRole);
    }
}
