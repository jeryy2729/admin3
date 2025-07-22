<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:view roles')->only('index');
    //     $this->middleware('permission:create roles')->only(['create', 'store']);
    //     $this->middleware('permission:edit roles')->only(['edit', 'update']);
    //     $this->middleware('permission:delete roles')->only('destroy');
    // }

    // List all roles
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Show form to create a new role
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    // Store a new role
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    // Clean and normalize the role name
    $roleName = trim(preg_replace('/\s+/', ' ', $request->name));

    // Create and assign role
    $role = new Role();
    $role->name = $roleName;
    $role->guard_name = strtolower($roleName) === 'admin' ? 'admin' : 'web';
    $role->save();

    // Attach permissions (if any)
    if (!empty($request->permissions)) {
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissionNames);
    }

    return redirect()->route('roles.index')->with('success', 'Role created successfully.');
}


    // Show form to edit an existing role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    // Update an existing role
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($id);
        $role->name = trim(preg_replace('/\s+/', ' ', $request->name));
        $role->save();

$permissionNames = Permission::whereIn('id', $request->permissions ?? [])->pluck('name')->toArray();
$role->syncPermissions($permissionNames);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Delete a role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
