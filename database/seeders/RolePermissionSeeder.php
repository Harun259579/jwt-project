<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Blog Permissions
        $blogPermissions = [
            'blog.view',
            'blog.create',
            'blog.edit',
            'blog.delete',
            'blog.publish',
        ];

        // Create permissions
        foreach ($blogPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $coach = Role::firstOrCreate(['name' => 'coach']);
        $runner = Role::firstOrCreate(['name' => 'runner']);

        // Assign permissions to roles
        $admin->syncPermissions($blogPermissions); // full access

        $coach->syncPermissions([
            'blog.view',
            'blog.create',
            'blog.edit',
            'blog.publish',
        ]);

        $runner->syncPermissions([
            'blog.view',
            'blog.create',
            'blog.edit',
        ]);
    }
}
