<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('genres')->truncate();

        $genres = [
            [
                "description" => "Action and Adventure",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Art",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Alternate History",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Anthology",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Crime and Detective",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Drama",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Fable",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Fairy Tale",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Fan-Fiction",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Fantasy",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Historical Fiction",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Horror",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Humor",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Legend",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Magical Realism",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Mystery",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Mythology",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Realistic Fiction",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Romance",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Satire",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Science Fiction (Sci-Fi)",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Short Story",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Suspense/Thriller",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Biography/Autobiography",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Essay",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Memoir",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Narrative Nonfiction",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Periodicals",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Reference Books",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Self-Help Book",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Speech",
                "user_created_id" => "1",
                "active" => "1"
            ],
            [
                "description" => "Textbook",
                "user_created_id" => "1",
                "active" => "1"
            ]
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'description' => $genre['description'],
                'user_created_id' => $genre['user_created_id'],
                'active' => $genre['active'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
