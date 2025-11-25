<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande de compte fonctionnel APOGEE</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { color: #2c3e50; margin-bottom: 5px; }
        .header p { font-style: italic; color: #7f8c8d; }
        .section { margin-bottom: 15px; }
        .section-title {
            background-color: #f2f2f2;
            padding: 5px 10px;
            font-weight: bold;
            margin: 15px 0 10px 0;
            border-left: 4px solid #3498db;
        }
        .form-group { margin-bottom: 8px; }
        .form-group label { font-weight: bold; display: inline-block; width: 250px; }
        .form-group .value { display: inline-block; }
        .checkbox-list { margin-left: 20px; }
        .checkbox-item { margin-bottom: 5px; }
        .signature-area { margin-top: 40px; }
        .signature-line {
            border-top: 1px solid #000;
            width: 300px;
            margin-top: 40px;
            padding-top: 5px;
        }
        .footer { font-size: 10px; text-align: center; margin-top: 30px; color: #7f8c8d; }
        .page-break { page-break-after: always; }

        .checkbox-item {
            font-family: DejaVu Sans, sans-serif;
            margin-bottom: 5px;
        }


    </style>
</head>
<body>
    <div class="header">
        <h2>Demande d'ouverture ou de modification d'un compte APOGEE</h2>
        <p>UNIVERSITÉ IBN TOFAIL</p>
    </div>

    <div class="section">
        <div class="form-group">
            <label>Etablissement:</label>
            <span class="value">{{ $data['etbl'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Date de la demande:</label>
            <span class="value">{{ $data['dateDM'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Nature de la demande:</label>
            <span class="value">{{ $data['demNTR'] ?? '' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="form-group">
            <label>Nom et Prénom du demandeur:</label>
            <span class="value">{{ $data['nomPrenomUser'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Nom d'utilisateur APOGEE:</label>
            <span class="value">{{ $data['userName'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Fonction:</label>
            <span class="value">{{ $data['fonction'] ?? '' }}</span>
        </div>
    </div>

    <div class="section-title">Centres</div>

    <div class="section">
        <div class="form-group">
            <label>Centre de gestion:</label>
            <span class="value">{{ $data['strg1'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Centre de traitement:</label>
            <span class="value">{{ $data['strg2'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Centre d'inscription pédagogique:</label>
            <span class="value">{{ $data['strg3'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Centre d'incompatibilité:</label>
            <span class="value">{{ $data['strg4'] ?? '' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="form-group">
            <label>Téléphone:</label>
            <span class="value">{{ $data['tele'] ?? '' }}</span>
        </div>

        <div class="form-group">
            <label>Adresse MAC de l'ordinateur:</label>
            <span class="value">{{ $data['mac'] ?? '' }}</span>
        </div>
    </div>

    <div class="section-title">Privilèges du Compte Utilisateur d'APOGEE</div>

        <div class="checkbox-list">
            @foreach([
                'p1' => 'Inscription Administrative',
                'p2' => 'Inscription Pédagogique',
                'p3' => 'Résultat',
                'p4' => 'Structure des enseignements',
                'p5' => 'Dossier Étudiant',
                'p6' => 'Modalités de contrôle des connaissances',
                'p7' => 'Épreuves'
            ] as $field => $label)
            <div class="checkbox-item">
                [{{ isset($data[$field]) && $data[$field] === '✅' ? 'X' : ' ' }}] {{ $label }}
            </div>
            @endforeach
        </div>

        <div class="section-title">Accès aux fonctionnalités réservées au responsable APOGÉE</div>

        <div class="checkbox-list">
            <div class="checkbox-item">
                [{{ isset($data['p8']) && $data['p8'] === '✅' ? 'X' : ' ' }}] T (Ouverture et Fermeture de la session)
            </div>
            <div class="checkbox-item">
                [{{ isset($data['p9']) && $data['p9'] === '✅' ? 'X' : ' ' }}] A
            </div>
        </div>

    <div class="signature-area">
        <div style="float: right; text-align: center;">
            <div class="signature-line"></div>
            <p>Signature et cachet</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="footer">
        Document généré le {{ date('d/m/Y') }} - UNIVERSITÉ IBN TOFAIL
    </div>
</body>
</html>
