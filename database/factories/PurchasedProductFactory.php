<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\PurchasedProduct;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchasedProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchasedProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomNumber(2),
            'subtotal' => $this->faker->randomFloat(2, 1, 10000),
            'purchased_price' => $this->faker->randomFloat(2, 1, 1000),
            'purchased_name' => $this->faker->sentence(6),
            'purchased_image' => Image::all()->random()->image,
            'purchased_image_alt' => Image::all()->random()->alt,
            'purchase_order_id' => PurchaseOrder::all()->random()->id,
        ];
    }
}
