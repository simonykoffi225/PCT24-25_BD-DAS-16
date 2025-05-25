@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <main class="mt-8">
            <!-- Recent Orders -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Liste de mes demandes</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Numéro de l'acte</th>
                                        <th>Date de demande</th>
                                        <th>Type de l'acte</th>
                                        <th>Nombre de copies</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($demandes as $demande)
                                    <tr>
                                        <td>{{ $demande->numero_acte ?? 'N/A' }}</td>
                                        <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ ucfirst($demande->type_acte) }}</td>
                                        <td>{{ $demande->nombre_copie }}</td>
                                        <td>
                                            @if($demande->statut === 'traitee')
                                                <span class="badge bg-success">Validé</span>
                                            @elseif($demande->statut === 'en attente')
                                                <span class="badge bg-warning">En attente</span>
                                            @elseif($demande->statut === 'annulée')
                                                <span class="badge bg-danger">Annulée</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($demande->statut) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Aucune demande disponible</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center">
                            {{ $demandes->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@stop