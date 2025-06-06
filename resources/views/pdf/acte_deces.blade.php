<!DOCTYPE html>
<html>
<head>
    <title>Acte de Décès - {{ $acte->numero_acte }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: "Times New Roman", serif;
            line-height: 1.6;
            color: #000;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
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
        }
        .two-columns {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .column {
            width: 48%;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin: 25px 0 15px 0;
            font-size: 15px;
        }
        .info-block {
            margin-bottom: 12px;
            display: flex;
        }
        .info-label {
            width: 180px;
            font-weight: bold;
            flex-shrink: 0;
        }
        .info-value {
            flex-grow: 1;
            border-bottom: 1px dotted #000;
            padding-bottom: 2px;
        }
        .official-stamp {
            float: right;
            margin: 20px;
            text-align: center;
            font-style: italic;
            border: 1px dashed #000;
            padding: 10px;
            width: 150px;
        }
        .signature-container {
            margin-top: 80px;
            text-align: right;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 250px;
            display: inline-block;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 15px;
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
        .mention-important {
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #000;
        }
        .signature-img { max-width: 150px; max-height: 80px; }
    </style>
</head>
<body>
    <!-- Filigrane -->
    <div class="watermark">RÉPUBLIQUE DE CÔTE D'IVOIRE</div>

    <div class="header">
        <h1>RÉPUBLIQUE DE CÔTE D'IVOIRE</h1>
        <h2>ACTE DE DÉCÈS N° {{ $acte->numero_acte }}</h2>
        <p class="subtitle">Union - Discipline - Travail</p>
    </div>
    
    <div class="content">
        <div class="mention-important">
            EXTRACT DES REGISTRES DE L'ÉTAT CIVIL
        </div>
        
        <div class="section">
            <div class="section-title">I. INFORMATIONS SUR LE DÉFUNT</div>
            
            <div class="info-block">
                <div class="info-label">Nom et prénoms :</div>
                <div class="info-value"><strong>{{ strtoupper($acte->nom_defunt) }} {{ $acte->prenom_defunt }}</strong></div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Date de naissance :</div>
                <div class="info-value">{{ $acte->date_naissance ? \Carbon\Carbon::parse($acte->date_naissance)->locale('fr')->isoFormat('LL') : 'Non renseignée' }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Lieu de naissance :</div>
                <div class="info-value">{{ $acte->lieu_naissance ?? 'Non renseigné' }}</div>
            </div>
            
            
            <div class="info-block">
                <div class="info-label">Date du décès :</div>
                <div class="info-value">{{ $acte->date_deces ? \Carbon\Carbon::parse($acte->date_deces)->locale('fr')->isoFormat('LL') : 'Non renseignée' }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Lieu du décès :</div>
                <div class="info-value">{{ $acte->lieu_deces ?? 'Non renseigné' }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Cause du décès :</div>
                <div class="info-value">{{ $acte->cause_deces ?? 'Non renseignée' }}</div>
            </div>
        </div>
        
        <div class="two-columns">
            <div class="column">
                <div class="section">
                    <div class="section-title">II. FILIATION</div>
                    
                    <div class="info-block">
                        <div class="info-label">Type de parent :</div>
                        <div class="info-value">{{ $acte->type_parent ?? 'Non renseigné' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Nom du parent :</div>
                        <div class="info-value">{{ $acte->nom_parent ?? 'Non renseigné' }} {{ $acte->prenom_parent ?? 'Non renseignée' }}</div>
                    </div>
                </div>
            </div>
            
            <div class="column">
                <div class="section">
                    <div class="section-title">III. INFORMATIONS SUR LE DÉCLARANT</div>
                    
                    <div class="info-block">
                        <div class="info-label">Nom et prénoms :</div>
                        <div class="info-value">{{ $acte->nom_declarant }} {{ $acte->prenom_declarant }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Lien avec le défunt :</div>
                        <div class="info-value">{{ $acte->filiation ?? 'Non renseigné' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Date déclaration :</div>
                        <div class="info-value">{{ $acte->date_acte ? \Carbon\Carbon::parse($acte->date_acte)->locale('fr')->isoFormat('LL') : now()->locale('fr')->isoFormat('LL') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">IV. MENTIONS OFFICIELLES</div>
            
            <div class="info-block">
                <div class="info-label">Mairie d'enregistrement :</div>
                <div class="info-value">{{ $acte->localite->nom ?? 'Non renseignée' }}</div>
            </div>
            
            <div class="info-block">
                <div class="info-label">Date d'enregistrement :</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($acte->created_at)->locale('fr')->isoFormat('LL') }}</div>
            </div>
        </div>

        <div class="signature-container">
            @if($validateur && $validateur->signature)
                <div>
                    <p>L'Officier de l'État Civil,</p>
                    <p>{{ strtoupper($validateur->name) }}</p>
                    <img src="{{ storage_path('app/public/' . $validateur->signature) }}" class="signature-img">
                    <p>Le {{ $acte->updated_at->format('d/m/Y') }}</p>
                </div>
            @endif
        </div>
        
        {{-- <div class="footer">
            <p><strong>Document délivré le :</strong> {{ now()->locale('fr')->isoFormat('LLLL') }}</p>
            <p><em>Copie certifiée conforme à l'original déposé au registre de l'état civil</em></p>
            <p><strong>Référence :</strong> {{ $reference }}</p>
        </div> --}}
    </div>
</body>
</html>