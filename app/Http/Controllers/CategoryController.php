<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
// public function index(Request $request)
// {
//     $search = $request->input('search');

//     $categories = Category::query()
//         ->when($search, function ($query, $search) {
//             return $query->where('name', 'LIKE', "%{$search}%")
//                          ->orWhere('description', 'LIKE', "%{$search}%");
//         })
//         ->where('status', 1)
//         ->withCount('posts')
//         ->get();

//     return view('frontend.index', compact('categories', 'search'));
// }
public function index(Request $request)
{
    $search = $request->input('search');

    $categories = Category::query()
        ->when($search, function ($q, $search) {
            $q->where('name', 'LIKE', "%{$search}%");
            //   ->orWhere('description', 'LIKE', "%{$search}%");
        })
        ->where('status', 1)
        ->withCount('posts')
        ->paginate(10) // ✅ Paginate 3 categories per page
        ->appends($request->all()); // ✅ Preserve search query in pagination links

    return view('frontend.categories', compact('categories', 'search'));
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
