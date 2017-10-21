<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
        'name'
    ];

    protected function pokemon(){
        return $this->hasMany('App\Pokemon','element_id','id');
    }
}
