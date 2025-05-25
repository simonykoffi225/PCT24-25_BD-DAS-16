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
                <h1 class="h3 mb-0">Détails de l'acte de mariage</h1>
                <a href="@php
                    $user = auth()->user();
                    if($user->isAdmin()) {
                        echo route('listeactemariage'); // Ou toute autre route admin
                    } elseif($user->isOfficier()) {
                        echo route('listeactemariage'); // Route par défaut officier
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
                            {{-- Informations administratives --}}
                            <div class="row mb-4">
                                <h5 class="border-bottom pb-2">Informations administratives</h5>
                                <div class="col-md-6">
                                    <p><strong>Numéro d'acte:</strong> {{ $acteMariage->numero_acte }}</p>
                                    <p><strong>Date du mariage:</strong> {{ $acteMariage->date_mariage ? \Carbon\Carbon::parse($acteMariage->date_mariage)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu du mariage:</strong> {{ $acteMariage->lieu_mariage }}</p>
                                    <p><strong>Localité:</strong> {{ $acteMariage->localite->nom }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date d'enregistrement:</strong> {{ $acteMariage->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong>Statut:</strong>
                                        @if($acteMariage->statut == 'succès')
                                            <span class="badge bg-success">Validé</span>
                                        @elseif($acteMariage->statut == 'échec')
                                            <span class="badge bg-danger">Rejeté</span>
                                        @else
                                            <span class="badge bg-warning">En attente</span>
                                        @endif
                                    </p>
                                    @if($acteMariage->updated_by_status)
                                        <div class="mb-3">
                                            <p><strong>Dernière modification du statut par</strong></p>
                                            <p class="form-control-static">{{ $acteMariage->validatedBy->name }}</p>
                                        </div>
                                    @endif

                                    @if($acteMariage->statut === 'échec' && $acteMariage->motif_rejet)
                                        <div class="mb-3">
                                            <p> <strong> Motif de rejet </strong></p>
                                            <p class="form-control-static">{{ $acteMariage->motif_rejet }}</p>
                                        </div>
                                    @endif
                                    <p><strong>Mis à jour le:</strong> {{ $acteMariage->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            {{-- Informations sur les époux --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur l'époux</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_epoux }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_epoux }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $acteMariage->date_naissance_epoux ? \Carbon\Carbon::parse($acteMariage->date_naissance_epoux)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteMariage->lieu_naissance_epoux }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_epoux }}</p>
                                    <p><strong>Profession:</strong> {{ $acteMariage->profession_epoux }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteMariage->domicile_epoux }}</p>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Informations sur l'épouse</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_epouse }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_epouse }}</p>
                                    <p><strong>Date de naissance:</strong> {{ $acteMariage->date_naissance_epouse ? \Carbon\Carbon::parse($acteMariage->date_naissance_epouse)->format('d/m/Y') : '' }}</p>
                                    <p><strong>Lieu de naissance:</strong> {{ $acteMariage->lieu_naissance_epouse }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_epouse }}</p>
                                    <p><strong>Profession:</strong> {{ $acteMariage->profession_epouse }}</p>
                                    <p><strong>Domicile:</strong> {{ $acteMariage->domicile_epouse }}</p>
                                </div>
                            </div>

                            {{-- Témoins --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Témoin 1</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_temoin1 }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_temoin1 }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_temoin1 }}</p>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Témoin 2</h5>
                                    <p><strong>Nom:</strong> {{ $acteMariage->nom_temoin2 }}</p>
                                    <p><strong>Prénom:</strong> {{ $acteMariage->prenom_temoin2 }}</p>
                                    <p><strong>Numéro CNI:</strong> {{ $acteMariage->numero_cni_temoin2 }}</p>
                                </div>
                            </div>

                            {{-- Documents --}}
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2">Documents associés</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Documents de l'époux</h6>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->extrait_naissance_epoux)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Extrait de naissance
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->photo_epoux)) }}" 
                                                    target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-image"></i> Photo d'identité
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->certificat_residence_epoux)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Certificat de résidence
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Documents de l'épouse</h6>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->extrait_naissance_epouse)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Extrait de naissance
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->photo_epouse)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-image"></i> Photo d'identité
                                                </a>
                                            </p>
                                            <p>
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $acteMariage->certificat_residence_epouse)) }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-file-pdf"></i> Certificat de résidence
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="row mt-4">
                                @auth
                                @if(auth()->user()->isAdmin() || auth()->user()->isOfficier())
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{ route('actemariage.edit', $acteMariage->id) }}" class="btn btn-primary me-2">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    @endif
									@if(auth()->user()->isAdmin())
                                    <form action="{{ route('actemariage.destroy', $acteMariage->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet acte?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- @endsection --}}
@endsection

</div>
	</div>
</section>