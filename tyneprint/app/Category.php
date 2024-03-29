<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [

    'name',
    'image'
    ];


public function products(){

    return $this->hasMany(Product::class)->where('status', '!=', 1);
}
}
