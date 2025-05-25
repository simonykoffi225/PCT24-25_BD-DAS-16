<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('frontend.user.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        try {
            // Validation des données de base
            $baseData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                'date_naissance' => 'nullable|date',
                'genre' => 'nullable|in:homme,femme,autre',
                'contact' => 'nullable|string|max:20',
            ], [
                'name.required' => 'Le nom est obligatoire',
                'email.required' => 'L\'email est obligatoire',
                'email.email' => 'Veuillez entrer un email valide',
                'email.unique' => 'Cet email est déjà utilisé',
                'date_naissance.date' => 'La date de naissance doit être une date valide',
                'genre.in' => 'Le genre sélectionné est invalide',
                'contact.max' => 'Le contact ne doit pas dépasser 20 caractères'
            ]);
            
            // Mise à jour des données de base
            $user->update($baseData);
            
            // Gestion du rôle (admin seulement)
            if(auth()->user()->isAdmin() && $request->has('role')) {
                $user->update(['role' => $request->role]);
            }
            
            // Gestion du changement de mot de passe
            if ($request->filled('current_password')) {
                $passwordData = $request->validate([
                    'current_password' => 'required|current_password',
                    'new_password' => 'required|string|min:8|confirmed',
                ], [
                    'current_password.required' => 'Le mot de passe actuel est obligatoire',
                    'current_password.current_password' => 'Le mot de passe actuel est incorrect',
                    'new_password.required' => 'Le nouveau mot de passe est obligatoire',
                    'new_password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
                    'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas'
                ]);
                
                $user->update([
                    'password' => Hash::make($passwordData['new_password'])
                ]);
            }
            
            return back()->with([
                'success' => 'Profil mis à jour avec succès',
                'updated_fields' => array_keys($baseData) // Pour savoir quels champs ont été modifiés
            ]);
            
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Veuillez corriger les erreurs dans le formulaire');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Une erreur inattendue est survenue: '.$e->getMessage());
        }
    }
}