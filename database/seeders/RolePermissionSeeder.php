<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'settings.view',
            'settings.update',
            'pages.view',
            'pages.create',
            'pages.update',
            'pages.delete',
            'services.view',
            'services.create',
            'services.update',
            'services.delete',
            'contact-messages.view',
            'contact-messages.reply',
            'contact-messages.delete',
            'newsletter.view',
            'newsletter.delete',
            'users.view',
            'users.create',
            'users.update',
            'users.delete',
            'roles.view',
            'roles.update',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $roles = [
            'Super Admin' => $permissions,
            'Admin' => array_diff($permissions, ['roles.update']),
            'Editor' => [
                'pages.view', 'pages.create', 'pages.update', 'pages.delete',
                'services.view', 'services.create', 'services.update', 'services.delete',
            ],
            'Author' => [
                'pages.view', 'pages.create', 'pages.update',
            ],
            'Support' => [
                'contact-messages.view', 'contact-messages.reply', 'contact-messages.delete',
                'newsletter.view',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($rolePermissions);
        }
    }
}
