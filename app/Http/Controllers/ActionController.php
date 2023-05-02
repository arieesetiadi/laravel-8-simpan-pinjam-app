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

    public function prosesLogin(Request $dataForm)
    {
        $dataLogin = $dataForm->only('username', 'password');
        dd($dataLogin);
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
