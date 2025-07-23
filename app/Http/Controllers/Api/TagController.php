<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
   

public function getpostsbytag($slug)
{
    // Find category by slug
    $tag = Tag::where('slug', $slug)
                        ->where('status', 1)
                        ->firstOrFail(); // Automatically throws 404 if not found

    // Fetch posts for this category
    $posts = Post::where('id', $tag->id)->where('status',1)
    ->where('is_featured',1)->get();

    return response()->json([
        'status' => 'success',
        'Tag' => $tag->name,
        'data' => $posts,
    ]);
}
}
