<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * LOGIN
     */

    public function tampilLogin()
    {
        return view('login');
    }

    public function prosesLogin(Request $data)
    {
        $guard = $data->guard;

        // Ambil username dan password dari form login
        $username = $data->username;
        $password = $data->password;

        // Lakukan proses login dengan username dan password yang diinputkan
        $login = auth()->guard($guard)->attempt([
            'username' => $username,
            'password' => $password,
        ]);
        
        // Cek status login
        if($login == true){
            // Jika login sukses, tampilkan halaman dashboard
            return redirect()->route('tampilDashboard');
        } else {
            // Jika login gagal, redirect back ke halaman login
            return back()->with('alert', 'Login gagal, silahkan coba lagi.');
        }
    }

    /**
     * DASHBOARD
     */

    public function tampilDashboard()
    {
        $this->middleware('auth');
        return view('dashboard');
    }
}
