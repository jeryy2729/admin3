<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
   

public function getpostsbycategory($slug)
{
    // Find category by slug
    $category = Category::where('slug', $slug)
                        ->where('status', 1)
                        ->firstOrFail(); // Automatically throws 404 if not found

    // Fetch posts for this category
    $posts = Post::where('category_id', $category->id)->get();

    return response()->json([
        'status' => 'success',
        'category' => $category->name,
        'data' => $posts,
    ]);
}

public function search(Request $Request,$slug)
{
    $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
}
}
