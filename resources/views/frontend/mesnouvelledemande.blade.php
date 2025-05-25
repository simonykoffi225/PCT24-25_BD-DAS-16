@extends('layouts.app')
@section('content')
<div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="mt-8">

                <!-- Stats Cards -->
            
                </div>

                <!-- Projects & Recent Orders -->
                <div class="row">
                    <!-- Recent Orders -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Liste de mes demandes</h6>
                            </div>

                <div class="card-body">
                    <!-- Onglets -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="naissance-tab" data-bs-toggle="tab" data-bs-target="#naissance" type="button" role="tab">Naissances</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="mariage-tab" data-bs-toggle="tab" data-bs-target="#mariage" type="button" role="tab">Mariages</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="deces-tab" data-bs-toggle="tab" data-bs-target="#deces" type="button" role="tab">Décès</button>
                        </li>
                    </ul>

                    <!-- Contenu des onglets -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Onglet Naissances -->
                        <div class="tab-pane fade show active" id="naissance" role="tabpanel">
                            @if($actesNaissance->isEmpty())
                                <p class="mt-3">Aucune demande d'acte de naissance trouvée.</p>
                            @else
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Numéro</th>
                                                <th>Nom enfant</th>
                                                <th>Date naissance</th>
                                                <th>Date demande</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($actesNaissance as $acte)
                                                <tr>
                                                    <td>{{ $acte->numero_acte }}</td>
                                                    <td>{{ $acte->nom_enfant }} {{ $acte->prenom_enfant }}</td>
                                                    <td>{{ $acte->date_naissance->format('d/m/Y') }}</td>
                                                    <td>{{ $acte->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $acte->statut == 'succès' ? 'success' : ($acte->statut == 'échec' ? 'danger' : 'warning') }}">
                                                            {{ $acte->statut }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('actenaissance.show', $acte->id) }}" class="btn btn-sm btn-primary">Voir</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        <!-- Onglet Mariages -->
                        <div class="tab-pane fade" id="mariage" role="tabpanel">
                            @if($actesMariage->isEmpty())
                                <p class="mt-3">Aucune demande d'acte de mariage trouvée.</p>
                            @else
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Numéro</th>
                                                <th>Époux</th>
                                                <th>Épouse</th>
                                                <th>Date mariage</th>
                                                <th>Date demande</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($actesMariage as $acte)
                                                <tr>
                                                    <td>{{ $acte->numero_acte }}</td>
                                                    <td>{{ $acte->nom_epoux }} {{ $acte->prenom_epoux }}</td>
                                                    <td>{{ $acte->nom_epouse }} {{ $acte->prenom_epouse }}</td>
                                                    <td>{{ $acte->date_mariage ? \Carbon\Carbon::parse($acte->date_mariage)->format('d/m/Y') : 'N/A' }}</td>

                                                    <td>{{ $acte->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $acte->statut == 'succès' ? 'success' : ($acte->statut == 'échec' ? 'danger' : 'warning') }}">
                                                            {{ $acte->statut }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('actemariage.show', $acte->id) }}" class="btn btn-sm btn-primary">Voir</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        <!-- Onglet Décès -->
                        <div class="tab-pane fade" id="deces" role="tabpanel">
                            @if($actesDeces->isEmpty())
                                <p class="mt-3">Aucune demande d'acte de décès trouvée.</p>
                            @else
                                <div class="table-responsive mt-3">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Numéro</th>
                                                <th>Défunt</th>
                                                <th>Date décès</th>
                                                <th>Date demande</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($actesDeces as $acte)
                                                <tr>
                                                    <td>{{ $acte->numero_acte }}</td>
                                                    <td>{{ $acte->nom_defunt }} {{ $acte->prenom_defunt }}</td>
                                                    <td>{{ $acte->date_deces ? \Carbon\Carbon::parse($acte->date_deces)->format('d/m/Y') : 'N/A' }}</td>
                                                    <td>{{ $acte->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $acte->statut == 'succès' ? 'success' : ($acte->statut == 'échec' ? 'danger' : 'warning') }}">
                                                            {{ $acte->statut }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('actedeces.show', $acte->id) }}" class="btn btn-sm btn-primary">Voir</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection