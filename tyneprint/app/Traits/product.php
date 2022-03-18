<?php

namespace App\Traits\product;

trait product
{



    private function ProductStore($request){
        return $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $request->image,
            'gallery' => $request->gallery,
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'percentage' => $request->percentage
        ];
    }





}