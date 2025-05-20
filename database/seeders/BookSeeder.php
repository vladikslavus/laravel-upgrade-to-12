<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Добавляем эту строку

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Можно вручную
        // DB::table('books')->insert([
        //     [
        //         'title' => 'Title 1',
        //     ],
        //     [
        //         'title' => 'Title 2',
        //     ],
        //     [
        //         'title' => 'Title 3',
        //     ],
        // ]);

        // Но мы будем добавлять через Factory 5 книг
        Book::factory(5)->create();
    }
}
