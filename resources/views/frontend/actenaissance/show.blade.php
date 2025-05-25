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
                <h1 class="h3 mb-0">Détails de l'acte de naissance</h1>
                {{-- <a href="{{ route('listeactenaissance') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a> --}}
                <a href="@php
                    $user = auth()->user();
                    if($user->isAdmin()) {
                        echo route('listeactenaissance'); // Ou toute autre route admin
                    } elseif($user->isOfficier()) {
                        echo route('listeactenaissance'); // Route par défaut officier
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
                            {{-- Enfant + Administratif --}}
                            <div class="row mb-4">
                                <h5 class="border-bottom pb-2">Informations sur l'enfant et les détails administratifs</h5>
                                <div class="col-md-6">
                                    <p><strong>Numéro d'acte:</strong> {{ $acteNaissance->numero_acte }}</p>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_enfant }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_enfant }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $acteNaissance->date_naissance->format('d/m/Y') }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteNaissance->lieu_naissance }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date d'enregistrement:</strong> {{ $acteNaissance->date_acte->format('d/m/Y') }}</p>
                                    <p><strong>Localité:</strong> {{ $acteNaissance->localite->nom }}</p>
                                    <p><strong>Statut:</strong>
                                        @if($acteNaissance->statut == 'succès')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif($acteNaissance->statut == 'échec')
                                            <span class="badge bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </p>
                                    
                                    @if($acteNaissance->updated_by_status)
                                        <div class="mb-3">
                                            <p><strong>Dernière modification du statut par</strong></p>
                                            <p class="form-control-static">{{ $acteNaissance->validatedBy->name }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($acteNaissance->statut === 'échec' && $acteNaissance->motif_rejet)
                                        <p><strong>Motif de rejet:</strong> {{ $acteNaissance->motif_rejet }}</p>
                                    @endif
                                    
                                    <p><strong>Créé le:</strong> {{ $acteNaissance->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Mis à jour le:</strong> {{ $acteNaissance->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            @if($acteNaissance->documents)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5>Documents associés</h5>
                                        @foreach(json_decode($acteNaissance->documents) as $document)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $document)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-alt"></i> Document {{ $loop->iteration }}
                                                </a>
                                                @auth
                                                    @if(auth()->user()->isAdmin())
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-document-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteDocumentModal" 
                                                        data-document-id="{{ $acteNaissance->id }}" 
                                                        data-document-index="{{ $loop->index }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                    @endif
                                                    @endauth
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Père --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur le père</h5>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteNaissance->domicile_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Profession:</strong> {{ $acteNaissance->profession_pere ?? 'Non renseigné' }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteNaissance->numero_cni_pere ?? 'Non renseigné' }}</p>
                                </div>

                                {{-- Mère --}}
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur la mère</h5>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_mere }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_mere }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteNaissance->domicile_mere ?? 'Non renseigné' }}</p>
                                    <p><strong>Profession:</strong> {{ $acteNaissance->profession_mere ?? 'Non renseigné' }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteNaissance->numero_cni_mere ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            {{-- Demandeur --}}
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2">Informations sur le demandeur</h5>
                                    <p><strong>Filiation:</strong> {{ ucfirst($acteNaissance->filiation) }}</p>
                                    <p><strong>Nom:</strong> {{ $acteNaissance->nom_demandeur }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteNaissance->prenom_demandeur }}</p>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row mt-4">
                                @auth
                                @if(auth()->user()->isAdmin() || auth()->user()->isOfficier())
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{ route('actenaissance.edit', $acteNaissance->id) }}" class="btn btn-primary me-2">
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

        <!-- Modal de confirmation pour la suppression d'un document -->
        <div class="modal fade" id="deleteDocumentModal" tabindex="-1" aria-labelledby="deleteDocumentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteDocumentModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce document ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form id="deleteDocumentForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de confirmation pour la suppression de l'acte -->
        <div class="modal fade" id="deleteActeModal" tabindex="-1" aria-labelledby="deleteActeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteActeModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cet acte de naissance ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form action="{{ route('actenaissance.destroy', $acteNaissance->id) }}" method="POST">
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
                // Récupérer tous les boutons de suppression de document
                const deleteButtons = document.querySelectorAll('.delete-document-btn');
                
                // Pour chaque bouton, ajouter un écouteur d'événement
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const acteId = this.getAttribute('data-document-id');
                        const documentIndex = this.getAttribute('data-document-index');
                        
                        // Configurer le formulaire avec l'URL correcte
                        const form = document.getElementById('deleteDocumentForm');
                        form.action = `/actenaissance/${acteId}/document/${documentIndex}`;
                    });
                });
            });
        </script>
    {{-- @endsection --}}
@endsection

</div>
	</div>
</section>