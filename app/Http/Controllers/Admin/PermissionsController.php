<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PermissionsController extends Controller 
{
//  public function __construct()
//     {
//         $this->middleware('permission:view permissions')->only('index');
//         $this->middleware('permission:create permissions')->only(['create', 'store']);
//         $this->middleware('permission:edit permissions')->only(['edit', 'update']);
//         $this->middleware('permission:delete permissions')->only('destroy');
//     }
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
        $permission = new Permission();
        $permission->name = trim(preg_replace('/\s+/', ' ', $request->input('name')));
                $permission->guard_name = 'web'; // required if using custom guard
           
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
     public function update(Request $request, Permission $permission)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
    ]);


    $permission->name = $request->input('name');

    // Optional: update slug
    // $permission->slug = Str::slug($request->input('name'), '-');

    // Save the changes
    // $permission->save();

    // Redirect or return response
     if ($permission->update()) {
        return redirect()->route('permissions.index')->with('success', 'Data has been updated successfully.');
    } else {
        return redirect()->route('permissions.index')->with('error', 'Data has not been updated.');
    } // return redirect()->back()->with('success', 'Permission updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //

         $permission->delete();

    return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');

    }
}
