<?php

use Illuminate\Database\Seeder;
use App\ProductVariation;
class PriceVariation extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $run = [

        ['product_id' => '1', 'price' => '40000', 'qty' => 40],
        ['product_id' => '1', 'price' => '50000', 'qty' => 50],
        ['product_id' => '1', 'price' => '100000', 'qty' => 100],
        ['product_id' => '1', 'price' => '150000', 'qty' => 150],
        ['product_id' => '1', 'price' => '200000', 'qty' => 200],
        ['product_id' => '1', 'price' => '250000', 'qty' => 250],

        ['product_id' => '2', 'price' => '40000', 'qty' => 40],
        ['product_id' => '2', 'price' => '50000', 'qty' => 50],
        ['product_id' => '2', 'price' => '100000', 'qty' => 100],
        ['product_id' => '2', 'price' => '150000', 'qty' => 150],
        ['product_id' => '2', 'price' => '200000', 'qty' => 200],
        ['product_id' => '2', 'price' => '250000', 'qty' => 250],
    
        ['product_id' => '3', 'price' => '40000', 'qty' => 40],
        ['product_id' => '3', 'price' => '50000', 'qty' => 50],
        ['product_id' => '3', 'price' => '100000', 'qty' => 100],
        ['product_id' => '3', 'price' => '150000', 'qty' => 150],
        ['product_id' => '3', 'price' => '200000', 'qty' => 200],
        ['product_id' => '3', 'price' => '250000', 'qty' => 250],
    
        ['product_id' => '4', 'price' => '40000', 'qty' => 40],
        ['product_id' => '4', 'price' => '50000', 'qty' => 50],
        ['product_id' => '4', 'price' => '100000', 'qty' => 100],
        ['product_id' => '4', 'price' => '150000', 'qty' => 150],
        ['product_id' => '4', 'price' => '200000', 'qty' => 200],
        ['product_id' => '4', 'price' => '250000', 'qty' => 250],
    
        ['product_id' => '4', 'price' => '40000', 'qty' => 40],
        ['product_id' => '4', 'price' => '50000', 'qty' => 50],
        ['product_id' => '4', 'price' => '100000', 'qty' => 100],
        ['product_id' => '4', 'price' => '150000', 'qty' => 150],
        ['product_id' => '4', 'price' => '200000', 'qty' => 200],
        ['product_id' => '4', 'price' => '250000', 'qty' => 250],

        ];

        foreach($run as $runs){

            ProductVariation::create($runs);


        }
    }
}
