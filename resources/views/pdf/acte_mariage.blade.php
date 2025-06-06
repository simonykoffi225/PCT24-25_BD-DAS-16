<!DOCTYPE html>
<html>
<head>
    <title>Acte de Mariage - {{ $acte->numero_acte }}</title>
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
            font-size: 14px;
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
            width: 150px;
            font-weight: bold;
            flex-shrink: 0;
        }
        .info-value {
            flex-grow: 1;
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
        .divider {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        .witness-columns {
            display: flex;
            justify-content: space-between;
        }
        .witness-column {
            width: 48%;
        }
    </style>
</head>
<body>
    <!-- Filigrane -->
    <div class="watermark">RÉPUBLIQUE DE CÔTE D'IVOIRE</div>

    <div class="header">
        <h1>RÉPUBLIQUE DE CÔTE D'IVOIRE</h1>
        <h2>EXTRACT D'ACTE DE MARIAGE N° {{ $acte->numero_acte }}</h2>
        <p class="subtitle">Union - Discipline - Travail</p>
    </div>
    
    <div class="content">
        <div class="two-columns">
            <div class="column">
                <div class="section">
                    <div class="section-title">I. INFORMATIONS SUR L'ÉPOUX</div>
                    
                    <div class="info-block">
                        <div class="info-label">Nom complet :</div>
                        <div class="info-value"><strong>{{ strtoupper($acte->nom_epoux) }} {{ $acte->prenom_epoux }}</strong></div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Naissance :</div>
                        <div class="info-value">
                            {{ $acte->date_naissance_epoux ? \Carbon\Carbon::parse($acte->date_naissance_epoux)->locale('fr')->isoFormat('LL') : 'Non renseignée' }}<br>
                            à {{ $acte->lieu_naissance_epoux ?? 'Non renseigné' }}
                        </div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Profession :</div>
                        <div class="info-value">{{ $acte->profession_epoux ?? 'Non renseignée' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Domicile :</div>
                        <div class="info-value">{{ $acte->domicile_epoux ?? 'Non renseigné' }}</div>
                    </div>
                </div>
            </div>
            
            <div class="column">
                <div class="section">
                    <div class="section-title">I. INFORMATIONS SUR L'ÉPOUSE</div>
                    
                    <div class="info-block">
                        <div class="info-label">Nom complet :</div>
                        <div class="info-value"><strong>{{ strtoupper($acte->nom_epouse) }} {{ $acte->prenom_epouse }}</strong></div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Naissance :</div>
                        <div class="info-value">
                            {{ $acte->date_naissance_epouse ? \Carbon\Carbon::parse($acte->date_naissance_epouse)->locale('fr')->isoFormat('LL') : 'Non renseignée' }}<br>
                            à {{ $acte->lieu_naissance_epouse ?? 'Non renseigné' }}
                        </div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Profession :</div>
                        <div class="info-value">{{ $acte->profession_epouse ?? 'Non renseignée' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Domicile :</div>
                        <div class="info-value">{{ $acte->domicile_epouse ?? 'Non renseigné' }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="two-columns">
            <div class="column">
                <div class="section">
                    <div class="section-title">II. INFORMATIONS SUR LE MARIAGE</div>
                    
                    <div class="info-block">
                        <div class="info-label">Date :</div>
                        <div class="info-value">{{ $acte->date_mariage ? \Carbon\Carbon::parse($acte->date_mariage)->locale('fr')->isoFormat('LL') : 'Non renseignée' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Lieu :</div>
                        <div class="info-value">{{ $acte->lieu_mariage ?? 'Non renseigné' }}</div>
                    </div>
                </div>
            </div>
            
            <div class="column">
                <div class="section">
                    <div class="section-title">III. RÉGIME MATRIMONIAL</div>
                    
                    <div class="info-block">
                        <div class="info-label">Régime :</div>
                        <div class="info-value">{{ $acte->regime_matrimonial ?? 'Communauté réduite aux acquêts' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Contrat :</div>
                        <div class="info-value">{{ $acte->contrat_mariage ? 'Oui' : 'Non' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Mairie :</div>
                        <div class="info-value">{{ $acte->localite->nom ?? 'Non renseignée' }}</div>
                    </div>
                    
                    <div class="info-block">
                        <div class="info-label">Enregistrement :</div>
                        <div class="info-value">{{ $acte->date_acte ? \Carbon\Carbon::parse($acte->date_acte)->locale('fr')->isoFormat('LL') : now()->locale('fr')->isoFormat('LL') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section">
            <div class="section-title">IV. INFORMATIONS SUR LES TÉMOINS</div>
            
            <div class="witness-columns">
                <div class="witness-column">
                    <div class="info-block">
                        <div class="info-label">Témoin 1 :</div>
                        <div class="info-value">
                            <strong>{{ strtoupper($acte->nom_temoin1) }} {{ $acte->prenom_temoin1 }}</strong>
                        </div>
                    </div>
                </div>
                
                <div class="witness-column">
                    <div class="info-block">
                        <div class="info-label">Témoin 2 :</div>
                        <div class="info-value">
                            <strong>{{ strtoupper($acte->nom_temoin2) }} {{ $acte->prenom_temoin2 }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="signature-container">
            @if($validateur && $validateur->signature)
                <div>
                    <p>L'Officier de l'État Civil, {{ strtoupper($validateur->name) }}</p>
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