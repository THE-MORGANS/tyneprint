<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminNotify extends Model
{
    protected $fillable = [

        'message',
        'is_new'
    ];
}
