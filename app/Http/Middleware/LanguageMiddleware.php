<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\Language;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Session::has('locale'))
        {
            Session::put('locale',App::getLocale());
        }
        App::setLocale(Session('locale'));
$cur_lang = Language::where('code', session('locale'))
    ->where('status', 1)
    ->first();

$other_lang = Language::where('code', '!=', session('locale'))
    ->where('status', 1)
    ->get();
View::Share('clang',$cur_lang);
View::Share('olang',$other_lang);

        return $next($request);
    }
}
