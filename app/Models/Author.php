<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    public function books()
    {
        // return $this->hasMany(Book::class, 'author_id'); // это была связь 'one to many'
        return $this->belongsToMany(Book::class, 'author_books'); // 'many to many'
    }
}
