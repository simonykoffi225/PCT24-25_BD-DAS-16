@extends('layouts.app') {{-- Assurez-vous que 'layouts.app' existe et contient les assets CSS/JS de Bootstrap et FontAwesome --}}

@section('title', 'Tableau de Bord | Système de Gestion de l\'État Civil')

@section('styles')
<style>
    /* Styles existants */
    .stats-card {
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .stats-card .icon {
        font-size: 40px;
        margin-bottom: 15px;
    }

    .stats-card .number {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stats-card .label {
        font-size: 16px;
        color: #777;
    }

    /* Couleurs des cartes KPI - ajustez si nécessaire */
    .card-total-demandes { background-color: #e6f2ff; border-left: 4px solid #007bff; } /* Bleu */
    .card-demandes-traitees { background-color: #ebfaeb; border-left: 4px solid #28a745; } /* Vert */
    .card-taux-completion { background-color: #fff2e6; border-left: 4px solid #fd7e14; } /* Orange */
    .card-total-citoyens { background-color: #f7e6ff; border-left: 4px solid #6f42c1; } /* Violet */
    .card-revenu { background-color: #fff8e6; border-left: 4px solid #ffc107; } /* Jaune */
    .card-acte-naissance { background-color: #e0f7fa; border-left: 4px solid #00bcd4; } /* Cyan */
    .card-acte-mariage { background-color: #ffe0b2; border-left: 4px solid #ff9800; } /* Ambre */
    .card-acte-deces { background-color: #ffcdd2; border-left: 4px solid #f44336; } /* Rouge clair */


    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Mise à jour des classes de badge pour correspondre aux statuts de la DB */
    .badge-traitee { background-color: #28a745; color: white; }
    .badge-en_attente { background-color: #ffc107; color: #343a40; }
    .badge-rejetee { background-color: #dc3545; color: white; }

    .chart-container {
        height: 300px;
        margin-bottom: 20px;
    }
    .filters-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }
    .filter-group {
        margin-bottom: 15px;
    }
    .btn-apply-filters {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-apply-filters:hover {
        background-color: #0056b3;
    }
</style>
@endsection

@section('content')
<section class="pt-8">
    <div class="container-fluid px-4">

        <div class="bg-dark rounded-4 text-center position-relative overflow-hidden py-5">
            {{-- Les SVG de fond peuvent être retirés ou conservés si vous les aimez --}}
            <figure class="position-absolute top-0 start-0 ms-n8">
                <svg width="424" height="405" viewBox="0 0 424 405" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="157.5" cy="147.5" r="236.5" fill="#4d5366"/>
                    <circle cx="266.5" cy="257.5" r="236.5" fill="#3c4152"/>
                </svg>
            </figure>

            <figure class="position-absolute top-0 end-0 me-n8 mt-5">
                <svg class="opacity-3" width="371" height="354" viewBox="0 0 371 354" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="185.5" cy="176.5" r="211.5" fill="#4d5366"/>
                    <circle cx="185.5" cy="176.5" r="169.5" fill="#3c4152"/>
                </svg>
            </figure>

            <div class="d-flex justify-content-center position-relative z-index-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <h1 class="h2 text-white">Tableau de Bord État Civil</h1>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Vue d'ensemble du système</li>
        </ol>

        <div class="filters-section">
            <form id="dashboard-filters" action="{{ route('dashboard') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 filter-group">
                        <label for="start_date" class="form-label">Date de début :</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3 filter-group">
                        <label for="end_date" class="form-label">Date de fin :</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-3 filter-group">
                        <label for="acte_type" class="form-label">Type d'acte :</label>
                        <select class="form-select" id="acte_type" name="acte_type">
                            @foreach($filterOptions['acteTypes'] as $key => $value)
                                <option value="{{ $key }}" {{ $acteType == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 filter-group">
                        <label for="demande_status" class="form-label">Statut de demande :</label>
                        <select class="form-select" id="demande_status" name="demande_status">
                            @foreach($filterOptions['demandeStatuses'] as $key => $value)
                                <option value="{{ $key }}" {{ $demandeStatus == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 filter-group">
                        <label for="localite_id" class="form-label">Localité :</label>
                        <select class="form-select" id="localite_id" name="localite_id">
                            @foreach($filterOptions['localites'] as $id => $name)
                                <option value="{{ $id }}" {{ $localiteId == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary btn-apply-filters">Appliquer les filtres</button>
                    </div>
                </div>
            </form>
        </div>

        <h2 class="mb-3">Statistiques Générales</h2>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-total-demandes">
                    <div class="icon"><i class="fas fa-file-alt"></i></div>
                    <div class="number">{{ $kpis['totalDemandes'] }}</div>
                    <div class="label">Total Demandes</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-demandes-traitees">
                    <div class="icon"><i class="fas fa-check-circle"></i></div>
                    <div class="number">{{ $kpis['totalDemandesTraitees'] }}</div>
                    <div class="label">Demandes Traitées</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-taux-completion">
                    <div class="icon"><i class="fas fa-percent"></i></div>
                    <div class="number">{{ $kpis['tauxCompletionDemandes'] }}</div>
                    <div class="label">Taux de Complétion</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-total-citoyens">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="number">{{ $kpis['totalCitoyens'] }}</div>
                    <div class="label">Total Citoyens</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-revenu">
                    <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="number">{{ $kpis['totalRevenu'] }}</div>
                    <div class="label">Revenu Total Filtré</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-acte-naissance">
                    <div class="icon"><i class="fas fa-baby"></i></div>
                    <div class="number">{{ $kpis['actesNaissanceCount'] }}</div>
                    <div class="label">Actes de Naissance Filtrés</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-acte-mariage">
                    <div class="icon"><i class="fas fa-heart"></i></div>
                    <div class="number">{{ $kpis['actesMariageCount'] }}</div>
                    <div class="label">Actes de Mariage Filtrés</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stats-card card-acte-deces">
                    <div class="icon"><i class="fas fa-cross"></i></div>
                    <div class="number">{{ $kpis['actesDecesCount'] }}</div>
                    <div class="label">Actes de Décès Filtrés</div>
                </div>
            </div>
        </div>

        <h2 class="mb-3">Visualisations Détaillées</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-1"></i>
                        Évolution des demandes
                    </div>
                    <div class="card-body">
                        <canvas id="demandesEvolutionChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Répartition des demandes par statut
                    </div>
                    <div class="card-body">
                        <canvas id="demandesStatutChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Revenus Mensuels
                    </div>
                    <div class="card-body">
                        <canvas id="revenuMensuelChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Top 5 des Localités par Demandes
                    </div>
                    <div class="card-body">
                        <canvas id="topLocalitesChart" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mb-3">Demandes Récentes (Filtrées)</h2>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Liste des Demandes
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type d'Acte</th>
                                <th>Demandeur</th>
                                <th>Localité</th>
                                <th>Statut</th>
                                <th>Date de Création</th>
                                {{-- Vous pouvez ajouter d'autres colonnes comme 'Dernière action', 'Motif de rejet', etc. --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demandesRecentes as $demande)
                                <tr>
                                    <td>{{ $demande->id }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $demande->type_acte)) }}</td>
                                    <td>{{ $demande->user->name ?? 'N/A' }}</td> {{-- Assurez-vous que la relation 'user' existe --}}
                                    <td>{{ $demande->localite->nom ?? 'N/A' }}</td> {{-- Assurez-vous que la relation 'localite' existe --}}
                                    <td><span class="badge badge-{{ $demande->statut }}">{{ ucfirst(str_replace('_', ' ', $demande->statut)) }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucune demande trouvée pour les filtres sélectionnés.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('scripts')
{{-- Assurez-vous que Chart.js est bien inclus dans votre layout.app ou ici --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Données passées par Laravel au format JSON
        const graphData = @json($graphData);

        // --- Graphique: Évolution des demandes ---
        const demandesEvolutionCtx = document.getElementById('demandesEvolutionChart').getContext('2d');
        new Chart(demandesEvolutionCtx, {
            type: 'line',
            data: {
                labels: graphData.demandesEvolution.labels,
                datasets: [{
                    label: 'Nombre de Demandes',
                    data: graphData.demandesEvolution.data,
                    borderColor: 'rgba(0, 123, 255, 1)', // Bleu
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: { display: true, text: 'Date' }
                    },
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Quantité' }
                    }
                }
            }
        });

        // --- Graphique: Répartition des demandes par statut ---
        const demandesStatutCtx = document.getElementById('demandesStatutChart').getContext('2d');
        new Chart(demandesStatutCtx, {
            type: 'pie',
            data: {
                labels: graphData.demandesParStatut.labels.map(label => {
                    // Pour afficher 'traitee' comme 'Traitée', etc.
                    return label.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                }),
                datasets: [{
                    data: graphData.demandesParStatut.data,
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',  // traitee (vert)
                        'rgba(255, 193, 7, 0.8)',  // en_attente (jaune)
                        'rgba(220, 53, 69, 0.8)'   // rejetee (rouge)
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: false }
                }
            }
        });

        // --- Graphique: Revenus Mensuels ---
        const revenuMensuelCtx = document.getElementById('revenuMensuelChart').getContext('2d');
        new Chart(revenuMensuelCtx, {
            type: 'bar',
            data: {
                labels: graphData.revenuMensuel.labels,
                datasets: [{
                    label: 'Revenu (XOF)',
                    data: graphData.revenuMensuel.data,
                    backgroundColor: 'rgba(255, 193, 7, 0.8)', // Jaune
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: { display: true, text: 'Mois' }
                    },
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Montant (XOF)' }
                    }
                }
            }
        });

        // --- Graphique: Top 5 des Localités par Demandes ---
        const topLocalitesCtx = document.getElementById('topLocalitesChart').getContext('2d');
        new Chart(topLocalitesCtx, {
            type: 'bar',
            data: {
                labels: graphData.topLocalites.labels,
                datasets: [{
                    label: 'Nombre de Demandes',
                    data: graphData.topLocalites.data,
                    backgroundColor: 'rgba(23, 162, 184, 0.8)', // Cyan/Teal
                    borderColor: 'rgba(23, 162, 184, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // Barres horizontales
                scales: {
                    x: {
                        beginAtZero: true,
                        title: { display: true, text: 'Nombre de Demandes' }
                    },
                    y: {
                        title: { display: true, text: 'Localité' }
                    }
                }
            }
        });

        // Note: Le rechargement des données se fait par soumission du formulaire GET
        // Pour une expérience AJAX, vous devrez modifier le code ci-dessus pour qu'il
        // mette à jour les graphiques existants avec de nouvelles données après une requête AJAX réussie.
        // Cela impliquerait de détruire et recréer les objets Chart, ou d'utiliser la méthode update().
    });
</script>
@endsection