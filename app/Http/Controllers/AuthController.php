<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'Nom'      => 'required|string|max:255',
            'Prenom'      => 'required|string|max:255',
            'Email'    => 'required|string|email|max:255|unique:users', // check email not repated
            'Password' => 'required|string|min:8|confirmed', // repate password check
        ]);

        // insert user
        $user = User::create([
            'nom'     => $request->Nom,
            'prenom'     => $request->Prenom,
            'email'    => $request->Email,
            'password' => $request->Password, // hash password on model Hash::make()
        ]);

        

        // redirect Dashboard
        return redirect('/login')->with('success', 'Bienvenue ! Compte créé avec succès');
    }


    public function login(Request $request)
    {
        // Validation
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt: Laravel hash pass and compare with database pass
        if (Auth::attempt($credentials)) {
            // Session
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // to Dashboard
        }

        // Error inputs
        return back()->withErrors([
            'email' => 'email ne pas correct!',
        ])->onlyInput('email');
    }

}
