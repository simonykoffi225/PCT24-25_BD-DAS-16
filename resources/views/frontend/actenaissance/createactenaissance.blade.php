@extends('layouts.appactenaissance')
@section('content')
<!-- =======================
Main hero START -->
<section class="pt-8">
	<div class="container">
		<!-- Breadcrumb & title -->
       <div style="background-color:#d2b535;" class="rounded-4 text-center position-relative overflow-hidden py-3 dark-overlay">

  <!-- contenu inchangé -->
  <!-- Svg decoration -->
  <figure class="position-absolute top-0 start-0 ms-n8">
    <!-- SVG ... -->
  </figure>

  <figure class="position-absolute top-0 end-0 me-n8 mt-5">
    <!-- SVG ... -->
  </figure>

  <div class="d-flex justify-content-center position-relative z-index-9">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Acte de naissance</li>
      </ol>
    </nav>
  </div>

  <h1 class="h2 text-white">Nouvelle demande d’un acte de naissance.</h1>
</div>


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('createactenaissance.store') }}" id="acteNaissanceForm" enctype="multipart/form-data" class="form-bg">
                                @csrf

                                <!-- Informations sur le demandeur -->
                                <h4 class="mb-3 mt-4">Informations du demandeur</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="filiation" class="form-label">Filiation du demandeur <span style="color:red">*</span></label>
                                        <select class="form-select @error('filiation') is-invalid @enderror" 
                                                id="filiation" name="filiation" required>
                                            <option value="" disabled selected>Choisir...</option>
                                            <option value="moi" {{ old('filiation') == 'moi' ? 'selected' : '' }}>Moi-même</option>
                                            <option value="père" {{ old('filiation') == 'père' ? 'selected' : '' }}>Père</option>
                                            <option value="mère" {{ old('filiation') == 'mère' ? 'selected' : '' }}>Mère</option>
                                            <option value="frère" {{ old('filiation') == 'frère' ? 'selected' : '' }}>Frère</option>
                                            <option value="soeur" {{ old('filiation') == 'soeur' ? 'selected' : '' }}>Soeur</option>
                                            <option value="autre" {{ old('filiation') == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('filiation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nom_demandeur" class="form-label">Nom du demandeur <span style="color:red">*</span></label>
                                        <input type="text" class="form-control @error('nom_demandeur') is-invalid @enderror" 
                                            id="nom_demandeur" name="nom_demandeur" value="{{ old('nom_demandeur') }}" required>
                                        @error('nom_demandeur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_demandeur" class="form-label">Prénom du demandeur <span style="color:red">*</span></label>
                                        <input type="text" class="form-control @error('prenom_demandeur') is-invalid @enderror" 
                                            id="prenom_demandeur" name="prenom_demandeur" value="{{ old('prenom_demandeur') }}" required>
                                        @error('prenom_demandeur')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                    
                                <!-- Informations de l'enfant -->
                                <h4 class="mb-3 mt-4">Informations de l'enfant</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nom_enfant" class="form-label">Nom de l'enfant <span style="color:red">*</span></label>
                                        <input type="text" class="form-control @error('nom_enfant') is-invalid @enderror" 
                                            id="nom_enfant" name="nom_enfant" value="{{ old('nom_enfant') }}" required>
                                        @error('nom_enfant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_enfant" class="form-label">Prénom de l'enfant <span style="color:red">*</span></label>
                                        <input type="text" class="form-control @error('prenom_enfant') is-invalid @enderror" 
                                            id="prenom_enfant" name="prenom_enfant" value="{{ old('prenom_enfant') }}" required>
                                        @error('prenom_enfant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date_naissance" class="form-label">Date de naissance <span style="color:red">*</span></label>
                                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                            id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                                        @error('date_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Lieu de naissance et localité -->
                                <h4 class="mb-3 mt-4">Lieu de naissance</h4>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="lieu_naissance" class="form-label">Lieu de naissance (établissement) <span style="color:red">*</span></label>
                                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                            id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}" required>
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Heure de naissance-->
                                    <div class="col-md-6">
                                        <label for="heure_naissance" class="form-label">Heure de naissance <span style="color:red">*</span></label>
                                        <input type="time" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                            id="heure_naissance" name="heure_naissance" value="{{ old('heure_naissance') }}" required>
                                        @error('heure_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="date_acte" class="form-label">Date de l'acte <span style="color:red">*</span></label>
                                        <input type="date" 
                                            class="form-control @error('date_acte') is-invalid @enderror" 
                                            id="date_acte" 
                                            name="date_acte" 
                                            value="{{ old('date_acte', now()->format('Y-m-d')) }}" 
                                            required 
                                            readonly
                                            style="background-color: #f8f9fa; cursor: not-allowed;">
                                        @error('date_acte')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Type de localité et localité -->
                                <div class="row mb-6">
                                    <div class="col-md-6">
                                        <label for="type_localite" class="form-label">Type de localité <span style="color:red">*</span></label>
                                        <select class="form-select @error('type_localite') is-invalid @enderror" 
                                                id="type_localite" name="type_localite" required>
                                            <option value="" disabled selected>Choisir...</option>
                                            @foreach($typesLocalites as $type)
                                                <option value="{{ $type->id }}" {{ old('type_localite') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type_localite')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="localite_id" class="form-label">Localité <span style="color:red">*</span></label>
                                        <select class="form-select @error('localite_id') is-invalid @enderror" 
                                                id="localite_id" name="localite_id" required>
                                            <option value="" disabled selected>Choisir d'abord le type</option>
                                        </select>
                                        @error('localite_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Informations sur les parents -->
                                <h4 class="mb-3 mt-4">Informations sur les parents</h4>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5>Informations du père</h5>
                                        <div class="mb-3">
                                            <label for="nom_pere" class="form-label">Nom <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('nom_pere') is-invalid @enderror" 
                                                id="nom_pere" name="nom_pere" value="{{ old('nom_pere') }}">
                                            @error('nom_pere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom_pere" class="form-label">Prénom <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('prenom_pere') is-invalid @enderror" 
                                                id="prenom_pere" name="prenom_pere" value="{{ old('prenom_pere') }}">
                                            @error('prenom_pere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="domicile_pere" class="form-label">Domicile <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('domicile_pere') is-invalid @enderror" 
                                                id="domicile_pere" name="domicile_pere" value="{{ old('domicile_pere') }}">
                                            @error('domicile_pere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="profession_pere" class="form-label">Profession <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('profession_pere') is-invalid @enderror" 
                                                id="profession_pere" name="profession_pere" value="{{ old('profession_pere') }}">
                                            @error('profession_pere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="numero_cni_pere" class="form-label">Numéro CNI du père <span style="color:red">*</span> </label>
                                            <input type="text" class="form-control @error('numero_cni_pere') is-invalid @enderror" 
                                                id="numero_cni_pere" name="numero_cni_pere" value="{{ old('numero_cni_pere') }}">
                                            @error('numero_cni_pere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <h5>Informations de la mère *</h5>
                                        <div class="mb-3">
                                            <label for="nom_mere" class="form-label">Nom <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('nom_mere') is-invalid @enderror" 
                                                id="nom_mere" name="nom_mere" value="{{ old('nom_mere') }}" required>
                                            @error('nom_mere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom_mere" class="form-label">Prénom <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('prenom_mere') is-invalid @enderror" 
                                                id="prenom_mere" name="prenom_mere" value="{{ old('prenom_mere') }}" required>
                                            @error('prenom_mere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="domicile_mere" class="form-label">Domicile <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('domicile_mere') is-invalid @enderror" 
                                                id="domicile_mere" name="domicile_mere" value="{{ old('domicile_mere') }}">
                                            @error('domicile_mere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="profession_mere" class="form-label">Profession <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('profession_mere') is-invalid @enderror" 
                                                id="profession_mere" name="profession_mere" value="{{ old('profession_mere') }}">
                                            @error('profession_mere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="numero_cni_mere" class="form-label">Numéro CNI de la mère <span style="color:red">*</span></label>
                                            <input type="text" class="form-control @error('numero_cni_mere') is-invalid @enderror" 
                                                id="numero_cni_mere" name="numero_cni_mere" value="{{ old('numero_cni_mere') }}">
                                            @error('numero_cni_mere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Documents -->
                                <h4 class="mb-3 mt-4">Documents justificatifs</h4>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="documents" class="form-label">Documents <span style="color:red">*</span></label>
                                        <input type="file" class="form-control @error('documents') is-invalid @enderror" 
                                            id="documents" name="documents[]" multiple required>
                                        @error('documents')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small class="text-muted">Vous pouvez uploader plusieurs fichiers (PDF, JPG, PNG - max 2MB chacun)</small>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="button" class="btn btn-primary" id="previewButton">
                                            Enregistrer l'acte de naissance
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de confirmation -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation des informations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="confirmationContent">
                        <!-- Les informations seront injectées ici par JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Modifier</button>
                        <button type="button" class="btn btn-primary" id="confirmSubmit">Confirmer et envoyer</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chargement dynamique des localités
            const typeLocaliteSelect = document.getElementById('type_localite');
            const localiteSelect = document.getElementById('localite_id');

            typeLocaliteSelect.addEventListener('change', function() {
                const typeId = this.value;
                
                if (!typeId) {
                    localiteSelect.innerHTML = '<option value="" disabled selected>Choisir d\'abord le type</option>';
                    return;
                }

                fetch(`/api/localites/${typeId}`)
                    .then(response => response.json())
                    .then(data => {
                        localiteSelect.innerHTML = '';
                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        defaultOption.textContent = 'Choisir...';
                        localiteSelect.appendChild(defaultOption);

                        data.forEach(localite => {
                            const option = document.createElement('option');
                            option.value = localite.id;
                            option.textContent = localite.nom;
                            localiteSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        localiteSelect.innerHTML = '<option value="" disabled selected>Erreur de chargement</option>';
                    });
            });

            // Pré-sélection si retour avec erreurs
            @if(old('type_localite'))
                const event = new Event('change');
                typeLocaliteSelect.value = "{{ old('type_localite') }}";
                typeLocaliteSelect.dispatchEvent(event);
                
                // On doit attendre que les localités soient chargées pour pré-sélectionner
                setTimeout(() => {
                    if (localiteSelect.querySelector(`option[value="{{ old('localite_id') }}"]`)) {
                        localiteSelect.value = "{{ old('localite_id') }}";
                    }
                }, 500);
            @endif

            // Gestion de la prévisualisation et confirmation
            const previewButton = document.getElementById('previewButton');
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            const confirmationContent = document.getElementById('confirmationContent');
            const form = document.getElementById('acteNaissanceForm');
            const confirmSubmit = document.getElementById('confirmSubmit');

            previewButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Valider le formulaire d'abord
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                // Récupérer toutes les valeurs du formulaire
                const formData = new FormData(form);
                const formValues = Object.fromEntries(formData.entries());
                
                // Générer le contenu HTML pour la confirmation
                let htmlContent = `
                    <h6>Informations sur le demandeur</h6>
                    <p><strong>Filiation:</strong> ${formValues.filiation}</p>
                    <p><strong>Nom:</strong> ${formValues.nom_demandeur}</p>
                    <p><strong>Prénom:</strong> ${formValues.prenom_demandeur}</p>
                    
                    <h6 class="mt-3">Informations sur l'enfant</h6>
                    <p><strong>Nom:</strong> ${formValues.nom_enfant}</p>
                    <p><strong>Prénom:</strong> ${formValues.prenom_enfant}</p>
                    <p><strong>Date de naissance:</strong> ${formValues.date_naissance}</p>
                    <p><strong>Heure de naissance:</strong> ${formValues.heure_naissance}</p>
                    
                    <h6 class="mt-3">Lieu de naissance</h6>
                    <p><strong>Établissement:</strong> ${formValues.lieu_naissance}</p>
                    <p><strong>Date de l'acte:</strong> ${formValues.date_acte}</p>
                    
                    <h6 class="mt-3">Localité</h6>
                    <p><strong>Type:</strong> ${typeLocaliteSelect.options[typeLocaliteSelect.selectedIndex].text}</p>
                    <p><strong>Localité:</strong> ${localiteSelect.options[localiteSelect.selectedIndex].text}</p>
                    
                    <h6 class="mt-3">Informations sur les parents</h6>
                    <p><strong>Nom du père:</strong> ${formValues.nom_pere || 'Non renseigné'}</p>
                    <p><strong>Prénom du père:</strong> ${formValues.prenom_pere || 'Non renseigné'}</p>
                    <p><strong>Nom de la mère:</strong> ${formValues.nom_mere}</p>
                    <p><strong>Prénom de la mère:</strong> ${formValues.prenom_mere}</p>
                `;

                // Afficher les fichiers sélectionnés
                const filesInput = document.getElementById('documents');
                if (filesInput.files.length > 0) {
                    htmlContent += `<h6 class="mt-3">Documents joints</h6><ul>`;
                    for (let i = 0; i < filesInput.files.length; i++) {
                        htmlContent += `<li>${filesInput.files[i].name}</li>`;
                    }
                    htmlContent += `</ul>`;
                }

                confirmationContent.innerHTML = htmlContent;
                confirmationModal.show();
            });

            // Gestion de la soumission finale
            confirmSubmit.addEventListener('click', function() {
                form.submit();
            });
        });
        </script>

	</div>	
</section>
<!-- =======================
Main hero END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->


<style>
.form-bg {
  position: relative;
  background-image: url('src="assets/images/image1.png" alt=""'); 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 2rem 3rem;
  border-radius: 15px;
  border: 2px solid rgb(210, 181, 53);
  color: #fff; /* texte clair */
  box-shadow: 0 8px 20px rgba(0,0,0,0.3); /* ombre*/
  z-index: 0;
  overflow: hidden ;
  

}

.bg-dark h1 {
  margin-bottom: 0.5rem; /* réduire l'espace sous le titre */
}

.breadcrumb {
  margin-bottom: 0.5rem;
}

.custom-box {
  background-color: #009345;
  border-radius: 25px;
  border: 3px solid #f3a800;
}

.custom-bg-warning {
  background-color: #f3a800;
  color: #212529; /* texte foncé par exemple */
}





</style>

@stop