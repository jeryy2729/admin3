<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Requests\Languages\CreateRequest;
use App\Http\Requests\Languages\UpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
                $languages = Language::all();

        return view('admin.languages.create', compact('languages'));
    }

    public function store(CreateRequest $request)
    {
        $slug = Str::slug($request->input('name'), '-');

        $language = new Language();
        $language->name = $request->input('name');
        $language->code = $request->input('code');
        $language->slug = $slug;
        $language->status = $request->input('status');

        if ($language->save()) {
            return redirect()->route('languages.index')->with('success', 'Data has been inserted successfully.');
        }

        return redirect()->route('languages.index')->with('error', 'Data has not been inserted.');
    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    public function update(UpdateRequest $request, Language $language)
    {
        $language->name = $request->input('name');
        $language->code = $request->input('code');
        $language->slug = Str::slug($request->input('name'), '-');
        $language->status = $request->input('status') ?? 0;

        if ($language->update()) {
            return redirect()->route('languages.index')->with('success', 'Data has been updated successfully.');
        }

        return redirect()->route('languages.index')->with('error', 'Data has not been updated.');
    }

    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully.');
    }
    public function setLanguage($lang)
    {
        Session::put('locale',$lang);
        App::setLocale($lang);
        return redirect()->route('languages.index')->with('success', 'Language selected successfully.');
    }
}

