<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['category' => 'Sin Categoría']);
        Category::create(['category' => 'Frazada']);
        Category::create(['category' => 'Edredón']);
        Category::create(['category' => 'Colcha']);
        Category::create(['category' => 'Cobertor']);
        Category::create(['category' => 'Sábana']);
        Category::create(['category' => 'Cortina']);
        Category::create(['category' => 'Cubre Salas']);
        Category::create(['category' => 'Mantel']);
        Category::create(['category' => 'Almohadas']);
        Category::create(['category' => 'Cubre Colchones']);
        Category::create(['category' => 'Toallas']);
        Category::create(['category' => 'Set de Baño']);
        Category::create(['category' => 'Set de Bebés']);
    }
}
