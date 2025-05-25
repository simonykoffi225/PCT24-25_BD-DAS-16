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
        <h1 class="h3 mb-0">List of accounts</h1>

        <!-- Advanced filter responsive toggler START -->
        <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="fas fa-sliders-h"></i> Menu
        </button>
     <!-- Advanced filter responsive toggler END -->
    </div>

    <!-- Search and buttons -->
<div class="row g-3 align-items-center mb-5">
    <!-- Search -->
    <div class="col-xl-4">
        <form class="rounded position-relative" method="GET" action="{{ route('account') }}">
            <input class="form-control pe-5" type="search" name="search" placeholder="Search" 
                   aria-label="Search" value="{{ request('search') }}">
            <button class="btn border-0 px-3 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit">
                <i class="fas fa-search fs-6"></i>
            </button>
        </form>
    </div>

    <!-- Filtre par rôle -->
    <div class="col-sm-6 col-xl-4">
        <form method="GET" action="{{ route('account') }}">
            <select class="form-select js-choice" name="role" onchange="this.form.submit()">
                <option value="all" {{ request('role') == 'all' || !request('role') ? 'selected' : '' }}>Tous les rôles</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    
    <div class="col-xl-4">
        <form class="rounded position-relative" >
              <div class="">
        <a href="{{ route('frontend.create') }}" class="btn btn-primary mb-0"><i class="bi bi-plus-lg me-2"></i>Crée un compte</a>
    </div>
        </form>
    </div>

  
</div>

    <!-- Table -->
    <div class="table-responsive border-0">
        <table class="table align-middle p-4 mb-0 table-hover">
            <!-- Table head -->
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="border-0 text-white rounded-start">Id</th>
                    <th scope="col" class="border-0 text-white">Nom</th>
                    <th scope="col" class="border-0 text-white">Role</th>
                    <th scope="col" class="border-0 text-white">contact</th>
                    <th scope="col" class="border-0 text-white rounded-end">Action</th>
                </tr>
            </thead>
        
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->contact }}</td>
                    <td>
                       <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-dark me-1 mb-1 mb-md-0">
                            <i class="fas fa-eye"></i> voir
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary me-1 mb-1 mb-md-0">
                            <i class="bi bi-pencil"></i> Modifier
                         </a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $user->id }}">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      <div class="d-flex justify-content-center mt-4">
    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
    </div>


    <!-- Modal de succès -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Succès</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="successMessage">
                    <!-- Message de succès sera inséré ici -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'erreur -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Erreur</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorMessage">
                    <!-- Message d'erreur sera inséré ici -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
    // Gestion des messages de session
    @if(session('success'))
        document.getElementById('successMessage').innerHTML = "{{ session('success') }}";
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    @endif

    @if(session('error'))
        document.getElementById('errorMessage').innerHTML = "{{ session('error') }}";
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    @endif

    // Gestion de la suppression
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            document.getElementById('deleteForm').action = `/users/${userId}`;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show();
        });
    });

});
</script>
@stop
		</div>
	</div>
</section>