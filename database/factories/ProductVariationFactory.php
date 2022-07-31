<?php

namespace Database\Factories;

use App\Models\ProductVariation;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductVariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(6);
        $offerActive = $this->faker->boolean;
        $price = $this->faker->randomFloat(2, 2, 10000);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(250),
            'price' => ($offerActive)? $this->faker->randomFloat(2, 1, $price-1) : $price,
            'oldPrice' => ($offerActive)? $price : 0,
            'offerActive' => $offerActive,
            'stock' => $this->faker->randomNumber(4),
            'amountPurchased' => $this->faker->randomNumber(6),
            'size_id' => Size::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ];
    }
}
