<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    // To be used to get the name of the user who has added the post
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
