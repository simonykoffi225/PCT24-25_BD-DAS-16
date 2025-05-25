<!DOCTYPE html>
<html>
<head>
    <title>Acte de Naissance - {{ $acte->numero_acte }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { margin: 0 auto; width: 90%; }
        .footer { text-align: center; margin-top: 50px; font-size: 0.8em; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border: 1px solid #ddd; }
        .signature-container { margin-top: 50px; text-align: right; }
        .signature-img { max-width: 150px; max-height: 80px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>ACTE DE NAISSANCE</h2>
        <p>République du cote d'ivoire</p>
    </div>
    
    <div class="content">
        <h3>Informations de l'enfant</h3>
        <table>
            <tr><td>Numéro d'acte</td><td>{{ $acte->numero_acte }}</td></tr>
            <tr><td>Nom complet</td><td>{{ $acte->nom_enfant }} {{ $acte->prenom_enfant }}</td></tr>
            <tr><td>Date de naissance</td><td>{{ $acte->date_naissance->format('d/m/Y') }}</td></tr>
            <tr><td>Lieu de naissance</td><td>{{ $acte->lieu_naissance }}</td></tr>
        </table>
        
        <h3>Informations des parents</h3>
        <table>
            <tr><td>Nom du père</td><td>{{ $acte->nom_pere ?? 'Non renseigné' }}</td></tr>
            <tr><td>Nom de la mère</td><td>{{ $acte->nom_mere }}</td></tr>
        </table>

        <div class="signature-container">
            @if($validateur && $validateur->signature)
                <div>
                    <p>Validé par: {{ $validateur->name }}</p>
                    <p>Le: {{ $acte->updated_at->format('d/m/Y') }}</p>
                    <img src="{{ storage_path('app/public/' . $validateur->signature) }}" class="signature-img">
                </div>
            @endif
        </div>
        
        <div class="footer">
            <p>Document généré le {{ now()->format('d/m/Y H:i') }}</p>
            <p>Copie certifiée conforme</p>
            <p>Référence de paiement: {{ $reference }}</p>
        </div>
    </div>
</body>
</html>