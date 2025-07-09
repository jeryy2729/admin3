<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalposts=Post::count();
                $totalcategories=Category::count();
                        $totalcomments=Comment::count();
                        $totaluser=User::count();


        return view('admin.dashboard',compact('totalposts','totalcategories','totaluser','totalcomments'));
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
    public function show(string $id)
    {
        //
    }

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
