<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::where('nama', $request->nama)->first();

        if (!$user) {
            return back()->withErrors(['nama' => 'Nama tidak ditemukan.']);
        }

        $user->password = bcrypt($request->password_baru);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('nama', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika password adalah admin123, arahkan ke halaman admin
            if ($request->password === 'admin123') {
                return redirect()->route('admin.dashboard');
            }

            // Selain itu, arahkan ke halaman dashboard biasa
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'nama' => 'Nama atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}

