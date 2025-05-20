<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'sometimes|string|max: 255',  // Убираем все required,
            'author_ids'   => 'sometimes|array|min:1',      // принимаем массив айдишников авторов. Чтобы не удалить случайно всех авторов у книги, запретим пустой массив
            'author_ids.*' => 'integer|distinct|exists:authors,id', // проверяем каждый эл-т массива - обязателен|тип|чтоб не повторялся айди|на существование author_id в таблице authors
        ];
    }
}
