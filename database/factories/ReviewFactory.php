<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'review' => $this->faker->randomFloat(1, 0, 5),
            'comment' => $this->faker->paragraph(),
            'user_id' => User::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ];
    }
}
