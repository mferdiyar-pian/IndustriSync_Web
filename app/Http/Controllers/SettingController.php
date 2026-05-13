<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $layout = 'user.layouts.app';
        
        if ($user->hasRole('admin') || $user->hasRole('owner') || $user->hasRole('staff')) {
            $layout = 'layouts.app';
        }

        return view('user.settings.index', compact('layout'));
    }

    public function updateLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:en,id',
        ]);

        Session::put('locale', $request->locale);

        return redirect()->back()->with('success', $request->locale == 'id' ? 'Bahasa berhasil diubah!' : 'Language changed successfully!');
    }
}
