
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mizzle.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:55 GMT -->
<head>

	<title>Etat civil en côte d'ivoire</title>

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
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/swiper/swiper-bundle.min.css">
	
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->
<main style="background-color: ''; height: 100vh;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <!-- Conteneur centré -->
        <div class="d-flex flex-row" style="width: 100vw; height: 100vh; background-color: white ;">

            <!-- Image à gauche avec bordure -->
            <div class="w-50 border border-primary">
                <img src="assets/images/about/02.jpg"
                     alt="Illustration"
                     class="w-100 h-100"
                     style="object-fit: cover;">
            </div>

            <!-- Formulaire à droite avec bordure -->
            <div class="w-50 d-flex justify-content-center align-items-center border border-primary border-start-0">
                <div style="width: 100%; max-width: 500px; padding: 3rem;">

                    <a href="{{ route('home') }}">
                        <img src="assets/images/image.png" class="mb-3" style="height: 40px;" alt="logo">
                    </a>

                    <h2 class="mb-1">Bienvenue</h2>
                    <p class="mb-3">Veuillez entrer vos identifiants pour vous connecter</p>

                    <!-- Alertes -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Formulaire -->
                    <form method="POST" action="{{ route('login.authenticate') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="nom@exemple.com" required>
                            <label for="email">Adresse email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Mot de passe" required>
                            <label for="password">Mot de passe</label>
                        </div>

                        <div class="mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Se souvenir de moi</label>
                            </div>
                            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Se connecter</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <span>Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>






<!-- **************** MAIN CONTENT END **************** -->

<!-- Back to top -->
<div class="back-top"></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!--Vendors-->
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Theme Functions -->
<script src="assets/js/functions.js"></script>

</body>

<!-- Mirrored from mizzle.webestica.com/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:55 GMT -->
</html>