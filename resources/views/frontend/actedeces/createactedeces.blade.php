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
					<ellipse cx="212" cy="202.5" rx="212" ry="202.5" fill="url(#paint0_linear_153_3831)"/>
					<defs>
					<linearGradient id="paint0_linear_153_3831" x1="212" y1="0" x2="212" y2="405" gradientUnits="userSpaceOnUse">
					<stop offset="0.0569271" stop-color="#D9D9D9" stop-opacity="0"/>
					<stop offset="0.998202" stop-color="#D9D9D9" stop-opacity="0.5"/>
					</linearGradient>
					</defs>
				</svg>
			</figure>

			<!-- SVG decoration -->
			<figure class="position-absolute top-0 end-0 me-n8 mt-5">
				<svg class="opacity-3" width="371" height="354" viewBox="0 0 371 354" fill="none" xmlns="http://www.w3.org/2000/svg">
					<ellipse cx="172.5" cy="176.5" rx="131.5" ry="125.5" fill="url(#paint0_linear_195_2)"/>
					<ellipse cx="185.5" cy="177" rx="185.5" ry="177" fill="url(#paint1_linear_195_2)"/>
					<defs>
					<linearGradient id="paint0_linear_195_2" x1="172.5" y1="51" x2="172.5" y2="302" gradientUnits="userSpaceOnUse">
					<stop offset="0.0569271" stop-color="#D9D9D9" stop-opacity="0.5"/>
					<stop offset="0.998202" stop-color="#D9D9D9" stop-opacity="0"/>
					</linearGradient>
					<linearGradient id="paint1_linear_195_2" x1="185.5" y1="0" x2="185.5" y2="354" gradientUnits="userSpaceOnUse">
					<stop offset="0.0569271" stop-color="#D9D9D9" stop-opacity="0.2"/>
					<stop offset="0.998202" stop-color="#D9D9D9" stop-opacity="0"/>
					</linearGradient>
					</defs>
				</svg>
			</figure>

			<!-- Breadcrumb -->
			<div class="d-flex justify-content-center position-relative z-index-9">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-dots breadcrumb-dark mb-1">
						<li class="breadcrumb-item"><a href="#">Accueil</a></li>
						<li class="breadcrumb-item active" aria-current="page">Acte de décès</li>
					</ol>
				</nav>
			</div>
			<!-- Title -->
			<h1 class="h2 text-white">Nouvelle demande d’acte de décès.</h1>
		</div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('createactedeces.store') }}" id="acteDecesForm" enctype="multipart/form-data">
                                @csrf

                                <!-- Informations sur le déclarant -->
                                <h4 class="mb-3 mt-4">Informations sur le déclarant</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="filiation" class="form-label">Filiation du déclarant *</label>
                                        <select class="form-select @error('filiation') is-invalid @enderror" 
                                                id="filiation" name="filiation" required>
                                            <option value="" disabled selected>Choisir...</option>
                                            <option value="enfant" {{ old('filiation') == 'enfant' ? 'selected' : '' }}>Enfant</option>
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
                                        <label for="nom_declarant" class="form-label">Nom du déclarant *</label>
                                        <input type="text" class="form-control @error('nom_declarant') is-invalid @enderror" 
                                            id="nom_declarant" name="nom_declarant" value="{{ old('nom_declarant') }}" required>
                                        @error('nom_declarant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_declarant" class="form-label">Prénom du déclarant *</label>
                                        <input type="text" class="form-control @error('prenom_declarant') is-invalid @enderror" 
                                            id="prenom_declarant" name="prenom_declarant" value="{{ old('prenom_declarant') }}" required>
                                        @error('prenom_declarant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Informations sur le défunt -->
                                <h4 class="mb-3 mt-4">Informations sur le défunt</h4>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nom_defunt" class="form-label">Nom du défunt *</label>
                                        <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" 
                                            id="nom_defunt" name="nom_defunt" value="{{ old('nom_defunt') }}" required>
                                        @error('nom_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="prenom_defunt" class="form-label">Prénom du défunt *</label>
                                        <input type="text" class="form-control @error('prenom_defunt') is-invalid @enderror" 
                                            id="prenom_defunt" name="prenom_defunt" value="{{ old('prenom_defunt') }}" required>
                                        @error('prenom_defunt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date_naissance" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                            id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                                        @error('date_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Lieu de décès et date acte -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror" 
                                            id="lieu_naissance" name="lieu_naissance" value="{{ old('lieu_naissance') }}">
                                        @error('lieu_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_acte_display" class="form-label">Date de l'acte *</label>
                                        <input type="text" 
                                            class="form-control" 
                                            id="date_acte_display" 
                                            value="{{ now()->format('d/m/Y') }}" 
                                            readonly
                                            style="background-color: #f8f9fa; cursor: not-allowed;">
                                        <input type="hidden" 
                                            name="date_acte" 
                                            id="date_acte" 
                                            value="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <!-- Type de localité et localité -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type_localite" class="form-label">Type de localité *</label>
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
                                        <label for="localite_id" class="form-label">Localité *</label>
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

                                <!-- Informations sur la naissance du défunt -->
                                <h4 class="mb-3 mt-4">Informations sur le décès</h4>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="lieu_deces" class="form-label">Lieu de décès *</label>
                                        <input type="text" class="form-control @error('lieu_deces') is-invalid @enderror" 
                                            id="lieu_deces" name="lieu_deces" value="{{ old('lieu_deces') }}" required>
                                        @error('lieu_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_deces" class="form-label">Date de décès *</label>
                                        <input type="date" class="form-control @error('date_deces') is-invalid @enderror" 
                                            id="date_deces" name="date_deces" value="{{ old('date_deces') }}" required>
                                        @error('date_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Heure de décès-->
                                    <div class="col-md-6">
                                        <label for="heure_deces" class="form-label">Heure de décès *</label>
                                        <input type="time" class="form-control @error('heure_deces') is-invalid @enderror" 
                                            id="heure_deces" name="heure_deces" value="{{ old('heure_deces') }}" required>
                                        @error('heure_deces')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                     <div class="col-md-6">
                                            <label for="cause_deces" class="form-label">Cause du décès</label>
                                            <textarea class="form-control @error('cause_deces') is-invalid @enderror" 
                                                    id="cause_deces" name="cause_deces">{{ old('cause_deces') }}</textarea>
                                            @error('cause_deces')
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
                                        <div class="mb-3">
                                            <label for="type_parent" class="form-label">Type de parenté</label>
                                            <select class="form-select @error('type_parent') is-invalid @enderror" 
                                                id="type_parent" name="type_parent">
                                                <option value="" {{ old('type_parent') == '' ? 'selected' : '' }}>Sélectionner un type</option>
                                                <option value="père" {{ old('type_parent') == 'père' ? 'selected' : '' }}>Père</option>
                                                <option value="mère" {{ old('type_parent') == 'mère' ? 'selected' : '' }}>Mère</option>
                                            </select>
                                            @error('type_parent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nom_parent" class="form-label">Nom du parent</label>
                                            <input type="text" class="form-control @error('nom_parent') is-invalid @enderror" 
                                                id="nom_parent" name="nom_parent" value="{{ old('nom_parent') }}">
                                            @error('nom_parent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="prenom_parent" class="form-label">Prénom du parent</label>
                                            <input type="text" class="form-control @error('prenom_parent') is-invalid @enderror" 
                                                id="prenom_parent" name="prenom_parent" value="{{ old('prenom_parent') }}">
                                            @error('prenom_parent')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Documents -->
                                 <h4 class="mb-3 mt-4">Documents justificatifs  du décès</h4>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="documents" class="form-label">Documents justificatifs</label>
                                        <input type="file" class="form-control @error('documents') is-invalid @enderror" 
                                            id="documents" name="documents[]" multiple>
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
                                            Enregistrer l'acte de décès
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
            const form = document.getElementById('acteDecesForm');
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
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations sur le déclarant</h6>
                            <p><strong>Nom:</strong> ${formValues.nom_declarant}</p>
                            <p><strong>Prénom:</strong> ${formValues.prenom_declarant}</p>
                            <p><strong>Filiation:</strong> ${document.getElementById('filiation').options[document.getElementById('filiation').selectedIndex].text}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informations sur le défunt</h6>
                            <p><strong>Nom:</strong> ${formValues.nom_defunt}</p>
                            <p><strong>Prénom:</strong> ${formValues.prenom_defunt}</p>
                            <p><strong>Date de décès:</strong> ${formValues.date_deces}</p>
                            <p><strong>Heure de décès:</strong> ${formValues.heure_deces}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6>Lieu de décès</h6>
                            <p><strong>Lieu:</strong> ${formValues.lieu_deces}</p>
                            <p><strong>Date de l'acte:</strong> ${formValues.date_acte}</p>
                            <p><strong>Type de localité:</strong> ${typeLocaliteSelect.options[typeLocaliteSelect.selectedIndex].text}</p>
                            <p><strong>Localité:</strong> ${localiteSelect.options[localiteSelect.selectedIndex].text}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informations supplémentaires</h6>
                            <p><strong>Date de naissance:</strong> ${formValues.date_naissance || 'Non renseignée'}</p>
                            <p><strong>Lieu de naissance:</strong> ${formValues.lieu_naissance || 'Non renseigné'}</p>
                            <p><strong>Cause du décès:</strong> ${formValues.cause_deces || 'Non renseignée'}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6>Documents joints</h6>
                            <ul>
                `;

                // Afficher les fichiers sélectionnés
                const filesInput = document.getElementById('documents');
                if (filesInput.files.length > 0) {
                    for (let i = 0; i < filesInput.files.length; i++) {
                        htmlContent += `<li>${filesInput.files[i].name}</li>`;
                    }
                } else {
                    htmlContent += `<li>Aucun document joint</li>`;
                }

                htmlContent += `
                            </ul>
                        </div>
                    </div>
                `;

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
@stop