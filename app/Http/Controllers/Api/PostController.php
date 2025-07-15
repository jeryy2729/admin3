<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str; // Make sure this is at the top of the file
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
   
    public function store(Request $request)
    {$request->validate([
    'name' => 'required|string|max:255',
    'description' => 'required|string',
    'status' => 'nullable|boolean',
    'category_id' => 'required|exists:categories,id',
    'tags' => 'required|array',
    'tags.*' => 'exists:tags,id',
    'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
]);

        $slug = Str::slug($request->input('name'), '-');
        $imagePath = null;
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $imagePath = $image->storeAs('uploads/posts', $filename, 'public');
}

        $post = Post::create([
                        'user_id' => auth()->id(),

        'name' => $request->name,
                'slug' => $slug,
'description' => strip_tags($request->description),
        'status' => $request->status ?? 0,
        'category_id' => $request->category_id,
                    'image' => $imagePath,

    ]);

    // Attach tags using pivot table
    $post->tags()->sync($request->tags);
    return response()->json([
        'status' => 'success',
        'message' => 'Post created successfully',
        'post' => $post,
    ]);
}

}
