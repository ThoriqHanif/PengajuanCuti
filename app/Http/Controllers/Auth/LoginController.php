<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function loginPage()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password wajib diisi.',
            // 'password.min' => 'Password minimal harus 6 karakter.'
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            // return redirect()->route('login')->with('error', 'Login gagal!');
            return back()->withErrors(['email','password' => 'Email atau password salah.'])->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
