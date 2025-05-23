<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function cityBooks()
    {
        // 1-й параметр это конечная модель/ 2-q через какую модель
        // Laravel и так всё поймёт, но в этом примере мы укажем внешние ключи
        return $this->hasManyThrough(
            Book::class,
            Library::class,
            'city_id',
            'library_id',
            'id',
            'id'
        );
    }
}
