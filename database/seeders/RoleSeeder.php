<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Reset Cache Permission
        |--------------------------------------------------------------------------
        */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Daftar Permission
        |--------------------------------------------------------------------------
        */
        $permissions = [
            'manage-products',
            'manage-suppliers',
            'manage-transactions',
            'view-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Buat Role + Assign Permission
        |--------------------------------------------------------------------------
        */

        // ADMIN → akses semua
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions(Permission::all());

        // MANAGER → barang + supplier + laporan
        $manager = Role::firstOrCreate([
            'name' => 'manager',
            'guard_name' => 'web',
        ]);

        $manager->syncPermissions([
            'manage-products',
            'manage-suppliers',
            'view-reports',
        ]);

        // STAFF GUDANG → transaksi + laporan
        $staff = Role::firstOrCreate([
            'name' => 'staff_gudang',
            'guard_name' => 'web',
        ]);

        $staff->syncPermissions([
            'manage-transactions',
            'view-reports',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Buat User Default + Assign Role
        |--------------------------------------------------------------------------
        */

        // ADMIN
        $userAdmin = User::firstOrCreate(
            [
                'email' => 'admin@test.com',
            ],
            [
                'name' => 'Admin Utama',
                'password' => bcrypt('password'),
            ]
        );

        $userAdmin->syncRoles([$admin]);

        // MANAGER
        $userManager = User::firstOrCreate(
            [
                'email' => 'manager@test.com',
            ],
            [
                'name' => 'Manager Inventori',
                'password' => bcrypt('password'),
            ]
        );

        $userManager->syncRoles([$manager]);

        // STAFF
        $userStaff = User::firstOrCreate(
            [
                'email' => 'staff@test.com',
            ],
            [
                'name' => 'Staff Gudang',
                'password' => bcrypt('password'),
            ]
        );

        $userStaff->syncRoles([$staff]);

        /*
        |--------------------------------------------------------------------------
        | Reset Cache Lagi (biar aman)
        |--------------------------------------------------------------------------
        */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
