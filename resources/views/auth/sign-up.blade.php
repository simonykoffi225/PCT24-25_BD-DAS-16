
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mizzle.webestica.com/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:54 GMT -->
<head>

	<title>Etat civil - en côte d'ivoire</title>

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
<!-- **************** MAIN CONTENT START **************** -->
<main style="background-color:''; height: 100vh; overflow: hidden;">
  <div class="d-flex justify-content-center align-items-center h-100">
    <div class="row g-0 w-100 h-100" style="max-width: 100vw;">

      <!-- Image à gauche (masquée sur mobile) -->
      <div class="col-md-6 d-none d-md-block border-end h-100">
        <img src="assets/images/about/accueil.png"
             alt="Illustration"
             class="w-100 h-100"
             style="object-fit: cover;">
      </div>

      <!-- Formulaire à droite -->
      <div class="col-md-6 col-12 d-flex justify-content-center align-items-center h-100">
        <div style="width: 100%; max-width: 460px; padding: 1rem 1rem;">

          <!-- Logo -->
          <div class="text-center mb-2">
            <a href="{{ route('home') }}">
              <img src="assets/images/image.png" style="height: 40px;" alt="logo">
            </a>
          </div>

          <h2 class="text-center mb-1">Créer un compte</h2>
          <p class="text-center mb-3">Veuillez remplir les informations ci-dessous</p>

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

          @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0 small">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <!-- Formulaire compact -->
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-floating mb-2">
              <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
              <label for="name">Nom</label>
            </div>

            <div class="form-floating mb-2">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              <label for="email">Adresse email</label>
            </div>

            <div class="form-floating mb-2">
              <input type="date" class="form-control" id="date_naissance" name="date_naissance">
              <label for="date_naissance">Date de naissance</label>
            </div>

            <div class="mb-2">
              <label class="form-label">Genre</label>
              <div class="d-flex gap-3 flex-wrap">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="genre" id="genre_homme" value="homme">
                  <label class="form-check-label" for="genre_homme">Homme</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="genre" id="genre_femme" value="femme">
                  <label class="form-check-label" for="genre_femme">Femme</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="genre" id="genre_autre" value="autre">
                  <label class="form-check-label" for="genre_autre">Autre</label>
                </div>
              </div>
            </div>

            <div class="form-floating mb-2">
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact">
              <label for="contact">Contact</label>
            </div>

            <div class="form-floating mb-2 position-relative">
              <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
              <label for="password">Mot de passe</label>
              <span class="position-absolute top-50 end-0 translate-middle-y me-2">
                <i class="fas fa-eye-slash p-2 cursor-pointer"></i>
              </span>
            </div>

            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                     placeholder="Confirmer" required>
              <label for="password_confirmation">Confirmer le mot de passe</label>
            </div>

            <div class="d-grid mb-2">
              <button class="btn btn-dark" type="submit">Créer un compte</button>
            </div>

            <div class="text-center small">
              <span>Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a></span>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</main>




</head>

<body>

<!-- **************** MAIN CONTENT END **************** -->

<!-- Back to top -->
<div class="back-top"></div>

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!--Vendors-->
<script src="assets/vendor/pswmeter/pswmeter.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Theme Functions -->
<script src="assets/js/functions.js"></script>

</body>

<!-- Mirrored from mizzle.webestica.com/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Apr 2025 16:04:55 GMT -->
</html>