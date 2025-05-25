<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function destroy(User $user)
    {
        // Empêche la suppression de l'utilisateur actuellement connecté
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user->delete();
        
        return redirect()->route('account')
            ->with('success', 'Utilisateur supprimé avec succès');
    }

    public function account(Request $request)
    {
        $query = \App\Models\User::query();
        
        // Filtrage par rôle
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }
        
        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('contact', 'like', '%'.$search.'%')
                ->orWhere('id', 'like', '%'.$search.'%');
            });
        }
        
        $users = $query->paginate(5);
        $roles = ['citoyen', 'officier', 'admin']; // Liste des rôles disponibles
        
        return view('frontend.account', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = ['citoyen', 'officier', 'admin'];
        return view('frontend.user.create', compact('roles'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:citoyen,officier,admin',
        'date_naissance' => 'nullable|date',
        'genre' => 'nullable|in:homme,femme,autre',
        'contact' => 'nullable|string|max:20',
        'signature' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048', // Ajouté
    ], [
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        'email.unique' => 'Cet email est déjà utilisé.',
        'role.required' => 'Le rôle est obligatoire.',
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'date_naissance' => $request->date_naissance,
        'genre' => $request->genre,
        'contact' => $request->contact,
    ];

// Gestion de l'upload de la signature
if ($request->hasFile('signature') && ($request->role === 'admin' || $request->role === 'officier')) {
    // Stockage dans public/storage/signatures
    $path = $request->file('signature')->store('signatures', 'public');
    $data['signature'] = $path; // Stocke le chemin relatif
}

    $user = User::create($data);

    return redirect()->route('account')->with('success', 'Compte créé avec succès !');
}
    
    public function show(User $user)
    {
       return view('frontend.user.show', [
        'user' => $user,
        'editRoute' => route('users.edit', $user->id)
    ]);
    }
    public function edit(User $user)
    {
        $roles = ['citoyen', 'officier', 'admin'];
        return view('frontend.user.edit', compact('user', 'roles'));
    }

   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'role' => 'required|in:citoyen,officier,admin',
        'date_naissance' => 'nullable|date',
        'genre' => 'nullable|in:homme,femme,autre',
        'contact' => 'nullable|string|max:20',
        'signature' => [
            'nullable',
            'file',
            function ($attribute, $value, $fail) {
                $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/svg+xml'];
                if (!in_array($value->getMimeType(), $allowedMimeTypes)) {
                    $fail('Le fichier doit être une image (PNG, JPG, JPEG ou SVG)');
                }
            },
            'max:2048'
        ],
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'date_naissance' => $request->date_naissance,
        'genre' => $request->genre,
        'contact' => $request->contact,
    ];

    // Gestion de la signature
    if ($request->has('remove_signature') && $request->remove_signature == '1') {
        // Supprimer la signature existante
        if ($user->signature) {
            Storage::disk('public')->delete($user->signature);
        }
        $data['signature'] = null;
    } elseif ($request->hasFile('signature') && ($request->role === 'admin' || $request->role === 'officier')) {
        // Valider le type de fichier manuellement
        $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/svg+xml'];
        if (!in_array($request->file('signature')->getMimeType(), $allowedMimeTypes)) {
            return back()->withErrors(['signature' => 'Le fichier doit être une image (PNG, JPG, JPEG ou SVG)']);
        }

        // Uploader une nouvelle signature
        if ($user->signature) {
            Storage::disk('public')->delete($user->signature);
        }
        $signaturePath = $request->file('signature')->store('signatures', 'public');
        $data['signature'] = $signaturePath;
    }

    $user->update($data);

    return redirect()->route('users.show', $user->id)
        ->with('success', 'Utilisateur mis à jour avec succès !');
}
}