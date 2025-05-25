<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class FrontController extends Controller
{

    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function apropos(){
        return view('frontend.apropos');
    }

    public function aproposactedenaissance(){
        return view('frontend.aproposactedenaissance');
    }

    public function aproposactedemariage(){
        return view('frontend.aproposactedemariage');
    }

    public function aproposactededeces(){
        return view('frontend.aproposactededeces');
    }

    public function dashboard()
    {
        return view('frontend.dashboard');
    }

    public function listeactemariage()
    {
        return view('frontend.listeactemariage');
    }

    public function listeactenaissance()
    {
        return view('frontend.listeactenaissance');
    }

    public function listeactedeces()
    {
        return view('frontend.listeactedeces');
    }

    public function mesdemandes()
{
    // Récupérer l'ID de l'utilisateur connecté
    $userId = auth()->id();
    
    // Filtrer les demandes par user_id
    $demandes = Demande::where('user_id', $userId)
                       ->with(['user', 'acteNaissance']) // Charger les relations
                       ->orderBy('created_at', 'desc')   // Trier par date décroissante
                       ->paginate(10);

    return view('frontend.mesdemandes', compact('demandes'));
}

    public function profil()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté
        return view('frontend.user.profil', compact('user'));
    }



}
