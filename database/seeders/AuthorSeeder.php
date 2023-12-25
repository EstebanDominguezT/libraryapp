<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('authors')->truncate();

        $authors = [
            [
                'fullname' => 'William Shakespeare',
                'born_date' => '1564-04-23',
                'email' => 'shakespeare@example.com',
                'biography' => 'Renowned playwright and poet...',
                'awards' => 'Numerous accolades for contributions to literature',
                'published_books' => 'Romeo and Juliet, Hamlet, Macbeth',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Jane Austen',
                'born_date' => '1775-12-16',
                'email' => 'janeausten@example.com',
                'biography' => 'Famous for novels exploring social commentary...',
                'awards' => 'No formal awards during her lifetime',
                'published_books' => 'Pride and Prejudice, Sense and Sensibility',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Leo Tolstoy',
                'born_date' => '1828-09-09',
                'email' => 'tolstoy@example.com',
                'biography' => 'Russian writer known for War and Peace and Anna Karenina...',
                'awards' => 'Nominated for the Nobel Prize in Literature',
                'published_books' => 'War and Peace, Anna Karenina',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Charles Dickens',
                'born_date' => '1812-02-07',
                'email' => 'dickens@example.com',
                'biography' => 'English writer and social critic...',
                'awards' => 'None during his lifetime, but widely recognized posthumously',
                'published_books' => 'A Tale of Two Cities, Great Expectations',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Mark Twain',
                'born_date' => '1835-11-30',
                'email' => 'twain@example.com',
                'biography' => 'American author and humorist...',
                'awards' => 'None officially, but highly acclaimed for his contributions',
                'published_books' => 'The Adventures of Tom Sawyer, Adventures of Huckleberry Finn',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Agatha Christie',
                'born_date' => '1890-09-15',
                'email' => 'christie@example.com',
                'biography' => 'English writer known for detective novels...',
                'awards' => 'Guinness World Records: Best-selling fiction author of all time',
                'published_books' => 'Murder on the Orient Express, And Then There Were None',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Gabriel Garcia Marquez',
                'born_date' => '1927-03-06',
                'email' => 'marquez@example.com',
                'biography' => 'Colombian novelist and Nobel Prize winner...',
                'awards' => 'Nobel Prize in Literature (1982)',
                'published_books' => 'One Hundred Years of Solitude, Love in the Time of Cholera',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Harper Lee',
                'born_date' => '1926-04-28',
                'email' => 'lee@example.com',
                'biography' => 'American novelist known for To Kill a Mockingbird...',
                'awards' => 'Pulitzer Prize for Fiction (1961)',
                'published_books' => 'To Kill a Mockingbird, Go Set a Watchman',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Julio Verne',
                'born_date' => '1828-02-08',
                'email' => '',
                'biography' => 'French novelist known for science fiction and adventure novels such as Twenty Thousand Leagues Under the Sea and Around the World in Eighty Days...',
                'awards' => 'None during his lifetime, but widely recognized posthumously',
                'published_books' => 'Twenty Thousand Leagues Under the Sea, Around the World in Eighty Days, Journey to the Center of the Earth, From the Earth to the Moon',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'J.R.R. Tolkien',
                'born_date' => '1892-01-03',
                'email' => '',
                'biography' => 'English writer known for The Lord of the Rings and The Hobbit...',
                'awards' => 'None during his lifetime, but widely recognized posthumously',
                'published_books' => 'The Lord of the Rings, The Hobbit, The Silmarillion',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Paulo Coelho',
                'born_date' => '1947-08-24',
                'email' => '',
                'biography' => 'Brazilian lyricist and novelist known for The Alchemist and Eleven Minutes...',
                'awards' => 'Guinness World Records: Most translated book by a living author (The Alchemist)',
                'published_books' => 'The Alchemist, Eleven Minutes, The Pilgrimage, The Witch of Portobello',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'fullname' => 'Antoine de Saint-Exupéry',
                'born_date' => '1900-06-29',
                'email' => 'saintexupery@example.com',
                'biography' => 'French writer, poet, and aviator best known for his novella The Little Prince...',
                'awards' => 'French Academy Grand Prix du Roman (1939)',
                'published_books' => 'The Little Prince, Night Flight',
                'user_created_id' => 1,
                'active' => 1,
            ]
        ];

        foreach ($authors as $author) {
            DB::table('authors')->insert([
                'fullname' => $author['fullname'],
                'born_date' => $author['born_date'],
                'email' => $author['email'],
                'biography' => $author['biography'],
                'awards' => $author['awards'],
                'published_books' => $author['published_books'],
                'user_created_id' => $author['user_created_id'],
                'active' => $author['active'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
