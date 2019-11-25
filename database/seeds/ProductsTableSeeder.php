<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Thread', 'Cloth', 'Raw'];
        foreach($categories as $category){
            DB::table('product_categories')->insert([
                'name' => $category
            ]);
        }
        $brands = ['Sony', 'Samsung', 'Nokia'];
        foreach($brands as $brand){
            DB::table('brands')->insert([
                'name' => $brand
            ]);
        }
        $products = factory(Product::class, 20)->create();
    }
}
