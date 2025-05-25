<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesDemandesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $actesNaissance = $user->actesNaissance()->latest()->get();
        $actesMariage = $user->actesMariage()->latest()->get();
        $actesDeces = $user->actesDeces()->latest()->get();
        
        return view('frontend.mesnouvelledemande', compact('actesNaissance', 'actesMariage', 'actesDeces'));
    }
}