<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Auth; // ✅ CORRECT
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
$pendingApprovals = Post::where('is_approved', 0)
                         ->whereNotNull('user_id') // Means created by a user
                         ->count();


        return view('admin.dashboard',compact('totalposts', 'pendingApprovals','totalcategories','totaluser','totalcomments'));
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
    public function edit()
    {
        //
        $admin=Auth::guard('admin')->user();
        return view('admin.profile.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, )
    {
        //
                $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $admin=Auth::guard('admin')->user();

        $admin->name = $request->name;
         if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
            return redirect()->route('admin.home')->with('success', 'Profile updated successfully.');
            
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
