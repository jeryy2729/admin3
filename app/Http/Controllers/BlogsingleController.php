<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class BlogsingleController extends Controller
{
    //
    // use App\Models\Category;

public function index()
{
    // $categories = Category::with('posts')->get(); // No filter, fetch all
    // return view('frontend.blog-single', compact('categories'));
      // Get all categories with their active posts
        $categories = Category::with(['posts' => function($q) {
            $q->where('status', 1)->latest();
        }])->where('status', 1)->get();

        return view('frontend.blog-single', compact('categories'));

}

}
