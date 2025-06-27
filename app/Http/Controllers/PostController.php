<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $categories = Category::where('status', 1)
        ->whereHas('posts', function ($q) {
            $q->where('status', 1); // only if post is active
        })
        ->with(['posts' => function ($q) {
            $q->where('status', 1)->latest(); // load only active posts
        }])
        ->paginate(3)
        ->appends($request->all());

    return view('frontend.post', compact('categories'));
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
         public function show($id)
    {
        $post = Post::with('category', 'tags')->findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $tags = Tag::where('status', 1)->get();

        return view('frontend.post-detail', compact('post', 'categories', 'tags'));
    }
  

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
