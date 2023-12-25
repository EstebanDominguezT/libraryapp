<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'fullname' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin1234'),
                'phone' => '+595991321612',
                'address' => 'San Lorenzo, Paraguay',
                'born' => '2001-03-28',
                'role_id' => '1',
                'email_verified_at' => now(),
                'remember_token' => null,
            ],
            [
                'fullname' => 'Member Test',
                'email' => 'member@member.com',
                'password' => bcrypt('member1234'),
                'phone' => '+595995221110',
                'address' => 'Asuncion, Paraguay',
                'born' => '2001-03-28',
                'role_id' => '2',
                'email_verified_at' => now(),
                'remember_token' => null,
            ],
            [
                'fullname' => 'Esteban Dominguez',
                'email' => 'estebantalavera17@gmail.com',
                'password' => bcrypt('admin321'),
                'phone' => '+595994221011',
                'address' => '29 de Septiembre c/ Bruno Guggiari',
                'born' => '2001-03-28',
                'role_id' => '1',
                'email_verified_at' => now(),
                'remember_token' => null,
            ]
        ]);
    }
}
