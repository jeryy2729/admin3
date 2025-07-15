<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register API
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user'   => $user,
            // 'token'  => $token,
        ]);
    }
   public function login(Request $request)
    {
        $credentials=$request->validate(
            [
            'email' => 'required|email',
                'password'=>'required',
            ]
            );
           $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }

        // If using Laravel Sanctum
    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json([
        'status' => 'success',
        'user' => $user,
        'token' => $token
    ]);
}
    public function logout(Request $request)
    {
        $user= $request->user();
           if ($user && $user->currentAccessToken()) {
        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }

    else{
    return response()->json([
        'status'=>'Success',
        'message'=>'Token is Already revoked',
    ]);

    }
    // Auth::logout();
    }

    }


        