<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $fillable = [
        'name','element_id','image','gender','description','price',
    ];

    protected $table = 'pokemons';

    protected function element(){
        return $this->hasOne('App\Element','id','element_id');
    }

}
