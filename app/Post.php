<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

use User;
class Post extends Eloquent
{
    protected $collection = 'posts';
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo('User');
    }
}
