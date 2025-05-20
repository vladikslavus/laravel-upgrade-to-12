<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = Student::create(['name' => 'Влад Белецкий']);

        // Создадим оценки студента
        $student->grades()->createMany([
            ['score' => 5, 'received_at' => Carbon::parse('2023-09-14')],
            ['score' => 4, 'received_at' => Carbon::parse('2023-09-10')],
            ['score' => 4, 'received_at' => Carbon::parse('2023-09-07')],
            ['score' => 5, 'received_at' => Carbon::parse('2023-09-05')],
            ['score' => 5, 'received_at' => Carbon::parse('2023-09-04')],
        ]);
    }
}
