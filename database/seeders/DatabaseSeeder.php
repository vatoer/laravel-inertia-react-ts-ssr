<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\Feature;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);
        $commenterRole = Role::create(['name' => RolesEnum::Commenter->value]);

        $manageFeaturesPermission = Permission::create(['name' => PermissionsEnum::ManageFeatures->value]);
        $manageUsersPermission = Permission::create(['name' => PermissionsEnum::ManageUsers->value]);
        $manageCommentsPermission = Permission::create(['name' => PermissionsEnum::ManageComments->value]);
        $upvoteDownvotePermission = Permission::create(['name' => PermissionsEnum::UpvoteDownvote->value]);

        $userRole->syncPermissions([
            $upvoteDownvotePermission,
        ]);
        $commenterRole->syncPermissions([
            $upvoteDownvotePermission,
            $manageCommentsPermission
        ]);
        $adminRole->syncPermissions([
            $manageFeaturesPermission,
            $manageUsersPermission,
            $manageCommentsPermission,
            $upvoteDownvotePermission,
        ]);


        User::factory()->create([
            'name' => 'User user',
            'email' => 'user@example.com'
        ])->assignRole(RolesEnum::User);

        User::factory()->create([
            'name' => 'Admin admin',
            'email' => 'admin@example.com'
        ])->assignRole(RolesEnum::Admin);

        User::factory()->create([
            'name' => 'Commenter commenter',
            'email' => 'commenter@example.com'
        ])->assignRole(RolesEnum::Commenter);

        Feature::factory(100)->create();
    }
}
