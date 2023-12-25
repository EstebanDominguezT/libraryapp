<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();

        $categories = [
            [
                "description" => "Fiction",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Non-fiction",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Children's and Young Adult",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Poetry",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Religion and Spirituality",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Fantasy",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Arts and Photography",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Business and Economics",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Historical",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Science and Nature",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Education",
                "user_created_id" => "1",
                "active" => "1"
            ]
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'description' => $category['description'],
                'user_created_id' => $category['user_created_id'],
                'active' => $category['active'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
