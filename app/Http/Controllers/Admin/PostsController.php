<?php

namespace App\Http\Controllers\Admin;
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
{
    // Create the post and store the result in $post
    $post = Post::create([
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status ?? 0,
        'category_id' => $request->category_id,
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
        $post->update([
            
            'category_id' => $request->category_id,
               'name' => $request->name,
  'description' => $request->description,
  'status' => $request->status,
        ]);
    $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        // $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
 public function restore($id)
{
    $post = Post::onlyTrashed()->findOrFail($id);
    $post->restore();

    return redirect()->route('posts.index', ['trashed' => true])->with('success', 'Post restored successfully.');
}



public function forceDelete($id)
{
    $post = Post::onlyTrashed()->findOrFail($id);
    
    if ($post->forceDelete()) {
        return redirect()->route('posts.index', ['trashed' => true])
            ->with('success', 'Post permanently deleted.');
    } else {
        return redirect()->route('posts.index', ['trashed' => true])
            ->with('error', 'post could not be permanently deleted.');
    }
}

public function approve($id)
{
    $post = Post::findOrFail($id);
    $post->is_approved = true;
    $post->save();

    return redirect()->back()->with('success', 'Post approved successfully.');
}

}