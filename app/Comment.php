<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id','pokemon_id','comment'
    ];

    protected $table = 'comments';
}
