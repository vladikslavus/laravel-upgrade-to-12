<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $words = $this->faker->words(2); // Массив из двух слов в нижнем регистре, например: ["nobis", "autem"]
        $title = ucfirst($words[0]) . ' ' . $words[1]; // "Nobis autem"

        return [
            'title' => $title,
        ];
    }
}
