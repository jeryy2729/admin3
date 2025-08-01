<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str; // Make sure this is at the top of the file
use App\Http\Requests\Tags\CreateRequest; 
use App\Http\Requests\Tags\UpdateRequest;// ✅ Add this line
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TagsImport;
use App\Exports\TagsExport; 

use Maatwebsite\Excel\Facades\Excel;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function create()
    {
        return view('admin.tags.create');
    }
 
public function index(Request $request)
{
    $showTrashed = $request->has('trashed');
    $search = $request->input('search');

    $query = Tag::query();

    // If "trashed" checkbox is active, show only deleted records
    if ($showTrashed) {
        $query = $query->onlyTrashed();
    }

    // Apply search filter if present
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }

    // Apply pagination (3 per page)
    $tags = $query->paginate(3)->appends($request->all());

    return view('admin.tags.index', compact('tags', 'showTrashed', 'search'));
}
    
    public function store(CreateRequest $request)
    {
    $slug = Str::slug($request->input('name'), '-');

        // $tag = Tag::create($request->all());
        $tag = new Tag();
        $tag->name = trim(preg_replace('/\s+/', ' ', $request->input('name')));
                    $tag->slug = $slug; // store the slug

$tag->description = strip_tags($request->input('description'));
        $tag->status = $request->input('status');

       
        if ($tag->save()) {
            return redirect()->route('tags.index')->with('success', 'Data has been inserted successfully.');
        } else {
            return redirect()->route('tags.index')->with('error', 'Data has not been inserted.');
        }
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateRequest $request,Tag $tag)
    {
        
        // $tag = Tag::find($id);
       $tag->name = $request->input('name');
 
    $tag->slug = Str::slug($request->input('name'), '-');

$tag->description = strip_tags($request->input('description'));


        if ($tag->update()) {
            return redirect()->route('tags.index')->with('success', 'Data has been updated successfully.');
        } else {
            return redirect()->route('tags.index')->with('error', 'Data has not been updated.');
        }
    }

    public function restore($slug)
{    $tag = Tag::onlyTrashed()->where('slug', $slug)->firstOrFail();

    $tag->restore();

    return redirect()->route('tags.index', ['trashed' => true])->with('success', 'Tag restored successfully.');
}

public function destroy(Tag $tag)
{
    // $tag = Tag::findOrFail($id);
    $tag->delete();

    return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
}


public function forceDelete($slug)
{    $tag = Tag::onlyTrashed()->where('slug', $slug)->firstOrFail();

    
    if ($tag->forceDelete()) {
        return redirect()->route('tags.index', ['trashed' => true])
            ->with('success', 'Tag permanently deleted.');
    } else {
        return redirect()->route('tags.index', ['trashed' => true])
            ->with('error', 'Tag could not be permanently deleted.');
    }
}
//    public function import()
// {
//     return view("excel");
// }
 public function import_post(Request $request)
{
    // $request->validate([
    //     'excel_file' => 'required|file|mimes:xlsx,xls,csv',
    // ]);

    Excel::import(new TagsImport, $request->file('excel_file'));

    return back()->with('success', 'Tags imported successfully.');
}

public function export()
{
    return Excel::download(new TagsExport, 'tags.xlsx');
}

}
