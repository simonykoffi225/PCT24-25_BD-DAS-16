@extends('layouts.app')
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
    <!-- Title and offcanvas button -->
    <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
        <!-- Title -->
        <h1 class="h3 mb-0">Liste des actes de mariage</h1>

        <!-- Advanced filter responsive toggler START -->
        <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="fas fa-sliders-h"></i> Menu
        </button>
        <!-- Advanced filter responsive toggler END -->
    </div>

    <!-- Search and buttons -->
    <div class="row g-3 align-items-center mb-5">
        <!-- Search -->
        <div class="col-xl-5">
            <form class="rounded position-relative" method="GET" action="{{ route('listeactemariage') }}">
                <input class="form-control pe-5" type="search" name="search" placeholder="Rechercher..." aria-label="Search" value="{{ request('search') }}">
                <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6"></i></button>
            </form>
        </div>

        <!-- Select option -->
        <div class="col-sm-6 col-xl-3 ms-auto">
            <!-- Short by filter -->
            <form method="GET" action="{{ route('listeactemariage') }}">
                <select class="form-select js-choice" name="sort" onchange="this.form.submit()" aria-label=".form-select-sm">
                    <option value="numero_acte" {{ request('sort') == 'numero_acte' ? 'selected' : '' }}>Par numéro</option>
                    <option value="date_mariage_desc" {{ request('sort') == 'date_mariage_desc' ? 'selected' : '' }}>Date récente</option>
                    <option value="date_mariage_asc" {{ request('sort') == 'date_mariage_asc' ? 'selected' : '' }}>Date ancienne</option>
                    <option value="statut" {{ request('sort') == 'statut' ? 'selected' : '' }}>Par statut</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive border-0">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <table class="table align-middle p-4 mb-0 table-hover">
            <!-- Table head -->
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="border-0 text-white rounded-start">N° Registre</th>
                    <th scope="col" class="border-0 text-white">Époux</th>
                    <th scope="col" class="border-0 text-white">Épouse</th>
                    <th scope="col" class="border-0 text-white">Date Mariage</th>
                    <th scope="col" class="border-0 text-white">Lieu Mariage</th>
                    <th scope="col" class="border-0 text-white">Statut</th>
                    <th scope="col" class="border-0 text-white rounded-end">Action</th>
                </tr>
            </thead>
        
            <tbody>
                @forelse($actesMariage as $acte)
                <tr>
                    <td>{{ $acte->numero_acte }}</td>
                    <td>{{ $acte->nom_epoux }} </td>
                    <td>{{ $acte->nom_epouse }} </td>
                    <td>{{ $acte->date_mariage ? \Carbon\Carbon::parse($acte->date_mariage)->format('d/m/Y') : '' }}</td>
                    <td>{{ $acte->lieu_mariage }}</td>
                    <td>
                        @if($acte->statut == 'succès')
                            <span class="badge bg-success">Validé</span>
                        @elseif($acte->statut == 'échec')
                            <span class="badge bg-danger">Rejeté</span>
                        @else
                            <span class="badge bg-warning">En attente</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('actemariage.show', $acte->id) }}" class="btn btn-sm btn-primary" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('actemariage.edit', $acte->id) }}" class="btn btn-sm btn-info" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @auth
										@if(auth()->user()->isAdmin())
                            <form action="{{ route('actemariage.destroy', $acte->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet acte?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn" 
                                        data-id="{{ $acte->id }}" 
                                        data-url="{{ route('actemariage.destroy', $acte->id) }}"
                                        title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                                        @endif
                            @endauth
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun acte de mariage trouvé</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{-- {{ $actesMariage->links() }} --}}
            {{ $actesMariage->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet acte de mariage ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de la suppression avec modal
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    const deleteForm = document.getElementById('deleteForm');
    
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const acteId = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            
            // Mise à jour du formulaire avec l'URL correcte
            deleteForm.action = url;
            
            // Affichage du modal
            deleteModal.show();
        });
    });
});
</script>
</div>
@stop

		</div>
	</div>
</section>