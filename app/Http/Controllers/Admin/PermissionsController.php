<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permissions=Permission::all();

        return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
                return view('admin.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    $request->validate([
        'name' => 'required|string|max:255',
    ]);
        //
        // $slug = Str::slug($request->input('name'), '-');

        // $permission = permission::create($request->all());
        $permission = new permission();
        $permission->name = trim(preg_replace('/\s+/', ' ', $request->input('name')));
                    // $permission->slug = $slug; // store the slug


       
        if ($permission->save()) {
            return redirect()->route('permissions.index')->with('success', 'Data has been inserted successfully.');
        } else {
            return redirect()->route('permissions.index')->with('error', 'Data has not been inserted.');
        }
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
            $permission = Permission::findOrFail($id);

                        return view('admin.permissions.edit',compact('permission'));

    }


    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Find the permission by ID

    // Update the name
        $permission = Permission::findOrFail($id);

    $permission->name = $request->input('name');

    // Optional: update slug
    // $permission->slug = Str::slug($request->input('name'), '-');

    // Save the changes
    $permission->save();

    // Redirect or return response
    return redirect()->back()->with('success', 'Permission updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
                $permission = Permission::findOrFail($id);

         $permission->delete();

    return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');

    }
}
