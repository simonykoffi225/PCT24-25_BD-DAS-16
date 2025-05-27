<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\User;
use App\Models\Payment;
use App\Models\Localite; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. Récupération et Traitement des paramètres de filtre ---
        // Dates (format YYYY-MM-DD)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->toDateString());
        // Type d'acte (naissance, mariage, deces, ou all)
        $acteType = $request->input('acte_type', 'all');
        // Statut de la demande (traitee, en_attente, rejetee, ou all)
        $demandeStatus = $request->input('demande_status', 'all');
        // ID de la localité (pour filtrer par localité spécifique)
        $localiteId = $request->input('localite_id', 'all');

        // Assurez-vous que les dates sont des objets Carbon pour faciliter les comparaisons
        $startDateCarbon = Carbon::parse($startDate)->startOfDay();
        $endDateCarbon = Carbon::parse($endDate)->endOfDay();

        // --- 2. Récupération des KPIs (Indicateurs Clés de Performance) ---
        $kpis = $this->getKpis($startDateCarbon, $endDateCarbon, $acteType, $demandeStatus, $localiteId);

        // --- 3. Récupération des données pour les graphiques ---
        $graphData = $this->getGraphData($startDateCarbon, $endDateCarbon, $acteType, $demandeStatus, $localiteId);

        // --- 4. Récupération des données pour le tableau détaillé des demandes récentes ---
        // Le tableau de demandes récentes est maintenant filtré par période et autres critères
        $demandesRecentes = $this->getDetailedDemandes($startDateCarbon, $endDateCarbon, $acteType, $demandeStatus, $localiteId);

        // --- 5. Options pour les filtres ---
        $filterOptions = [
            'acteTypes' => $this->getActeTypes(), // Types d'actes pour le filtre
            'demandeStatuses' => $this->getDemandeStatuses(), // Statuts de demandes
            'localites' => $this->getLocalitesForFilter(), // Localités pour le filtre
        ];

        // --- 6. Passer les données à la vue ---
        return view('frontend.dashboard', compact(
            'kpis',
            'graphData',
            'demandesRecentes',
            'filterOptions',
            'startDate', // Passer les chaînes de date pour pré-remplir les inputs HTML
            'endDate',
            'acteType',
            'demandeStatus',
            'localiteId'
        ));
    }

    /**
     * Récupère les indicateurs clés de performance basés sur les filtres.
     */
    private function getKpis($startDate, $endDate, $acteType, $demandeStatus, $localiteId)
    {
        // Base de la requête pour les demandes
        $baseQuery = Demande::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($acteType !== 'all', function ($query) use ($acteType) {
                return $query->where('type_acte', $acteType);
            })
            ->when($demandeStatus !== 'all', function ($query) use ($demandeStatus) {
                return $query->where('statut', $demandeStatus);
            })
            ->when($localiteId !== 'all', function ($query) use ($localiteId) {
                return $query->where('localite_id', $localiteId);
            });

        // Total des demandes pour la période et les filtres
        $totalDemandes = $baseQuery->count();

        // Demandes traitées pour la période et les filtres
        $totalDemandesTraitees = (clone $baseQuery)->where('statut', 'traitee')->count();
        $tauxCompletionDemandes = ($totalDemandes > 0) ? round(($totalDemandesTraitees / $totalDemandes) * 100, 2) : 0;

        // Total des citoyens (Ce KPI n'est pas lié à la période, mais on le garde)
        $totalCitoyens = User::count();

        // Revenu total pour la période et les filtres (les paiements doivent être liés aux demandes)
        // Supposons que la table 'payments' a un 'demande_id'
        $totalRevenu = Payment::whereBetween('created_at', [$startDate, $endDate])
            ->when($localiteId !== 'all', function ($query) use ($localiteId) {
                // Si la table payments a une localite_id, sinon joindre demandes
                return $query->whereIn('demande_id', Demande::where('localite_id', $localiteId)->pluck('id'));
            })
            ->sum('montant');


        // Actes spécifiques filtrés par période et type d'acte (si applicable)
        $actesNaissanceCount = (clone $baseQuery)->where('type_acte', 'naissance')->count();
        $actesMariageCount = (clone $baseQuery)->where('type_acte', 'mariage')->count();
        $actesDecesCount = (clone $baseQuery)->where('type_acte', 'deces')->count();


        return [
            'totalDemandes' => $totalDemandes,
            'totalDemandesTraitees' => $totalDemandesTraitees,
            'tauxCompletionDemandes' => $tauxCompletionDemandes . '%',
            'totalCitoyens' => $totalCitoyens,
            'totalRevenu' => number_format($totalRevenu, 2, ',', ' ') . ' XOF', // Format monétaire
            'actesNaissanceCount' => $actesNaissanceCount,
            'actesMariageCount' => $actesMariageCount,
            'actesDecesCount' => $actesDecesCount,
        ];
    }

    /**
     * Récupère les données pour les graphiques.
     */
    private function getGraphData($startDate, $endDate, $acteType, $demandeStatus, $localiteId)
    {
        // --- Évolution des demandes par jour/semaine/mois ---
        $demandesEvolutionQuery = Demande::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($acteType !== 'all', function ($query) use ($acteType) {
                return $query->where('type_acte', $acteType);
            })
            ->when($demandeStatus !== 'all', function ($query) use ($demandeStatus) {
                return $query->where('statut', $demandeStatus);
            })
            ->when($localiteId !== 'all', function ($query) use ($localiteId) {
                return $query->where('localite_id', $localiteId);
            })
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labelsEvolution = $demandesEvolutionQuery->pluck('date')->toArray();
        $dataEvolution = $demandesEvolutionQuery->pluck('total')->toArray();

        // Remplir les jours manquants avec 0 si nécessaire (comme dans votre ancien code)
        $period = Carbon::parse($startDate)->daysUntil(Carbon::parse($endDate));
        $fullLabels = [];
        $fullData = [];
        $dataMap = $demandesEvolutionQuery->keyBy('date')->toArray();

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $fullLabels[] = $date->format('d/m'); // Format pour affichage
            $fullData[] = $dataMap[$formattedDate]['total'] ?? 0;
        }

        // --- Répartition des demandes par statut ---
        $demandesParStatutQuery = Demande::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($acteType !== 'all', function ($query) use ($acteType) {
                return $query->where('type_acte', $acteType);
            })
            ->when($localiteId !== 'all', function ($query) use ($localiteId) {
                return $query->where('localite_id', $localiteId);
            })
            ->select('statut', DB::raw('count(*) as count'))
            ->groupBy('statut')
            ->get();

        $labelsStatuts = $demandesParStatutQuery->pluck('statut')->toArray();
        $dataStatuts = $demandesParStatutQuery->pluck('count')->toArray();

        // --- Revenus mensuels (sur l'année de la date de fin) ---
        $revenuMensuelQuery = Payment::query()
            ->whereYear('created_at', $endDate->year) // Toujours sur l'année de la date de fin
            ->when($localiteId !== 'all', function ($query) use ($localiteId) {
                // Joindre Demande pour filtrer par localité
                return $query->whereIn('demande_id', Demande::where('localite_id', $localiteId)->pluck('id'));
            })
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(montant) as total')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $months = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr', 5 => 'Mai', 6 => 'Juin',
            7 => 'Juil', 8 => 'Août', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];
        $revenuLabels = array_values($months);
        $revenuData = array_fill(0, 12, 0); // Initialise tous les mois à 0

        foreach ($revenuMensuelQuery as $item) {
            $revenuData[$item->month - 1] = $item->total;
        }

        // --- Top 5 localités par demandes ---
        $topLocalitesQuery = Demande::join('localite', 'demandes.localite_id', '=', 'localite.id')
            ->whereBetween('demandes.created_at', [$startDate, $endDate])
            ->when($acteType !== 'all', function ($query) use ($acteType) {
                return $query->where('type_acte', $acteType);
            })
            ->when($demandeStatus !== 'all', function ($query) use ($demandeStatus) {
                return $query->where('statut', $demandeStatus);
            })
            ->select('localite.nom as localite_nom', DB::raw('count(demandes.id) as total_demandes'))
            ->groupBy('localite_nom')
            ->orderBy('total_demandes', 'desc')
            ->take(5)
            ->get();

        $labelsTopLocalites = $topLocalitesQuery->pluck('localite_nom')->toArray();
        $dataTopLocalites = $topLocalitesQuery->pluck('total_demandes')->toArray();


        return [
            'demandesEvolution' => ['labels' => $fullLabels, 'data' => $fullData],
            'demandesParStatut' => ['labels' => $labelsStatuts, 'data' => $dataStatuts],
            'revenuMensuel' => ['labels' => $revenuLabels, 'data' => $revenuData],
            'topLocalites' => ['labels' => $labelsTopLocalites, 'data' => $dataTopLocalites],
        ];
    }

    /**
     * Récupère les demandes détaillées pour le tableau.
     */
    private function getDetailedDemandes($startDate, $endDate, $acteType, $demandeStatus, $localiteId)
    {
        return Demande::with('user', 'localite') // Charger les relations pour l'affichage
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when($acteType !== 'all', function ($query) use ($acteType) {
                return $query->where('type_acte', $acteType);
            })
            ->when($demandeStatus !== 'all', function ($query) use ($demandeStatus) {
                return $query->where('statut', $demandeStatus);
            })
            ->when($localiteId !== 'all', function ($query) use ($localiteId) {
                return $query->where('localite_id', $localiteId);
            })
            ->latest() // Les plus récentes en premier
            ->take(20) // Limiter le nombre de résultats pour le tableau initial
            ->get();
    }

    /**
     * Options des filtres : Types d'actes.
     */
    private function getActeTypes()
    {
        return [
            'all' => 'Tous les types',
            'naissance' => 'Actes de Naissance',
            'mariage' => 'Actes de Mariage',
            'deces' => 'Actes de Décès',
        ];
    }

    /**
     * Options des filtres : Statuts de demande.
     */
    private function getDemandeStatuses()
    {
        // Assurez-vous que ces valeurs correspondent exactement à celles de votre DB
        return [
            'all' => 'Tous les statuts',
            'traitee' => 'Traitée',
            'en_attente' => 'En attente',
            'rejetee' => 'Rejetée',
        ];
    }

    /**
     * Options des filtres : Localités.
     */
    private function getLocalitesForFilter()
    {
        // Récupérer toutes les localités pour le filtre
        $localites = Localite::select('id', 'nom')
            ->orderBy('nom', 'asc')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['id'] => $item['nom']];
            })->toArray();

        return ['all' => 'Toutes les localités'] + $localites;
    }
}