<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $bookTitles = array(
            "Ficciones",
            "Things Fall Apart",
            "Fairy tales"
        );

        foreach ($bookTitles as $bookTitle) {
            Book::create([
                "title" => $bookTitle,
                "author" => $content = "Jorge Luis Borges",
                "country" => $content = "Argentina",
                "imageLink" => $content = "null",
                "language" => $content = "Spanish",
                "link1" => $content = "",
                "link2" => $content = "",
                "pages" => $content = 20,
                "year" => $content = "1995",
                "descr" => $content = $faker->paragraph(15)
            ]);
        }
    }
}
