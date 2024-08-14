<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class SiswaLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.siswa-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis',
            'password' => 'required',
        ]);
        $credentials = $request->only('nis', 'password');

        if (Auth::guard('siswas')->attempt($credentials)) {
            $user = Auth::guard('siswas')->user();
            if ($user->hasRole('siswa')) {
                return redirect()->intended('/dashboard');
            }
    
            return redirect()->intended('/home');
        }
        return back()->withErrors([
            'nis' => 'The provided NISN or password is incorrect.',
        ]);
    }

    public function logout()
    {
        Auth::guard('siswas')->logout();
        return redirect('/');
    }
}
