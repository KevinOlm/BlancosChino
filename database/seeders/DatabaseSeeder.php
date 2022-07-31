<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        // \App\Models\User::factory(10)->create();
        $this->call(SizeSeeder::class);
        $this->call(CategorySeeder::class);

        \App\Models\User::factory(20)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\ProductVariation::factory(40)->create();
        \App\Models\Review::factory(20)->create();
        \App\Models\Image::factory(40)->create();
        \App\Models\PurchaseOrder::factory(20)->create();
        \App\Models\PurchasedProduct::factory(40)->create();
    }
}
