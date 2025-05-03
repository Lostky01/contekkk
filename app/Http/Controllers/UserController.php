<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerShow() {
        return view('register');

    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required'
        ]);

        $user = New Pengguna();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();

        /* dd($user); */

        return back()->with('success', 'Registrasi berhasil!');

    }

    public function loginShow() {
        return view('login');
    }

    public function login(Request $request) {   
        $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);

        $user = Pengguna::where('username', $request->username)->first();
        if($user->password == $request->password) {
            /* dd('the password is correct' . $user); */
            session(['user' => $user]);
            return redirect()->route('main')->with('success', 'Login berhasil!, selamat datang user ' . $user->nama);
        } else {
            return redirect()->back()->with('error', 'Username atau password salah!');
            /* dd('the password is incorrect' . $user); */
        }
    }

    public function logout() {
        session()->flush();
        return redirect()->route('login');  
    }
}


