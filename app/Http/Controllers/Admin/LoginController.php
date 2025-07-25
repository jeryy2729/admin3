<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request; // ✅ Correct import
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // ✅ CORRECT

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  protected $redirectTo = '/admin/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
 protected function guard()
{
    return Auth::guard('admin');
}

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:web')->except('logout');
    }


    protected function showloginform()
    {
        return view('auth.login');
    }
     public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Try Admin Login
    if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
        return redirect()->route('admin.home');
    }

    // Try Blogger Login (users table with 'blogger' role)
    if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
        $user = Auth::guard('web')->user();

        if ($user->hasRole('blogger')) {
            return redirect()->route('admin.home');
        }
//          elseif ($user->hasRole('staff')) {
//     return redirect()->route('admin.home');
// }

        else {
            Auth::guard('web')->logout();
            return back()->withErrors(['email' => 'Only bloggers are allowed in the admin panel.']);
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}

public function logout(Request $request)
{
    Auth::guard('admin')->logout();
            Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

}
