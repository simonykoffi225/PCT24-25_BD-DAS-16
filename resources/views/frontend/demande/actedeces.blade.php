{{-- actedeces.blade.php --}}
@extends('layouts.appactenaissance')

@section('content')
<!-- =======================
Main hero START -->
<section class="pt-8">
    <div class="container">
        <!-- Breadcrumb & title -->
        <div class="bg-dark rounded-4 text-center position-relative overflow-hidden py-5">
            <!-- Svg decoration -->
            <figure class="position-absolute top-0 start-0 ms-n8">
                <svg width="424" height="405" viewBox="0 0 424 405" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG content -->
                </svg>
            </figure>

            <!-- SVG decoration -->
            <figure class="position-absolute top-0 end-0 me-n8 mt-5">
                <svg class="opacity-3" width="371" height="354" viewBox="0 0 371 354" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- SVG content -->
                </svg>
            </figure>

            <!-- Breadcrumb -->
            <div class="d-flex justify-content-center position-relative z-index-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Demande d'Acte de Décès</li>
                    </ol>
                </nav>
            </div>
            <!-- Title -->
            <h1 class="h2 text-white">Acte de Décès</h1>
        </div>

        <!-- Formulaire d'Acte de Décès -->
        <div class="container mt-6">
            
            <h2 class="text-center mb-4">Formulaire de Demande d'Acte de Décès</h2>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('demandes.acte-deces.store') }}" method="POST" class="row g-3">
                @csrf

                <!-- Informations sur le défunt -->
                <div class="col-md-6">
                    <label for="nom_defunt" class="form-label">Nom du défunt <span style="color:red">*</span></label>
                    <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" 
                           id="nom_defunt" name="nom_defunt" 
                           value="{{ old('nom_defunt') }}" required>
                    @error('nom_defunt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="prenom_defunt" class="form-label">Prénom du défunt <span style="color:red">*</span></label>
                    <input type="text" class="form-control @error('prenom_defunt') is-invalid @enderror" 
                           id="prenom_defunt" name="prenom_defunt" 
                           value="{{ old('prenom_defunt') }}" required>
                    @error('prenom_defunt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="date_deces" class="form-label">Date de décès <span style="color:red">*</span></label>
                    <input type="date" class="form-control @error('date_deces') is-invalid @enderror" 
                           id="date_deces" name="date_deces" 
                           value="{{ old('date_deces') }}" required>
                    @error('date_deces')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="lieu_deces" class="form-label">Lieu de décès <span style="color:red">*</span></label>
                    <input type="text" class="form-control @error('lieu_deces') is-invalid @enderror" 
                           id="lieu_deces" name="lieu_deces" 
                           value="{{ old('lieu_deces') }}" required>
                    @error('lieu_deces')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Informations sur l'acte -->
                <div class="col-md-6">
                    <label for="numero_acte" class="form-label">Numéro d'acte <span style="color:red">*</span></label>
                    <input type="text" class="form-control @error('numero_acte') is-invalid @enderror" 
                           id="numero_acte" name="numero_acte" 
                           value="{{ old('numero_acte') }}" required>
                    @error('numero_acte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="date_acte" class="form-label">Date de l'acte <span style="color:red">*</span></label>
                    <input type="date" class="form-control @error('date_acte') is-invalid @enderror" 
                           id="date_acte" name="date_acte" 
                           value="{{ old('date_acte') }}" required>
                    @error('date_acte')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombre de copies -->
                <div class="col-md-6">
                    <label for="nombre_copie" class="form-label">Nombre de copies <span style="color:red">*</span></label>
                    <select class="form-select @error('nombre_copie') is-invalid @enderror" 
                            id="nombre_copie" name="nombre_copie" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('nombre_copie') == $i ? 'selected' : '' }}>
                                {{ $i }} copie{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                    @error('nombre_copie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Cause du décès -->
                <div class="col-md-6">
                    <label for="cause_deces" class="form-label">Cause du décès <span style="color:red">*</span></label>
                    <input type="text" class="form-control @error('cause_deces') is-invalid @enderror" 
                           id="cause_deces" name="cause_deces" 
                           value="{{ old('cause_deces') }}">
                    @error('cause_deces')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton envoyer -->
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-paper-plane me-2"></i> Envoyer la demande
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@if(session('pdf_generated'))
<div id="pdf-download" data-url="{{ session('pdf_url') }}"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pdfDiv = document.getElementById('pdf-download');
    if (pdfDiv) {
        const pdfUrl = pdfDiv.getAttribute('data-url');
        if (pdfUrl) {
            // Solution 1: Téléchargement forcé via un lien
            const link = document.createElement('a');
            link.href = pdfUrl;
            link.setAttribute('download', ''); // Force le téléchargement
            document.body.appendChild(link);
            link.click();
            
            // Nettoyer après quelques secondes pour permettre le téléchargement
            setTimeout(() => {
                document.body.removeChild(link);
                
                // Informer l'utilisateur
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show mt-3';
                alertDiv.innerHTML = `
                    <strong>Téléchargement lancé!</strong> Si votre téléchargement ne démarre pas automatiquement, 
                    <a href="${pdfUrl}" download class="alert-link">cliquez ici</a>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                // Insérer l'alerte au début du formulaire ou d'un conteneur approprié
                const container = document.querySelector('.container.mt-6');
                if (container) {
                    container.insertBefore(alertDiv, container.firstChild);
                }
            }, 1000);
        }
    }
});
</script>
@endif
<!-- =======================
Main hero END -->

<style>

form.row.g-3 {
  border: 1px solid #ddd;
  padding: 20px;
  border-radius: 12px;
    border-radius: 15px;
  border: 2px solid rgb(243, 158, 0);
  color: #fff; /* texte clair */
  box-shadow: 0 8px 20px rgba(0,0,0,0.3); /* ombre*/
  background-color: #fff;
}

form.row.g-3 .form-control,
form.row.g-3 .form-select {
  border-radius: 10px !important;
  box-shadow: none;
  border: 1.5px solid #ccc;
  transition: border-color 0.3s ease;
}

form.row.g-3 .form-control:focus,
form.row.g-3 .form-select:focus {
  border-color:rgb(11, 189, 49, 0.5);
  box-shadow: 0 0 8px rgba(11, 189, 49, 0.5);
}
</style>
@endsection