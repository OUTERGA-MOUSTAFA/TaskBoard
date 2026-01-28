<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str; 

// use Illuminate\Support\Facades\Hash; kandirha f model User 
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'Nom'      => 'required|string|max:255',
            'Prenom'   => 'required|string|max:255',
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
        
        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();
                                              //haker@test.com|192.168.1.1 => Cache
        // check how many user try to log for exemple 5 times pre defnier par laravel 
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Trop de tentatives. Veuillez réessayer dans $seconds secondes.",
            ]);
        }

        // Validation
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Rate enter
        if (Auth::attempt($credentials)) {
            RateLimiter::clear($throttleKey); // remove ratelimiter when seccess enter
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('welcome','Bienvenue');
        }

        // Counter increment 
        RateLimiter::hit($throttleKey);

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
{
    // clean user info Guard (Deconnecter)
    Auth::logout();

    //unset session and destroy
    $request->session()->invalidate();

    // for new session security
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'Vous êtes déconnecté.');
}

}
