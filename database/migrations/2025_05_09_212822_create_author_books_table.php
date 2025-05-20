<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('author_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('author_id');

            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete();
            $table->foreign('author_id')->references('id')->on('authors')->cascadeOnDelete();

            // Новый синтаксис начиная с Laravel 7 сразу создает поле и делает его внешним ключём
            // $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('author_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_books');
    }
};
