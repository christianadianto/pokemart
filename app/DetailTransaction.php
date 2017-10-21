<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $fillable = [
        'pokemon_id','qty'
    ];

    protected $table = 'detail_transactions';

    protected function pokemon () {
        return $this->hasOne('App\Pokemon', "id", "pokemon_id");
    }
}
