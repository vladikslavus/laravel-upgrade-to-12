<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Если нужна авторизация — можно добавить проверку
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max: 255',
            'author_ids'   => 'required|array', // принимаем массив айдишников авторов
            'author_ids.*' => 'required|integer|distinct|exists:authors,id', // проверяем каждый эл-т массива - обязателен|тип|чтоб не повторялся айди|на существование author_id в таблице authors
        ];
    }
}
