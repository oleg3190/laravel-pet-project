<?php

namespace Database\Factories;

use Faker\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'author' => function () {
                return 1;
                //return \App\Models\Author::factory()->create()->id;
            }
        ];
    }
}
