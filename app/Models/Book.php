<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table    = 'books';
    protected $fillable = ['title'];

    // public function author()
    public function authors() // теперь кгига принадлежит мноим аторам
    {
        // return $this->belongsTo(Author::class, 'author_id'); // это была связь 'one to many'
        return $this->belongsToMany(Author::class, 'author_books'); // 'many to many'
    }
}
