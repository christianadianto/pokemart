<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'pokemon_id','qty','pokemon_price'
    ];

    protected $table = 'carts';
}
