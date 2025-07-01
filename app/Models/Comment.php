<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

        protected $fillable = [
        'user_id',
        'post_id',
        'comment', // include any other fields you want to allow mass assignment
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function post()
{
    return $this->belongsTo(Post::class, 'post_id');
}

}
