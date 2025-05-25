@extends('layouts.appactenaissance')

@section('content')
    {{-- @extends('layouts.sidebar')

    @section('sidebar') --}}

    <section class="pt-sm-7">
	<div class="container pt-3 pt-xl-5">
		<div class="row">
			<!-- Sidebar -->
			<div class="col-lg-4 col-xl-3">
				<!-- Responsive offcanvas body START -->
				<div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
					<!-- Offcanvas header -->
					<div class="offcanvas-header bg-light">
						<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Mon profil</h5>
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
                                    {{-- <a href="#" class="btn btn-sm btn-round btn-dark position-absolute top-50 start-100 translate-middle mt-4 ms-n3" data-bs-toggle="tooltip" data-bs-title="Modifier le profil">
                                        <i class="bi bi-pencil-square"></i>
                                    </a> --}}
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
                <h1 class="h3 mb-0">Créer un nouveau compte</h1>
                <a href="{{ route('account') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" 
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" 
                        aria-controls="offcanvasSidebar">
                    <i class="fas fa-sliders-h"></i> Menu
                </button>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row mb-4">
                                    <h5 class="border-bottom pb-2">Informations de base</h5>
                                    <div class="col-md-6">
                                        <!-- Nom -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom complet</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <!-- Mot de passe -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mot de passe</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="password" name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Confirmation mot de passe -->
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                            <input type="password" class="form-control" 
                                                   id="password_confirmation" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <h5 class="border-bottom pb-2">Informations supplémentaires</h5>
                                    <div class="col-md-6">
                                        <!-- Rôle -->
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Rôle</label>
                                            <select class="form-select @error('role') is-invalid @enderror" 
                                                    id="role" name="role" required>
                                                <option value="">Sélectionner un rôle</option>
                                                <option value="citoyen" {{ old('role') == 'citoyen' ? 'selected' : '' }}>Citoyen</option>
                                                <option value="officier" {{ old('role') == 'officier' ? 'selected' : '' }}>Officier</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3" id="signature-field" style="display: none;">
                                            <label for="signature" class="form-label">Signature</label>
                                            <input type="file" class="form-control" id="signature" name="signature" accept="image/png, image/jpeg, image/svg+xml">
                                            <small class="text-muted">Formats acceptés: PNG, JPG, SVG (max 2MB)</small>
                                        </div>

                                        <!-- Date de naissance -->
                                        <div class="mb-3">
                                            <label for="date_naissance" class="form-label">Date de naissance</label>
                                            <input type="date" class="form-control" 
                                                   id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <!-- Genre -->
                                        <div class="mb-3">
                                            <label class="form-label">Genre</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="genre" id="genre_homme" 
                                                           value="homme" {{ old('genre') == 'homme' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genre_homme">Homme</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="genre" id="genre_femme" 
                                                           value="femme" {{ old('genre') == 'femme' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genre_femme">Femme</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="genre" id="genre_autre" 
                                                           value="autre" {{ old('genre') == 'autre' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="genre_autre">Autre</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contact -->
                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input type="text" class="form-control" 
                                                   id="contact" name="contact" value="{{ old('contact') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Créer le compte
                                        </button>
                                    </div>
                                </div>
                            </form>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const signatureField = document.getElementById('signature-field');
    
    // Fonction pour afficher/masquer le champ signature
    function toggleSignatureField() {
        if (roleSelect && signatureField) {
            const selectedRole = roleSelect.value;
            signatureField.style.display = (selectedRole === 'admin' || selectedRole === 'officier') ? 'block' : 'none';
        }
    }
    
    // Écouteur d'événement pour le changement de rôle
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleSignatureField);
        // Initialiser l'état au chargement
        toggleSignatureField();
    }
});
</script>