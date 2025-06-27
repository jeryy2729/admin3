<?php

namespace App\Http\Controllers;
use App\Models\Category;
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
 // Only active categories
        return view('frontend.index', compact('categories'));
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
