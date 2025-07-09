<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    protected $fillable = ['category_id', 'tags','description','status','name','user_id', 'is_approved','slug','image','is_featured'];

    // public function getTagListAttribute()
    // {
    //     return explode(',', $this->tags);
    // }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
      use SoftDeletes;
      protected $dates = ['deleted_at']; 

        public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class); // Uses post_tag table
    }
    public function comments()
{
    return $this->hasMany(Comment::class, 'post_id')->latest();
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    // tags => belongsToMany -> pivot table -> without model
    public function getRouteKeyName()
{
    return 'slug';
}

}

