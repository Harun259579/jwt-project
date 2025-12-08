<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class MigrateRolesFromUsersTableSeeder extends Seeder
{
    public function run()
    {
        // If User Table carry Role Column
        $users = User::whereNotNull('role')->get();

        foreach ($users as $user) {
            $roleName = trim($user->role);
            if (empty($roleName)) continue;

            $role = Role::firstOrCreate(['name' => $roleName]);
            $user->assignRole($role);
        }

    }
}

