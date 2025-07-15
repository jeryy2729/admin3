<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    $request->validate([
        'comment' => 'required|string|max:1000',
        'post_id' => 'required|numeric', // Just check it's numeric
    ]);

    Comment::create([
        'user_id' => auth()->id(),
                'parent_id' => null, // top-level comment
        'post_id' => $request->post_id,
        'comment' => $request->comment,
    ]);

    return back()->with('message', 'Comment added.');
}
public function reply(Request $request, $commentId)
{
    $parent = Comment::findOrFail($commentId);

    if ($parent->user_id == auth()->id()) {
        return back()->with('error', 'You cannot reply to your own comment.');
    }

    $request->validate([
        'comment' => 'required|string' // ✅ match the column name
    ]);

    Comment::create([
        'user_id'   => auth()->id(),
        'post_id'   => $parent->post_id,
        'parent_id' => $commentId,
        'comment'   => $request->comment, // ✅ use 'comment', not 'body'
    ]);

    return back()->with('success', 'Reply posted.');
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
