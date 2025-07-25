<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
           return response()->json([
        'status' => 'success',
        'data' => User::all()
    ]);
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
                return view('frontend.profile.edit', [
            'user' => Auth::user()
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
                $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user=Auth::user();

        $user->name = $request->name;
         if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
            return redirect()->route('frontend.index')->with('success', 'Profile updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
