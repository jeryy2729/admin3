<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index()
    {
    $categories = Category::withCount('posts') // This adds a `posts_count` attribute
                         ->where('status', 1)
                         ->get();
                               // Featured posts with conditional logic
    $posts = Post::where('is_featured', 1)
        ->where('status', 1)
        ->where(function ($query) {
            $query->whereNull('user_id') // Admin post
                  ->orWhere(function ($q) {
                      $q->whereNotNull('user_id')  // User post
                        ->where('is_approved', 1); // Only approved
                  });
        })
        ->latest()
        ->get();

    // Latest 5 comments
    $recentComments = Comment::latest()->take(5)->get();

    return view('frontend.index', compact('categories', 'posts', 'recentComments'));

        return view('frontend.index', compact('categories','posts','recentComments'));
    }


    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('post', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
