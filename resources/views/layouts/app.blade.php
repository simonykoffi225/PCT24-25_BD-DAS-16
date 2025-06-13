<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>Etat civil - En côte d'ivoire</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Technology and Corporate Bootstrap Theme">

	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')
 
		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})

			}
		})
		
	</script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-DEXFC3C67M"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-DEXFC3C67M');
	</script>
<style>
    #loading-screen {
        background: #f8f9fa;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    
    .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.25em;
    }
    
    .loading-text {
        margin-top: 1rem;
        font-size: 1.2rem;
        color: #6c757d;
    }
</style>
</head>

<body>
	<div id="loading-screen" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 9999; display: flex; justify-content: center; align-items: center; flex-direction: column;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
        <p class="mt-3 text-muted">Chargement en cours...</p>
    </div>
<!-- Header START -->
<header class="header-sticky header-absolute">
	<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-xl">
		<div class="container">
			<!-- Logo START -->
			<a class="navbar-brand me-0" href="">
				<img class="light-mode-item navbar-brand-item" src="assets/images/image.png" alt="logo">
				<img class="dark-mode-item navbar-brand-item bg-white" src="assets/images/image.png" alt="logo">
			</a>
			<!-- Logo END -->

			<!-- Main navbar START -->
			<div class="navbar-collapse collapse" id="navbarCollapse">
				<ul class="navbar-nav navbar-nav-scroll dropdown-hover mx-auto">
					
                    <li class="nav-item"> <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a> </li>

					<!-- Nav item -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acte De Naissance</a>
						<div class="dropdown-menu d">
							<div class="row pt-2">
								<div class="col-sm-6">
									<ul class="list-unstyled">
										<li class="nav-item"> <a class="dropdown-item {{ request()->routeIs('createactenaissance') ? 'active' : '' }}" href="{{ route('createactenaissance') }}">Nouvelle demande d'acte de naissance</a> </li>
										<li class="nav-item">
											<a class="dropdown-item {{ request()->routeIs('demandes.acte-naissance.create') ? 'active' : '' }}" 
											   href="{{ route('demandes.acte-naissance.create') }}">
												Demande de copie d’acte de naissance
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>

					<!-- Nav item -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acte De Mariage</a>
						<div class="dropdown-menu d">
							<div class="row pt-2">
								<div class="col-sm-6">
									<ul class="list-unstyled">
										<li class="nav-item"> <a class="dropdown-item {{ request()->routeIs('createactemariage') ? 'active' : '' }}" href="{{ route('createactemariage') }}">Nouvelle déclaration d’un mariage </a> </li>
										<li class="nav-item">
											<a class="dropdown-item {{ request()->routeIs('demandes.acte-mariage.create') ? 'active' : '' }}" 
											   href="{{ route('demandes.acte-mariage.create') }}">
												Demande de copie d’acte de mariage
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>

					<!-- Nav item -->
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acte De Décès</a>
						<div class="dropdown-menu d">
							<div class="row pt-2">
								<div class="col-sm-6">
									<ul class="list-unstyled">
										<li class="nav-item"> <a class="dropdown-item {{ request()->routeIs('createactedeces') ? 'active' : '' }}" href="{{ route('createactedeces') }}">Nouvelle déclaration d’un décès </a> </li>
										<li class="nav-item">
											<a class="dropdown-item {{ request()->routeIs('demandes.acte-deces.create') ? 'active' : '' }}" 
											   href="{{ route('demandes.acte-deces.create') }}">
												 Demande de copie d’acte de décès
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>

					<!-- Nav item -->

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Info</a>
						<div class="dropdown-menu d">
							<div class="row pt-2">
								<!-- Image and button -->
								<div class="col-sm-6">
									<ul class="list-unstyled">
										<li> <a class="dropdown-item" href="{{ route('apropos') }}">A propos de nous</a> </li>
										<li> <a class="dropdown-item" href="{{ route('aproposactedenaissance') }}">Acte de naissance</a> </li>
										<li> <a class="dropdown-item" href="{{ route('aproposactedemariage') }}">Acte de Mariage</a> </li>
										<li> <a class="dropdown-item" href="{{ route('aproposactededeces') }}">Acte de Décès</a> </li>
										<li class="dropdown dropend">
											<a class="nav-link dropdown-link dropdown-item" data-bs-toggle="dropdown" href="#">Mes demandes</a>
											<ul class="dropdown-menu" data-bs-popper="none">
												<li> <a class="dropdown-item" href="{{route('mesnouvelledemande')}}">Historique nouvelle demande</a></li>
												<li> <a class="dropdown-item" href="{{ route('mesdemandes') }}">Historique Demande Copie</a></li>
											</ul>
										</li>
										@auth
											@if(auth()->user()->isAdmin() || auth()->user()->isOfficier())
												<li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
												<li>
													@if(auth()->user()->isAdmin())
														<a class="dropdown-item" href="{{ route('account') }}">Etat civil</a>
													@elseif(auth()->user()->isOfficier())
														<a class="dropdown-item" href="{{ route('listeactenaissance') }}">Etat civil</a>
													@endif
												</li>
											@endif
										@endauth	
									</ul>
								</div>
							</div>
						</div>
					</li>

					<!-- Nav item -->
					<li class="nav-item"> <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a> </li>
				</ul>
			</div>
			<!-- Main navbar END -->

			<!-- Buttons -->
			<ul class="nav align-items-center dropdown-hover ms-sm-2">
				<!-- Dark mode option START -->
				<li class="nav-item dropdown dropdown-animation">
					<button class="btn btn-link mb-0 px-2 lh-1" id="bd-theme"
					type="button"
					aria-expanded="false"
					data-bs-toggle="dropdown"
					data-bs-display="static">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  class="bi bi-circle-half theme-icon-active fill-mode fa-fw" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
						<use href="#"></use>
					</svg>
					</button>

					<ul class="dropdown-menu min-w-auto dropdown-menu-end" aria-labelledby="bd-theme">
						<li class="mb-1">
							<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
								<svg width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
									<use href="#"></use>
								</svg>Light
							</button>
						</li>
						<li class="mb-1">
							<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
									<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
									<use href="#"></use>
								</svg>Dark
							</button>
						</li>
						<li>
							<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
									<use href="#"></use>
								</svg>Auto
							</button>
						</li>
					</ul>
				</li>
				<!-- Dark mode option END -->

				<!-- Simuler un utilisateur connecté -->
                @auth
				<li class="nav-item dropdown me-2 d-none d-sm-block position-relative">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="bi bi-person-circle me-1"></i> 
						@php
							// Récupérer le premier prénom seulement
							$fullName = Auth::user()->name;
							$firstName = explode(' ', trim($fullName))[0];
							echo $firstName;
						@endphp
					</a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="{{route('profil')}}">Mon profil</a></li>
						<li>
							<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								Déconnexion
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
					</ul>
				</li>
				@endauth
				@guest
                <li class="nav-item me-2 d-none d-sm-block">
					<a href="{{ route('login') }}" class="btn btn-sm btn-light mb-0"><i class="bi bi-person-circle me-1"></i>Se connecter</a>
				</li>
                @endguest

				
				<!-- Responsive navbar toggler -->
				<li class="nav-item">
					<button class="navbar-toggler ms-sm-3 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-animation">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</button>
				</li>	
			</ul>

		</div>
	</nav>
	<!-- Logo Nav END -->
</header>
<!-- Header END -->

<!-- **************** MAIN CONTENT START **************** -->
<main>

<!-- =======================
Main Banner START -->

@yield('content')

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
Footer START -->

<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!--Vendors-->
<script src="assets/vendor/ityped/index.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Theme Functions -->
<script src="assets/js/functions.js"></script>
<script>
    // Masquer le loader quand la page est complètement chargée
    window.addEventListener('load', function() {
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.style.transition = 'opacity 0.5s ease';
        loadingScreen.style.opacity = '0';
        
        setTimeout(function() {
            loadingScreen.style.display = 'none';
        }, 500); // Correspond à la durée de la transition
    });

    // Optionnel: Masquer aussi si le chargement prend trop de temps
    setTimeout(function() {
        const loadingScreen = document.getElementById('loading-screen');
        if(loadingScreen.style.display !== 'none') {
            loadingScreen.style.transition = 'opacity 0.5s ease';
            loadingScreen.style.opacity = '0';
            setTimeout(function() {
                loadingScreen.style.display = 'none';
            }, 500);
        }
    }, 10000); // 10 secondes maximum
</script>


@extends('layouts.footer')


</body>
</html>
