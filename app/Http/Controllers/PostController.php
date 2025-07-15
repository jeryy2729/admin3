<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str; // Make sure this is at the top of the file
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
    {$slug = Str::slug($request->input('name'), '-');
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

    return redirect()->route('frontend.authpost')->with('success', 'Post created successfully.');
}
public function show($slug,Request $request)
{
        //  $post = Post::with(['category', 'tags'])->where('slug',$slug)->firstOrFail();
$post = Post::with([
        'category',
        'tags',
        'comments.user',         // Eager load the user who wrote each comment
        'comments.replies.user'  // Eager load users for nested replies
    ])->where('slug', $slug)->firstOrFail();

    // All categories and tags for sidebar or filtering
    $categories = Category::all();
    $tags = Tag::all();
    $post->increment('views');
       // Get the origin of the visit (optional: fallback to 'home')
    $from = $request->query('from', 'home');

    // If accessed from category, provide category context
    $category = $from === 'category' ? $post->category : null;
$tag = null;
if ($from === 'tag') {
    $tagSlug = $request->query('tag');
    $tag = Tag::where('slug', $tagSlug)->first();
}


    return view('frontend.post-detail', [
        'post' => $post,
        'categories' => $categories,
        'tags' => $tags,
        'tag' =>$tag,
        'from' => $from,
        'category' => $category,
    ]);
}


public function showPublic($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

 
$posts = $category->posts()->where('is_featured', 1)
        ->where('status', 1)
        ->where(function ($query) {
            $query->whereNull('user_id') // Admin post
                  ->orWhere(function ($q) {
                      $q->whereNotNull('user_id')  // User post
                        ->where('is_approved', 1); // Only approved
                  });}) ->paginate(3); // Get all posts with this tag

    return view('frontend.post', compact('category', 'posts'));
}

}
