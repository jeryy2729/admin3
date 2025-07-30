<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;


class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
   

public function getAllposts()
{
    $posts = Post::with('category') // eager load the relation
        ->where('is_featured', 1)
        ->where('status', 1)
        ->where(function ($query) {
            $query->whereNull('user_id')
                  ->orWhere(function ($q) {
                      $q->whereNotNull('user_id')
                        ->where('is_approved', 1);
                  });
        })
        ->latest()
        ->get();

    return response()->json([
        'status' => 'success',
        'data' => PostResource::collection($posts), // ✅ Use the resource here
    ]);
}

public function getAllcategories()
{
    $categories = Category::where('status', 1)->get();
      
     return response()->json([
        'status' => 'success',
        'data' => CategoryResource::collection($categories),]);
}


public function getAlltags()
{
    $tags = Tag::where('status', 1)->get();
          return TagResource::collection($tags);

}



}
