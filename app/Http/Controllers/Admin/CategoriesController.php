<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str; // Make sure this is at the top of the file
use App\Http\Requests\Categories\CreateRequest; 
use App\Http\Requests\Categories\UpdateRequest;// ✅ Add this line
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    
// public function __construct()
// {
//     // Allow admin, blogger, or staff to access index
//     $this->middleware('role:staff', ['only' => ['show']]);
//     $this->middleware(function ($request, $next) {
//         if (auth()->check() && auth()->user()->hasRole('staff') && $request->route()->getActionMethod() !== 'show') {
//             abort(403, 'Unauthorized: staff can only access show.');
//         }
//         return $next($request);
//     });

    

// }

    /**
     * Display a listing of the resource.
     */
   public function create()
    {
        return view('admin.categories.create');
    }

public function index(Request $request)
{
    $showTrashed = $request->has('trashed');
    $search = $request->input('search');

    $query = Category::query();

    // If "trashed" checkbox is active, show only deleted records
    if ($showTrashed) {
        $query = $query->onlyTrashed();
    }

    // Apply search filter if present
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    // Apply pagination (3 per page)
    $categories = $query->paginate(3)->appends($request->all());

    return view('admin.categories.index', compact('categories', 'showTrashed', 'search'));
}


         
      

    
    public function store(CreateRequest $request)
    {
    $slug = Str::slug($request->input('name'), '-');
        // $category = Category::create($request->all());
        $category = new Category();
        $category->name = $request->input('name');
            $category->slug = $slug; // store the slug

        $category->description = $request->input('description');
        $category->status = $request->input('status');
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('uploads/categories', $filename, 'public');
        $category->image = $path;
    }

        if ($category->save()) {
            return redirect()->route('categories.index')->with('success', 'Data has been inserted successfully.');
        } else {
            return redirect()->route('categories.index')->with('error', 'Data has not been inserted.');
        }
    }

 public function edit(Category $category)
{
    return view('admin.categories.edit', compact('category'));
}

public function update(UpdateRequest $request, Category $category)
{
    $category->name = $request->input('name');
    $category->slug = Str::slug($request->input('name'), '-');
    $category->description = $request->input('description');
    // $category->status = $request->input('status');
            $category->status = $request->input('status') ?? 0;


    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('uploads/categories', $filename, 'public');
        $category->image = $path;
    }

    if ($category->update()) {
        return redirect()->route('categories.index')->with('success', 'Data has been updated successfully.');
    } else {
        return redirect()->route('categories.index')->with('error', 'Data has not been updated.');
    }
}
 public function destroy(Category $category)
{
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
}

public function restore($slug)
{
    $category = Category::onlyTrashed()->where('slug', $slug)->firstOrFail();
    $category->restore();

    return redirect()->route('categories.index', ['trashed' => true])
        ->with('success', 'Category restored successfully.');
}

public function forceDelete($slug)
{
    $category = Category::onlyTrashed()->where('slug', $slug)->firstOrFail();

    if ($category->forceDelete()) {
        return redirect()->route('categories.index', ['trashed' => true])
            ->with('success', 'Category permanently deleted.');
    } else {
        return redirect()->route('categories.index', ['trashed' => true])
            ->with('error', 'Category could not be permanently deleted.');
    }

}

// public function show()
// {
//     return redirect()->route('categories.index');
// }

}