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
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // foreignId() создаёт колонку автоматически (UNSIGNED BIGINT)
            $table->foreignId('author_id') // Создаёт колонку И сразу делает её внешним ключом
                ->after('title')           // Добавляем после поля 'title'
                ->constrained()            // Автоматически связывает с `id` таблицы `authors`
                ->cascadeOnDelete();       // Каскадное удаление
        });
    }
};
