<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('books')->truncate();

        $books = [
            [
                'isbn' => '9780061122415',
                'title' => 'The Alchemist',
                'author_id' => 11,
                'category_id' => 1, 
                'genre_id' => 6,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'The Alchemist by Paulo Coelho continues to change the lives of its readers forever. With more than two million copies sold around the world, The Alchemist has established itself as a modern classic, universally admired.',
                'published_at' => '1998-05-28',
                'pages' => '208',
                'format' => 'paperback',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '978-0061626371',
                'title' => 'Brida',
                'author_id' => 11,
                'category_id' => 1,
                'genre_id' => 19,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'This is the story of Brida, an Irish girl, and her thirst for knowledge. She has always been interested in various aspects of magic, but now she is in search of something more. Her quest leads her to meet people of great wisdom who begin to teach her about the spiritual world. She encounters a wise man who teaches her to overcome her fears and a woman who teaches her how to dance to the rhythm of the world and pray to the moon. As Brida seeks her destiny, she struggles to find balance between her relationships and her desire to become a witch. This captivating novel incorporates themes that fans of Paulo Coelho will recognize and cherish—it is a story of love, passion, mystery, and spirituality from the master of fiction.',
                'published_at' => '2008-05-08',
                'pages' => '256',
                'format' => 'hardcover',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '978-1853260315',
                'title' => 'Twenty Thousand Leagues Under the Sea',
                'author_id' => 9,
                'category_id' => 6,
                'genre_id' => 21,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => '20,000 Leagues Under the Sea by Jules Verne. Twenty Thousand Leagues Under the Sea is a classic science fiction novel by French writer Jules Verne published in 1870. It tells the story of Captain Nemo and his submarine Nautilus, as seen from the perspective of Professor Pierre Aronnax after he, his servant Conseil, and Canadian whaler Ned Land wash up on their ship. On the Nautilus, the three embark on a journey which has them going all around the world, under the sea.',
                'published_at' => '1998-12-30',
                'pages' => '256',
                'format' => 'paperback',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '978-1505573947',
                'title' => 'Journey to the Center of the Earth',
                'author_id' => 9,
                'category_id' => 6,
                'genre_id' => 21,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'Journey to the Center of the Earth is a classic 1864 science fiction novel by Jules Verne. The story involves German professor Otto Lidenbrock who believes there are volcanic tubes going toward the centre of the Earth. He, his nephew Axel, and their guide Hans descend into the Icelandic volcano Snæfellsjökull, encountering many adventures, including prehistoric animals and natural hazards, before eventually coming to the surface again in southern Italy, at the Stromboli volcano.From a scientific point of view, this story has not aged quite as well as other Verne stories, since most of his ideas about what the interior of the Earth contains have since been disproved, but it still manages to captivate audiences when regarded as a classic fantasy novel.',
                'published_at' => '1865-05-30',
                'pages' => '146',
                'format' => 'paperback',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '978-1607963189',
                'title' => 'The Little Prince',
                'author_id' => 12,
                'category_id' => 3,
                'genre_id' => 10,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'The Little Prince describes his journey from planet to planet, each tiny world populated by a single adult. It\'s a wonderfully inventive sequence, which evokes not only the great fairy tales but also such monuments of postmodern whimsy. The author pokes similar fun at a businessman, a geographer, and a lamplighter, all of whom signify some futile aspect of adult existence.',
                'published_at' => '2010-12-14',
                'pages' => '110',
                'format' => 'hardcover',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '978-8765432109',
                'title' => 'Night Flight',
                'author_id' => 12,
                'category_id' => 6,
                'genre_id' => 1,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'The book is based on Saint-Exupérys experiences as an airmail pilot and as a director of the Aeroposta Argentina airline, based in Buenos Aires. The characters were inspired by the people Saint-Exupéry knew while working in South America. Notably, the character of Rivière was based on the airline\'s operations director Didier Daurat.',
                'published_at' => '1974-03-20',
                'pages' => '96',
                'format' => 'paperback',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '0060883286',
                'title' => 'One Hundred Years of Solitude',
                'author_id' => 7,
                'category_id' => 1,
                'genre_id' => 15,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'One Hundred Years of Solitude is the first piece of literature since the Book of Genesis that should be required reading for the entire human race. . . . Mr. Garcia Marquez has done nothing less than to create in the reader a sense of all that is profound, meaningful, and meaningless in life.',
                'published_at' => '2006-02-21',
                'pages' => '417',
                'format' => 'paperback',
                'user_created_id' => 1,
                'active' => 1,
            ],
            [
                'isbn' => '978-9876543210',
                'title' => 'Love in the Time of Cholera',
                'author_id' => 7,
                'category_id' => 1,
                'genre_id' => 19,
                'total_copies' => 10,
                'available_copies' => 10,
                'description' => 'Fifty-one years, nine months and four days have passed since Fermina Daza rebuffed hopeless romantic Florentino Ariza\'s impassioned advances and married Dr Juvenal Urbino instead. During that half-century, Flornetino has fallen into the arms of many delighted women, but has loved none but Fermina. Having sworn his eternal love to her, he lives for the day when he can court her again.',
                'published_at' => '1999-01-01',
                'pages' => '348',
                'format' => 'paperback',
                'user_created_id' => 1,
                'active' => 1,
            ]
        ];

        foreach ($books as $book) {
            DB::table('books')->insert([
                'isbn' => $book['isbn'],
                'title' => $book['title'],
                'author_id' => $book['author_id'],
                'category_id' => $book['category_id'],
                'genre_id' => $book['genre_id'],
                'total_copies' => $book['total_copies'],
                'available_copies' => $book['available_copies'],
                'description' => $book['description'],
                'published_at' => $book['published_at'],
                'pages' => $book['pages'],
                'format' => $book['format'],
                'user_created_id' => $book['user_created_id'],
                'active' => $book['active'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
