<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    public $imageNumber = 0;
    public $imagePair = true;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if($this->imagePair) {
            $this->imageNumber++;
            $this->imagePair = false;
        }
        else $this->imagePair = true;

        return [
            'image' => 'products/' . $this->faker->image('public/storage/products', 720, 480, null, false),
            'alt' => $this->faker->sentence(6),
            'product_id' => $this->imageNumber
        ];
    }
}
