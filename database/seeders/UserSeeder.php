<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Обращаемся к модели User и создаём 10 записей пользователей
        User::factory(10)->create();
    }
}
