@extends('layouts.appactenaissance')

@section('content')
    {{-- @extends('layouts.sidebaractenaissance')

    @section('sidebaractenaissance') --}}

    
<section class="pt-sm-7">
	<div class="container pt-3 pt-xl-5">
		<div class="row">
			<!-- Sidebar -->
			<div class="col-lg-4 col-xl-3">
				<!-- Responsive offcanvas body START -->
				<div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
					<!-- Offcanvas header -->
					<div class="offcanvas-header bg-light">
						<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Mon  profil</h5>
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
					</div>
					<!-- Offcanvas body -->
					<div class="offcanvas-body p-0">
						<div class="card border p-3 w-100">
							<!-- Card header -->
							<div class="card-header text-center border-bottom">
                                <!-- Avatar -->
                                <div class="avatar avatar-xl position-relative mb-2">
                                    @if(Auth::user()->avatar)
                                        <img class="avatar-img rounded-circle border-2 border-white" src="{{ Auth::user()->avatar }}" alt="Avatar">
                                    @else
                                        <!-- Avatar avec initiales -->
                                        <div class="avatar-initials rounded-circle  border-2 border-white d-flex align-items-center justify-content-center text-white" 
                                            style="width: 80px; height: 80px; font-size: 24px; background-color: {{ '#' . substr(md5(Auth::user()->name), 0, 6) }};">
                                            {{ substr(Auth::user()->name, 0, 2) }}
                                        </div>
                                    @endif
                                </div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <a href="mailto:{{ Auth::user()->email }}" class="text-reset text-primary-hover small">{{ Auth::user()->email }}</a>
                            </div>

							<!-- Card body START -->
							<div class="card-body p-0 mt-4">
								<!-- Sidebar menu item START -->
								<ul class="nav nav-pills-primary-border-start flex-column">
									@auth
										@if(auth()->user()->isAdmin())
											<li class="nav-item">
												<a class="nav-link {{ request()->routeIs('account') ? 'active' : '' }}" href="{{ route('account')}}">
													<i class="bi bi-people fa-fw me-2"></i>Liste des comptes
												</a>
											</li>
										@endif
										@if(auth()->user()->isAdmin() || auth()->user()->isOfficier())
											<li class="nav-item">
												<a class="nav-link {{ request()->routeIs('listeactenaissance') ? 'active' : '' }}" href="{{ route('listeactenaissance')}}">
													<i class="bi bi-file-earmark-text fa-fw me-2"></i>Liste acte naissance
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link {{ request()->routeIs('listeactemariage') ? 'active' : '' }}" href="{{ route('listeactemariage')}}">
													<i class="bi bi-heart fa-fw me-2"></i>Liste acte mariage
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link {{ request()->routeIs('listeactedeces') ? 'active' : '' }}" href="{{ route('listeactedeces')}}">
													<i class="bi bi-emoji-frown fa-fw me-2"></i>Liste acte décès
												</a>
											</li>
										@endif
									@endauth
									@auth
									<li class="nav-item">
										<form action="{{ route('logout') }}" method="POST">
											@csrf
											<button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
												<i class="fas fa-sign-out-alt fa-fw me-2"></i>Déconnexion
											</button>
										</form>
									</li>
									@endauth
								</ul>
								<!-- Sidebar menu item END -->
							</div>
							<!-- Card body END -->
						</div>
					</div>
				</div>		
			</div>


        <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <h1 class="h3 mb-0">Détails de l'acte de décès</h1>
                <a href="@php
                    $user = auth()->user();
                    if($user->isAdmin()) {
                        echo route('listeactedeces'); // Ou toute autre route admin
                    } elseif($user->isOfficier()) {
                        echo route('listeactedeces'); // Route par défaut officier
                    } else {
                        echo route('mesnouvelledemande'); // Route citoyen
                    }
                @endphp" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <i class="fas fa-sliders-h"></i> Menu
                </button>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- Défunt + Administratif --}}
                            <div class="row mb-4">
                                <h5 class="border-bottom pb-2">Informations sur le défunt et les détails administratifs</h5>
                                <div class="col-md-6">
                                    <p><strong>Numéro d'acte:</strong> {{ $acteDeces->numero_acte }}</p>
                                    <p><strong>Nom:</strong> {{ $acteDeces->nom_defunt }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteDeces->prenom_defunt }}</p>
                                    <p><strong>Date de décès:</strong> {{ $acteDeces->date_deces ? \Carbon\Carbon::parse($acteDeces->date_deces)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu de décès:</strong> {{ $acteDeces->lieu_deces }}</p>
                                    <p><strong>Cause du décès:</strong> {{ $acteDeces->cause_deces ?? 'Non spécifiée' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date de naissance:</strong> {{ $acteDeces->date_naissance ? \Carbon\Carbon::parse($acteDeces->date_naissance)->format('d/m/Y') : 'Non renseignée' }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteDeces->lieu_naissance ?? 'Non renseigné' }}</p>
                                    <p><strong>Date d'enregistrement:</strong> {{ $acteDeces->date_acte ? \Carbon\Carbon::parse($acteDeces->date_acte)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Localité:</strong> {{ $acteDeces->localite->nom }}</p>
                                    <p><strong>Statut:</strong>
                                        @if($acteDeces->statut == 'succès')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif($acteDeces->statut == 'échec')
                                            <span class="badge bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </p>
                                    @if($acteDeces->updated_by_status)
                                        <div class="mb-3">
                                            <p><strong>Dernière modification du statut par</strong></p>
                                            <p class="form-control-static">{{ $acteDeces->validatedBy->name }}</p>
                                        </div>
                                    @endif

                                    @if($acteDeces->statut === 'échec' && $acteDeces->motif_rejet)
                                        <div class="mb-3">
                                            <label class="form-label">Motif de rejet</label>
                                            <p class="form-control-static">{{ $acteDeces->motif_rejet }}</p>
                                        </div>
                                    @endif
                                    <p><strong>Créé le:</strong> {{ $acteDeces->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Mis à jour le:</strong> {{ $acteDeces->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            @if($acteDeces->documents)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>Documents associés</h5>
                                        @foreach(json_decode($acteDeces->documents) as $document)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $document)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Document {{ $loop->iteration }}
                                                </a>
                                                @auth
                                                @if(auth()->user()->isAdmin())
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-doc-btn" 
                                                        data-bs-toggle="modal" data-bs-target="#deleteDocModal" 
                                                        data-doc-id="{{ $loop->index }}" 
                                                        data-form-action="{{ route('actedeces.deleteDocument', [$acteDeces->id, $loop->index]) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                                @endauth
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Déclarant --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur le déclarant</h5>
                                    <p><strong>Filiation:</strong> {{ ucfirst($acteDeces->filiation) }}</p>
                                    <p><strong>Nom:</strong> {{ $acteDeces->nom_declarant }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteDeces->prenom_declarant }}</p>
                                </div>

                                {{-- Parent --}}
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur le parent</h5>
                                    <p><strong>Type de parenté:</strong> {{ $acteDeces->type_parent ?? 'Non renseigné' }}</p>
                                    <p><strong>Nom:</strong> {{ $acteDeces->nom_parent ?? 'Non renseigné' }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteDeces->prenom_parent ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row mt-4">
                                @auth
										@if(auth()->user()->isAdmin() || auth()->user()->isOfficier())
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{ route('actedeces.edit', $acteDeces->id) }}" class="btn btn-primary me-2">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                   @endif
										@if(auth()->user()->isAdmin())
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteActeModal">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour supprimer un document -->
        <div class="modal fade" id="deleteDocModal" tabindex="-1" aria-labelledby="deleteDocModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteDocModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce document ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form id="deleteDocForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour supprimer l'acte de décès -->
        <div class="modal fade" id="deleteActeModal" tabindex="-1" aria-labelledby="deleteActeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteActeModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cet acte de décès ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form action="{{ route('actedeces.destroy', $acteDeces->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gestionnaire pour les boutons de suppression de document
                document.querySelectorAll('.delete-doc-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const formAction = this.getAttribute('data-form-action');
                        document.getElementById('deleteDocForm').setAttribute('action', formAction);
                    });
                });
            });
        </script>
    {{-- @endsection --}}
@endsection

		</div>
	</div>
</section>