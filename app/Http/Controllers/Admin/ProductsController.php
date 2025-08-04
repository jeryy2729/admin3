<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display all products.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $posts = Post::all(); // For attaching to posts
        return view('admin.products.create', compact('posts'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'post_ids' => 'nullable|array', // selected posts
        ]);

$imagePath = null;
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $imagePath = $image->storeAs('uploads/poducts', $filename, 'public');
}
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
                'stock' => $request->stock,

                        'image' => $imagePath,

        ]);

        // Attach to selected posts
        if ($request->has('post_ids')) {
            $product->posts()->sync($request->post_ids);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        $posts = Post::all();
        $selectedPosts = $product->posts->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'posts', 'selectedPosts'));
    }

    /**
     * Update the product.
     */
 public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string',
        'price' => 'required|numeric|min:1',
        'description' => 'nullable|string',
        'post_ids' => 'nullable|array',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
    ]);

    $updateData = [
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
    'stock' => $request->stock,


    ];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('uploads/products', $filename, 'public');
        $updateData['image'] = $path;
    }

    $product->update($updateData);

    // Sync posts
    $product->posts()->sync($request->post_ids ?? []);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    /**
     * Delete the product.
     */
    public function destroy(Product $product)
    {
        $product->posts()->detach(); // detach from pivot
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Show all products related to a post (optional).
     */
    // public function productsByPost($postId)
    // {
    //     $post = Post::findOrFail($postId);
    //     $products = $post->products;

    //     return view('posts.products', compact('post', 'products'));
    // }
}
