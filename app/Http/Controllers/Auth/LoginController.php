<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Summary of loginForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Summary of login
     * @param \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function store(LoginRequest $request)
    {
        $user = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        if ($user) {
            $user = Auth::user();
            return redirect()->route('shortner.create');
        } else {
            return redirect()->route('login')->withErrors(['Invalid Email and password']);
        }
    }

    /**
     * Summary of logout
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
