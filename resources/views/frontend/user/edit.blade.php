

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (pour les icônes) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Modifier l'utilisateur</h4>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Annuler
                        </a>
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Messages d'erreur -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 mb-3">Informations personnelles</h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Rôle *</label>
                                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                                    {{ ucfirst($role) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            <div class="mb-3" id="signature-field" style="display: {{ in_array($user->role, ['admin', 'officier']) ? 'block' : 'none' }};">
    <label for="signature" class="form-label">Signature</label>
    @if($user->signature)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $user->signature) }}" alt="Signature" style="max-height: 100px;">
            <a href="#" class="text-danger ms-2" onclick="event.preventDefault(); document.getElementById('remove-signature').value = '1'; this.closest('div').querySelector('img').style.display = 'none';">
                <i class="fas fa-trash-alt"></i> Supprimer
            </a>
            <input type="hidden" name="remove_signature" id="remove-signature" value="0">
        </div>
    @endif
    <input type="file" class="form-control" id="signature" name="signature" accept="image/png, image/jpeg, image/svg+xml">
    <small class="text-muted">Formats acceptés: PNG, JPG, SVG (max 2MB)</small>
</div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact" class="form-label">Contact</label>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                               id="contact" name="contact" value="{{ old('contact', $user->contact) }}">
                                        @error('contact')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_naissance" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" 
                                               id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance ? $user->date_naissance->format('Y-m-d') : '') }}">
                                        @error('date_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Genre</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('genre') is-invalid @enderror" 
                                                       type="radio" name="genre" id="homme" 
                                                       value="homme" {{ old('genre', $user->genre) == 'homme' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="homme">Homme</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('genre') is-invalid @enderror" 
                                                       type="radio" name="genre" id="femme" 
                                                       value="femme" {{ old('genre', $user->genre) == 'femme' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="femme">Femme</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('genre') is-invalid @enderror" 
                                                       type="radio" name="genre" id="autre" 
                                                       value="autre" {{ old('genre', $user->genre) == 'autre' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="autre">Autre</label>
                                            </div>
                                        </div>
                                        @error('genre')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const signatureField = document.getElementById('signature-field');
    
    function toggleSignatureField() {
        if (roleSelect && signatureField) {
            const selectedRole = roleSelect.value;
            signatureField.style.display = (selectedRole === 'admin' || selectedRole === 'officier') ? 'block' : 'none';
        }
    }
    
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleSignatureField);
        // Pas besoin d'appeler toggleSignatureField() ici car le style est géré par Blade
    }
});
</script>
</body>
</html>
