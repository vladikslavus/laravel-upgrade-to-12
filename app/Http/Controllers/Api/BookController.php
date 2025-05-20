<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest; // Подключаем созданное в консоле правило для метода store, которое создавали: php artisan make:request BookStoreRequest
use App\Http\Requests\BookUpdateRequest;
// Отключаем use Illuminate\Http\Request; Будем делать SOLID
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return response()->json($books);
    }

    // Создание книги
    public function store(BookStoreRequest $request) // Отключаем use Illuminate\Http\Request; Будем делать SOLID
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|string|max: 255',
        // ]);
        // // dd($request->input(['title'])); // или
        // // dd($request->title); // или
        // dd($validatedData); // это ассоц. массив
        // dd($validatedData['title']);

        // // Мы будем делать по SOLID принципу – Single Responsibility Principle (SRP)
        // // (Принцип единственной ответственности) каждый класс должен решать только одну задачу.
        $validatedData = $request->validated();

        $book = Book::create(['title' => $validatedData['title']]);

        if (isset($validatedData['author_ids'])) {
            // authors() — строитель запроса для работы с отношением
            // Метод sync()
            // Удаляет все существующие связи этой книги в промежуточной таблице author_books
            // Создаёт новые связи с переданными author_ids
            // attach() — НЕ удаляет существующие связи этой книги, а добавляет новые записи
            $book->authors()->sync($validatedData['author_ids']);
        }

        return response()->json($book);
    }

    public function show($id)
    {
        // Для REST API → Вариант с try-catch (полная обработка ошибок).
        try {
            $book = Book::findOrFail($id);

            return response()->json($book);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], 404); // или 'Book not found'
        } catch (\Exception $exception) { // Глобальный класс PHP
            return response()->json(['message' => $exception->getMessage()], 500); // или 'An error occurred'
        }

        // // Для внутренних методов/SPA → Вариант с if (меньше кода).
        // $book = Book::find($id);
        // if (!$book) {
        //     return response()->json(['message' => 'Book not found'], 404);
        // }

        // return response()->json($book);
    }

    // Обновление книги
    public function update(BookUpdateRequest $request, $id) // Не зыбываем создать php artisan make:request BookUpdateRequest
    {
        $validatedData = $request->validated();

        $book = Book::findOrFail($id);
        // $book = Book::create(['title' => $validatedData['title']]);

        if (isset($validatedData['title'])) {
            $book->update(['title' => $validatedData['title']]);
        }
        // И обновляем связи, если переданы айдишники авторов
        if (isset($validatedData['author_ids'])) {
            $book->authors()->sync($validatedData['author_ids']);
        }

        return response()->json($book);
    }

    public function destroy($id)
    {
        // Для REST API → Вариант с try-catch (полная обработка ошибок).
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            return response()->json([], 204); // 204 No Content
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], 404); // или 'Book not found'
        } catch (\Exception $exception) { // Глобальный класс PHP
            return response()->json(['message' => $exception->getMessage()], 500); // или 'An error occurred'
        }

        // // Для внутренних методов/SPA → Вариант с if (меньше кода).
        // $book = Book::find($id);
        // if (!$book) {
        //     return response()->json(['message' => 'Book not found'], 404);
        // }
        // $book->delete();

        // // Для удаления используется код 204, если без сообщения (No Content), но мы вернём сообщение
        // return response()->json(['message' => 'Book deleted successfully'], 200);
        // // return response()->json([], 204);
    }
}
