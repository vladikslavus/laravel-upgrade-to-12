<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = Teacher::create(['name' => 'Мария Петровна']);
        $teacher = Teacher::create(['name' => 'Сергей Иванович']);
        $teacher = Teacher::create(['name' => 'Людмила Карповна']);
    }
}
