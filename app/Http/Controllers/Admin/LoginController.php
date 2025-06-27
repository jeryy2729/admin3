<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request; // ✅ Correct import
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}


    protected function showloginform()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8',],
          'email' => ['required', 'string', 'email', 'max:255', ],
        ]);

        $admin = Admin::where(['email' => $request->email])->first();

        if (!$admin) {
            return redirect()->back();
        } else {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
             
                return redirect(route('admin.home'));
              
            }
            else {
                return redirect()->back();
            }
        }
    }
 


public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
}

}
