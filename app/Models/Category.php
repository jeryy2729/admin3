<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    //
    use SoftDeletes;
    protected $table = 'categories';
 protected $dates = ['deleted_at']; 
    protected $fillable = [
        'name','description','status'
    ];
        public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // posts

}
