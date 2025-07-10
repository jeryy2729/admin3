<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str; // Make sure this is at the top of the file
use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
public function create()
{
    $categories = Category::where('status', '1')->get(); // ✅ FILTERED
        $tags = Tag::where('status', '1')->get();            // ✅ Active tags only

    return view('admin.posts.create', compact('categories', 'tags'));
}

    // public function index()
    // {
    //     $posts = Post::latest()->get();

    //     foreach ($posts as $post) {
    //         $tagIds = explode(',', $post->tags);
    //         $post->tag_names = Tag::whereIn('id', $tagIds)->pluck('name')->toArray();
    //     }
public function index(Request $request)
{
    $showTrashed = $request->has('trashed');
    $search = $request->input('search');

    $query = Post::with(['category', 'tags']); // Eager load relationships

    // If trash view is requested
    if ($showTrashed) {
        $query->onlyTrashed();
    }

    // Apply search
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    $posts = $query->paginate(3)->appends($request->all());

    return view('admin.posts.index', compact('posts', 'showTrashed', 'search'));
}

    //     return view('admin.posts.index', compact('posts'));
    // }

   public function store(CreateRequest $request)
{ $slug = Str::slug($request->input('name'), '-');
         
$imagePath = null;
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $imagePath = $image->storeAs('uploads/posts', $filename, 'public');
}

    // Create the post and store the result in $post
    $post = Post::create([
        'name' => $request->name,
        'slug' => $slug,
        'description' => $request->description,
        'status' => $request->status ?? 0,
                'is_featured' => $request->is_featured ?? 0,

        'category_id' => $request->category_id,
        'user_id' => null,
            'image' => $imagePath,

    ]);

    // Attach tags using pivot table
    $post->tags()->sync($request->tags);

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}
public function edit(Post $post)
{
    $categories = Category::where('status', '1')->get();
    $tags = Tag::where('status','1')->get();
    $selectedTags = $post->tags->pluck('id')->toArray(); // ✅ CORRECT WAY

    return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
}

    public function update(UpdateRequest $request, Post $post)
{
    // Prepare data for update
    $updateData = [
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name, '-'),
        'description' => $request->description,
        'status' => $request->status ?? 0,
                'is_featured' => $request->is_featured ?? 0,

    ];

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('uploads/posts', $filename, 'public');

        // Optional: delete old image from storage
        // if ($post->image && Storage::disk('public')->exists($post->image)) {
        //     Storage::disk('public')->delete($post->image);
        // }

        $updateData['image'] = $path;
    }

    // Update post
    $post->update($updateData);

    // Sync tags
    $post->tags()->sync($request->tags);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}

    public function destroy(Post $post)
    {
        // $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
 public function restore($slug)
{{    $post = Post::onlyTrashed()->where('slug', $slug)->firstOrFail();

    $post->restore();

    return redirect()->route('posts.index', ['trashed' => true])->with('success', 'Post restored successfully.');
}


}
public function forceDelete($slug)
{
    $post = Post::onlyTrashed()->where('slug', $slug)->firstOrFail();

    if ($post->forceDelete()) {
        return redirect()->route('posts.index', ['trashed' => true])
            ->with('success', 'Post permanently deleted.');
    } else {
        return redirect()->route('posts.index', ['trashed' => true])
            ->with('error', 'post could not be permanently deleted.');
    }
}

public function approve($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail(); // ✅ find by slug
    $post->is_approved = true;
    $post->save();

    return redirect()->back()->with('success', 'Post approved successfully.');
}

}