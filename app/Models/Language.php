<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
     protected $table = 'languages';
//  protected $dates = ['deleted_at']; 
    protected $fillable = [
        'name','code','status','slug'
    ];
   public function getRouteKeyName()
{
    return 'slug';
}

}
