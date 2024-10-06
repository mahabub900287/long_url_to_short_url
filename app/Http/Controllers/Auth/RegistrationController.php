<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmail;

class RegistrationController extends Controller
{
    /**
     * Registration form
     */
    public function create()
    {
        return view('auth.registration');
    }

    /**
     * Registration form submit
     */
    public function store(RegistrationRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->save();

        //$user->notify(new VerifyEmail($user));
        session()->flash('message', 'Thanks for Registration');
        return redirect()->route('login');
    }
}
