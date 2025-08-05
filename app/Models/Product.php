<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
        protected $fillable = ['name', 'description', 'price', 'stock', 'image'];

     
public function posts()
{
    return $this->belongsToMany(Post::class);
}
//    public function getRouteKeyName()
// {
//     return 'slug';
// }
}
