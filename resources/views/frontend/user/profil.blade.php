@extends('layouts.appactenaissance')
@section('content')

{{-- @extends('layouts.sidebarprofil')
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
                                </div>
                                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                <a href="mailto:{{ Auth::user()->email }}" class="text-reset text-primary-hover small">{{ Auth::user()->email }}</a>
                            </div>

							<!-- Card body START -->
							<div class="card-body p-0 mt-4">
								<!-- Sidebar menu item START -->
								<ul class="nav nav-pills-primary-border-start flex-column">
									<li class="nav-item">
										<a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil')}}">
											<i class="bi bi-briefcase fa-fw me-2"></i>Mon profil
										</a>
									</li>
									@auth
									<li class="nav-item">
										<form action="{{ route('logout') }}" method="POST">
											@csrf
											<button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
												<i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out
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
            <h1 class="h3 mb-0">Mon profil</h1>

            <!-- Advanced filter responsive toggler START -->
            <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fas fa-sliders-h"></i> Menu
            </button>
            <!-- Advanced filter responsive toggler END -->
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- Personal Information -->
        <form action="{{ route('profil.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card bg-transparent p-0">
                <!-- Card header -->
                <div class="card-header bg-transparent border-bottom p-0 pb-3">
                    <h6 class="mb-0">Informations personnelles</h6>
                </div>

                <!-- Card body -->
                <div class="card-body px-0">
                    <div class="row g-4">
                        <!-- Full name -->
                        <div class="col-12">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" placeholder="Votre nom">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder="Votre email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mobile -->
                        <div class="col-md-6">
                            <label class="form-label">Contact</label>
                            <input type="text" class="form-control" name="contact" value="{{ $user->contact }}" placeholder="Votre numéro de contact">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date Naissance</label>
                            <input type="date" class="form-control" name="date_naissance" 
                                value="{{ old('date_naissance', $user->date_naissance ? $user->date_naissance->format('Y-m-d') : '') }}">
                        </div>

                        <!-- Nationality -->
                        <div class="col-md-6">
                            <label class="form-label">Rôle</label>
                            @if(auth()->user()->isAdmin())
                                <select class="form-control" name="role">
                                    @foreach(App\Models\User::$roles as $key => $value)
                                        <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" class="form-control" value="{{ $user->getRoleName() }}" readonly>
                            @endif
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <label class="form-label">Genre</label>
                            <div class="input-group">
                                <div class="form-control">
                                    <div class="form-check radio-bg-light">
                                        <input class="form-check-input" type="radio" name="genre" id="flexRadioDefault1" value="homme" {{ $user->genre == 'homme' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Homme
                                        </label>
                                    </div>
                                </div>

                                <div class="form-control">
                                    <div class="form-check radio-bg-light">
                                        <input class="form-check-input" type="radio" name="genre" id="flexRadioDefault2" value="femme" {{ $user->genre == 'femme' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Femme
                                        </label>
                                    </div>
                                </div>	

                                <div class="form-control">
                                    <div class="form-check radio-bg-light">
                                        <input class="form-check-input" type="radio" name="genre" id="flexRadioDefault3" value="autre" {{ $user->genre == 'autre' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Autre
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-12 mt-4">
                            <div class="card bg-transparent p-0">
                                <div class="card-header bg-transparent border-bottom p-0 pb-3">
                                    <h6 class="mb-0">Modifier le mot de passe</h6>
                                </div>
                                <div class="card-body px-0">
                                    <div class="row g-4">
                                        <!-- Current password -->
                                        <div class="col-md-4">
                                            <label class="form-label">Mot de passe actuel</label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Entrez votre mot de passe actuel">
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- New password -->
                                        <div class="col-md-4">
                                            <label class="form-label">Nouveau mot de passe</label>
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Entrez le nouveau mot de passe">
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Confirm password -->
                                        <div class="col-md-4">
                                            <label class="form-label">Confirmer le mot de passe</label>
                                            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" placeholder="Confirmez le nouveau mot de passe">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary mb-0">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
{{-- @stop --}}
@endsection
		</div>
	</div>
</section>