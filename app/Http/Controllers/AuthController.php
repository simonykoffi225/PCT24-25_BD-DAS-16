<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.sign-in');
    }

public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if(Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Redirection de tous les utilisateurs vers la page d'accueil
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
    ])->onlyInput('email');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.sign-up');
    }

public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'date_naissance' => 'nullable|date',
        'genre' => 'nullable|in:homme,femme,autre',
        'contact' => 'nullable|string|max:20',
    ], [
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        'email.unique' => 'Cet email est déjà utilisé.',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'date_naissance' => $request->date_naissance,
        'genre' => $request->genre,
        'contact' => $request->contact,
        'role' => 'citoyen',
        'email_verified_at' => now(),
    ]);

    return redirect()->route('login')->with('success', 'Compte créé avec succès ! Veuillez vérifier votre email pour confirmer votre compte.');
}


    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function verifyEmail()
    {
        return view('auth.verify-email');
    }
}