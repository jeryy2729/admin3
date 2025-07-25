<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
  public function index(Request $request)
{
    $tags = Tag::where('status', 1)
        ->whereHas('posts', function ($q) {
            $q->where('status', 1); // only if post is active
        })
        ->with(['posts' => function ($q) {
            $q->where('status', 1)->latest(); // load only active posts
        }])
        ->paginate(3)
        ->appends($request->all());

    return view('frontend.tags', compact('tags'));
}
public function show($slug,Request $request)
{
    $tag = Tag::where('status', 1)->where('slug',$slug)->firstOrFail();

    $posts = $tag->posts()->where('is_featured', 1)
        ->where('status', 1)
        ->where(function ($query) {
            $query->whereNull('user_id') // Admin post
                  ->orWhere(function ($q) {
                      $q->whereNotNull('user_id')  // User post
                        ->where('is_approved', 1); // Only approved
                  });}) ->paginate(3); // Get all posts with this tag

    $categories = Category::where('status', 1)->get();
    $tags = Tag::where('status', 1)->get();
       // Get the origin of the visit (optional: fallback to 'home')

    // If accessed from category, provide category context
    // $tag = $from === 'tag' ? $post->tag : null;

    return view('frontend.tag-post', compact('tag', 'posts', 'categories', 'tags'));
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
//     public function show($id)
//     {
//         $post = Post::with('tags')->findOrFail($id);
//         $tags = Tag::where('status', 1)->get();
       
//  $categories = Category::where('status', 1)->get();
//         return view('frontend.tag-post', compact('post','categories', 'tags'));
//     }
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
