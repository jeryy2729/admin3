<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
   

public function getAllposts()
{
    $posts = Post::where('is_featured', 1)
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
        'data' => $posts,]);
}


public function getAllcategories()
{
    $categories = Category::where('status', 1)->get();
      
     return response()->json([
        'status' => 'success',
        'data' => $categories,]);
}


public function getAlltags()
{
    $tags = Tag::where('status', 1)->get();
      
     return response()->json([
        'status' => 'success',
        'data' => $tags,]);
}



}
