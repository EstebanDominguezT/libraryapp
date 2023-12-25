<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_1 = Role::create(['name' => 'librarian']);
        $role_2 = Role::create(['name' => 'member']);

        $role_api_1 = Role::create(['name' => 'librarian', 'guard_name' => 'api']);
        $role_api_2 = Role::create(['name' => 'member', 'guard_name' => 'api']);

        $user = User::find(1);
        $user->assignRole($role_1);

        $user = User::find(2);
        $user->assignRole($role_2);
        $user->givePermissionTo('show borrow');
        $user->givePermissionTo('create borrow');

        $user = User::find(1);
        $user->assignRole($role_api_1);

        $user = User::find(2);
        $user->assignRole($role_api_2);
    }
}
