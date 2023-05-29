<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    /**
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        if(!auth()->attempt($request->validated()))
            return back()->with('not_success', 'Не верный логин или пароль');
        session()->regenerate();
        $token = auth()->user()->createToken(auth()->user()->login . now());
        session()->put('token', $token->plainTextToken);
        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        auth()->logout();
        session()->regenerate();
        return back();
    }
}
