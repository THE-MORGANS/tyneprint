<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            ['name' => 'Big prints', 'price' => 20000, 'category_id' => 1, 'sale_price'=> 15000, 'percentage' => 20, 'description' => 'This is a sample product for tyneprints website, desing and print your works at affordable price and fast delivery'],
            ['name' => 'Large format prints', 'price' => 50000, 'category_id' => 1,'sale_price'=> 30000,  'percentage' => 20, 'description' => 'This is a sample product for tyneprints website, desing and print your works at affordable price and fast delivery'],
            ['name' => 'Calender', 'price' => 10000, 'sale_price'=> 8000, 'category_id' => 1, 'percentage' => 20, 'description' => 'This is a sample product for tyneprints website, desing and print your works at affordable price and fast delivery'],
            ['name' => 'Newspaper', 'price' => 30000, 'sale_price'=> 25000,  'category_id' => 2,'percentage' => 20, 'description' => 'This is a sample product for tyneprints website, desing and print your works at affordable price and fast delivery'],
            ['name' => 'A4 paper prints', 'price' => 5000, 'sale_price'=> 3000, 'category_id' => 2, 'percentage' => 20, 'description' => 'This is a sample product for tyneprints website, desing and print your works at affordable price and fast delivery'],
            ['name' => 'tshirts', 'price' => 20000, 'sale_price'=> 15000, 'category_id' => 2,'percentage' => 20, 'description' => 'This is a sample product for tyneprints website, desing and print your works at affordable price and fast delivery'],

        ];

        foreach($product as $pro){

            Product::create($pro);
        }
    }
}
