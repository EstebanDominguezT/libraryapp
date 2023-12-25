<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'create user', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit user', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete user', 'guard_name' => 'web']);
        Permission::create(['name' => 'create role', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit role', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete role', 'guard_name' => 'web']);
        Permission::create(['name' => 'create permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'create book', 'guard_name' => 'web']);
        Permission::create(['name' => 'show book', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit book', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete book', 'guard_name' => 'web']);
        Permission::create(['name' => 'create category', 'guard_name' => 'web']);
        Permission::create(['name' => 'show category', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit category', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete category', 'guard_name' => 'web']);
        Permission::create(['name' => 'create author', 'guard_name' => 'web']);
        Permission::create(['name' => 'show author', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit author', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete author', 'guard_name' => 'web']);
        Permission::create(['name' => 'create borrow', 'guard_name' => 'web']);
        Permission::create(['name' => 'show borrow', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit borrow', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete borrow', 'guard_name' => 'web']);
        Permission::create(['name' => 'create genre', 'guard_name' => 'web']);
        Permission::create(['name' => 'show genre', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit genre', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete genre', 'guard_name' => 'web']);
    }
}
