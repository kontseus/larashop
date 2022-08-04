<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(8)->create()->each(function($category) {
            Product::factory(rand(3,6))->make()->each(function($product) use ($category) {
                $category->products()->create($product->attributesToArray());
            });
        });
    }
}
