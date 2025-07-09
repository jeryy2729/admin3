<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tag extends Model
{
    //
    use SoftDeletes;
    protected $table = 'tags';
 protected $dates = ['deleted_at']; 
    protected $fillable = [
        'name','description','status','slug'
    ];
        public function posts()
    {
        return $this->belongsToMany(Post::class); // Uses post_tag table
    }
    public function getRouteKeyName()
{
    return 'slug';
}


}
