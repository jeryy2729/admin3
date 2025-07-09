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

    return view('frontend.posts.index', compact('categories'));
}
    public function authindex()
    {
$posts = Post::where('user_id', auth()->id())  // Filter posts by logged-in user
    ->latest()  // Order by latest posts
    ->paginate(3);  // Paginate the results (3 posts per page)
        return view('frontend.posts.authindex', compact('posts'));
    }

    public function create()
    {
          $categories = Category::where('status', '1')->get(); // ✅ FILTERED
        $tags = Tag::where('status', '1')->get();            // ✅ Active tags only

    return view('frontend.posts.create', compact('categories', 'tags'));
}

    public function store(Request $request)
    {
        $post = Post::create([
                        'user_id' => auth()->id(),

        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status ?? 0,
        'category_id' => $request->category_id,
    ]);

    // Attach tags using pivot table
    $post->tags()->sync($request->tags);

    return redirect()->route('user.posts.index')->with('success', 'Post created successfully.');
}
public function show($id)
{
         $post = Post::with(['category', 'tags'])->findOrFail($id);

    // All categories and tags for sidebar or filtering
    $categories = Category::all();
    $tags = Tag::all();

    return view('frontend.post-detail', [
        'post' => $post,
        // 'category' => $post->category,
        // 'postTags' => $post->tags,
        'categories' => $categories,
        'tags' => $tags,
    ]);
}
public function showPublic($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $posts = $category->posts()
        ->where(function ($query) {
            $query->whereNull('user_id') // admin post
                  ->orWhere('is_approved', 1); // approved user post
        })
        ->latest()
        ->paginate(6);

    return view('frontend.post', compact('category', 'posts'));
}

}
