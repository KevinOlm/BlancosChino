<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::create(['size' => 'Sin tamaño']);
        Size::create(['size' => 'Cunero']);
        Size::create(['size' => 'Individual']);
        Size::create(['size' => 'Matrimonial']);
        Size::create(['size' => 'King-Size']);
        Size::create(['size' => 'Queen-size']);
    }
}
