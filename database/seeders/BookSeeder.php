<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'price' => 12.99,
                'description' => 'A story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'image' => 'great-gatsby.jpg',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'price' => 14.99,
                'description' => 'A novel about racial injustice in the Deep South, seen through the eyes of young Scout Finch.',
                'image' => 'to-kill-a-mockingbird.jpg',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'price' => 11.99,
                'description' => 'A dystopian novel set in a totalitarian society ruled by Big Brother.',
                'image' => '1984.jpg',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'price' => 9.99,
                'description' => 'A romantic novel following Elizabeth Bennet as she navigates issues of manners, morality, and marriage.',
                'image' => 'pride-and-prejudice.jpg',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'price' => 13.99,
                'description' => 'A story about teenage angst and alienation, narrated by Holden Caulfield.',
                'image' => 'catcher-in-the-rye.jpg',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'price' => 15.99,
                'description' => 'Bilbo Baggins embarks on an unexpected journey to reclaim the lost Dwarf Kingdom of Erebor.',
                'image' => 'the-hobbit.jpg',
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'price' => 18.99,
                'description' => 'Set on the desert planet Arrakis, this epic tale explores politics, religion, and ecology.',
                'image' => 'dune.jpg',
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'price' => 10.99,
                'description' => 'A shepherd boy named Santiago travels from Spain to Egypt in search of treasure.',
                'image' => 'the-alchemist.jpg',
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'price' => 12.99,
                'description' => 'A futuristic society where humans are genetically modified and socially conditioned.',
                'image' => 'brave-new-world.jpg',
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'price' => 24.99,
                'description' => 'An epic high-fantasy novel following the Fellowship in their quest to destroy the One Ring.',
                'image' => 'lord-of-the-rings.jpg',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
