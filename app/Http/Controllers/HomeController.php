<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        // return view('books.index', ['id' => $id]); или так
        // return view('books.index', compact('id', 'array'), ['title' => 'Книги']);

        $title = 'Главная: ссылки';

        return view('welcome', compact('title'));
    }
}
