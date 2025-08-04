<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ProductController extends Controller
{
    //
    public function showProducts(Post $post)
{
    $products = $post->products()->latest()->get();

    return view('frontend.posts.products', compact('post', 'products'));
}

}
