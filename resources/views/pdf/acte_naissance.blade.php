<!DOCTYPE html>
<html>
<head>
    <title>Acte de Naissance - {{ $acte->numero_acte }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: "Times New Roman", serif;
            margin: 2cm;
            line-height: 1.5;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 16px;
            text-decoration: underline;
            margin: 10px 0;
        }
        .header .subtitle {
            font-size: 14px;
            font-weight: bold;
        }
        .content {
            margin: 20px 0;
            font-size: 14px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin: 15px 0 10px 0;
        }
        .info-block {
            margin-bottom: 10px;
        }
        .info-label {
            display: inline-block;
            width: 180px;
            font-weight: bold;
        }
        .signature-container {
            margin-top: 80px;
            text-align: right;
        }
        .signature-img {
            height: 60px;
            border-bottom: 1px solid #000;
            display: block;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
        .watermark {
            position: fixed;
            opacity: 0.1;
            font-size: 80px;
            width: 100%;
            text-align: center;
            top: 40%;
            left: 0;
            transform: rotate(-45deg);
            z-index: -1;
        }
        .stamp {
            position: absolute;
            right: 50px;
            top: 150px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <!-- Filigrane -->
    <div class="watermark">RÉPUBLIQUE DE CÔTE D'IVOIRE</div>

    <div class="header">
        <h1>RÉPUBLIQUE DE CÔTE D'IVOIRE</h1>
        <h2>EXTRACT D'ACTE DE NAISSANCE</h2>
        <p class="subtitle">Union - Discipline - Travail</p>
    </div>
    
    <div class="content">
        <div class="section-title">I. INFORMATIONS SUR L'ENFANT</div>
        
        <div class="info-block">
            <span class="info-label">Numéro d'acte :</span>
            <span>{{ $acte->numero_acte }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Nom :</span>
            <span>{{ strtoupper($acte->nom_enfant) }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Prénoms :</span>
            <span>{{ $acte->prenom_enfant }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Date de naissance :</span>
            <span>{{ $acte->date_naissance->format('d/m/Y') }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Lieu de naissance :</span>
            <span>{{ $acte->lieu_naissance }}</span>
        </div>
        
        <div class="section-title">II. INFORMATIONS SUR LES PARENTS</div>
        
        <div class="info-block">
            <span class="info-label">Père :</span>
            <span>{{ strtoupper($acte->nom_pere ?? 'Non renseigné') }} {{ $acte->prenom_pere ?? '' }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Profession du père :</span>
            <span>{{ $acte->profession_pere ?? 'Non renseigné' }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Domicile du père :</span>
            <span>{{ $acte->domicile_pere ?? 'Non renseigné' }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Mère :</span>
            <span>{{ strtoupper($acte->nom_mere ?? 'Non renseigné') }} {{ $acte->prenom_mere ?? '' }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Profession de la mère :</span>
            <span>{{ $acte->profession_mere ?? 'Non renseigné' }}</span>
        </div>
        
        <div class="info-block">
            <span class="info-label">Domicile de la mère :</span>
            <span>{{ $acte->domicile_mere ?? 'Non renseigné' }}</span>
        </div>

        <div class="signature-container">
            @if($validateur && $validateur->signature)
                <div>
                    <p>L'Officier de l'État Civil,</p>
                    <img src="{{ storage_path('app/public/' . $validateur->signature) }}" class="signature-img">
                    <p>{{ strtoupper($validateur->name) }}</p>
                    <p>Le {{ $acte->updated_at->format('d/m/Y') }}</p>
                </div>
            @endif
        </div>
    </div>
    
    {{-- <div class="footer">
        <p><strong>Document délivré le :</strong> {{ now()->format('d/m/Y à H:i') }}</p>
        <p><em>Copie certifiée conforme à l'original</em></p>
        <p><strong>Référence :</strong> {{ $reference }}</p>
    </div> --}}
</body>
</html>