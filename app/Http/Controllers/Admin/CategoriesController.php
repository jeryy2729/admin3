<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Categories\CreateRequest; 
use App\Http\Requests\Categories\UpdateRequest;// ✅ Add this line
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
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

        // $category = Category::create($request->all());
        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');

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

    public function update(UpdateRequest $request,Category $category)
    {
        
        // $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');

        if ($category->update()) {
            return redirect()->route('categories.index')->with('success', 'Data has been updated successfully.');
        } else {
            return redirect()->route('categories.index')->with('error', 'Data has not been updated.');
        }
    }

    public function restore($id)
{
    $category = Category::onlyTrashed()->findOrFail($id);
    $category->restore();

    return redirect()->route('categories.index', ['trashed' => true])->with('success', 'Category restored successfully.');
}

public function destroy(Category $category)
{
    // $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
}


public function forceDelete($id)
{
    $category = Category::onlyTrashed()->findOrFail($id);
    
    if ($category->forceDelete()) {
        return redirect()->route('categories.index', ['trashed' => true])
            ->with('success', 'Category permanently deleted.');
    } else {
        return redirect()->route('categories.index', ['trashed' => true])
            ->with('error', 'Category could not be permanently deleted.');
    }
}


}
