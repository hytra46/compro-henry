<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index () {
        return view('login');
    }

    public function actionLogin(Request $request) {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // Jika email dan pass betul
        if (Auth::attempt($validate)) {
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors(['email' => 'Please check your email and password!!'])->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('login');
    }
}
