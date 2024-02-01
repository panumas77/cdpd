<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {

        return view('auth.register');
    }
    public function store()
    {

        $validated = request()->validate(

            [
                'name' => 'required|min:10|max:100',
                'nickname' => 'required|min:3|max:20',
                'position' => 'required|min:10|max:50',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|min:3|max:20|unique:users,username',
                'password' => 'required|confirmed|min:8',
                'role' => 'required',
            ]
        );

        User::create(
            [
                'name' => $validated['name'],
                'nickname' => $validated['nickname'],
                'position' => $validated['position'],
                'email' => $validated['email'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]
        );

        return redirect()->route('dashboard')->with('success', 'สร้างบัญชีผู้ใช้ เรียบร้อย!');
    }
    public function login()
    {
        Session::put('previousUrl', url()->previous());
        return view('auth.login');
    }
    public function authenticate()
    {

        $validated = request()->validate(

            [
                'username' => 'required',
                'password' => 'required|min:8'
            ]
        );

        if(auth()->attempt($validated)){

            request()->session()->regenerate();

            return redirect()->route('home')->with('success', 'เข้าระบบแล้ว เรียบร้อย!');
        }

        return redirect()->route('login')->withErrors([
            'username' => 'ไม่พบชื่อผู้ใช้ หรือพาสเวิร์ด ไม่ถูกต้อง'
        ]);
    }
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'ออกระบบแล้ว เรียบร้อย!');
    }
}
