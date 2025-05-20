<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    public function show()
    {
        // $array = [
        //     'name' => 'Вася',
        //     'city' => 'Moscow',
        // ];

        //  return view('books.index', ['id' => $id]); или так
        // return view('books.index', compact('id', 'array'), ['title' => 'Книги']);

        // $book = Book::find($id);
        // echo $book->title;
        // echo '<br>';
        // echo $book->author->name;


        // $books = Book::where('author_id', '=', 1)->get();
        // $books = Book::with('author')->get();
        // $books = Book::with('author') // Жадно подгружаем автора
        //     ->whereHas('author', fn ($q) => $q->where('name', 'Бродский Иосиф'))
        //     ->get();
        // dump(get_class($books)); // "Illuminate\Database\Eloquent\Collection"
        // $output = '';
        // foreach ($books as $book) {
        //     $output .= $book->title . ' (<b>' . $book->author->name . '</b>)<br>'; // Формируем строку с переносами
        // }
        // echo $output; // Выводим результат

        // $authors = Author::where('name', 'Бродский Иосиф')->get(); // Лев Толстой
        // // dd($authors);
        // $output = '';
        // foreach ($authors as $author) {
        //     $output .= '<hr>' . $author->name . '<hr>';
        //     foreach ($author->books as $book) {
        //         $output .= $book->title . ' (<b>' . $author->name . '</b>)<br>';
        //     }
        // }
        // echo $output;


        // Many to many
        // $author = Author::find($id);
        // // dd($author->books);
        // echo $author->name . '<hr>';
        // foreach ($author->books as $book) {
        //     echo $book->title . '<br>';
        // }

        $authors = Author::all();
        $output  = '';
        foreach ($authors as $author) {
            $output .= '<hr>' . $author->name . '<hr>';
            foreach ($author->books as $book) {
                $output .= $book->title . ' (<b>' . $author->name . '</b>)<br>';
            }
        }
        echo $output;
    }

    // Вставляем книгу
    public function insertBookByAuthorId($id)
    {
        // Создаём книгу путём кода. Это OLDSCHOOL:
        // $book   = Book::create(['title' => 'После бала']);
        // $author = Author::find($id);
        // $author->books()->attach($book->id); // скобки!!! ->books() — для управления связями (изменение промежуточной таблицы), а не коллекция книг автора

        // Появился с Laravel 5.0+, не подходит для добавления разным авторам.
        $author = Author::find($id);
        $book   = $author->books()->create(['title' => 'Записки сумасшедшего']); // Точно так же можно приаттачивать и автора к книге (только всё наоборот)

        // Может встретиться такая альтернатива
        // $book        = new Book();
        // $book->title = 'Смерть Ивана Ильича';
        // $book->save();
        // $author = Author::find($id);
        // $author->books()->attach($book->id);


        echo 'Добавили книгу "' . $book->title . '" автору: ' . $author->name;
    }
}
