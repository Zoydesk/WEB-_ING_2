<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Hash};

class AuthController extends Controller {
    public function showLogin(){ return view('auth.login'); }
    public function showRegister(){ return view('auth.register'); }

    public function register(Request $r){
        $data = $r->validate([
            'name'=>'required','email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name'=>$data['name'],'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
        Auth::login($user);
        return redirect()->route('home');
    }

    public function login(Request $r){
        $cred = $r->validate(['email'=>'required|email','password'=>'required']);
        if(Auth::attempt($cred)){ $r->session()->regenerate(); return redirect()->intended(); }
        return back()->withErrors(['email'=>'Credenciales inválidas']);
    }

    public function logout(Request $r){
        Auth::logout();
        $r->session()->invalidate(); $r->session()->regenerateToken();
        return redirect('/');
    }
}
