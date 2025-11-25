<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande d'insertion ou modification d'un résultat (Par Étudiant)</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 20px; }
        h2 { color: #2c3e50; text-align: center; margin-bottom: 20px; }
        .header { margin-bottom: 30px; text-align: center; }
        .header p { margin: 5px 0; }
        .section { margin-bottom: 20px; }
        .section-title { color: #3498db; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-bottom: 10px; }
        .student-info { margin-bottom: 15px; }
        .module-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .module-table th, .module-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .module-table th { background-color: #f2f2f2; }
        .signature { margin-top: 50px; display: flex; justify-content: space-between; }
        .signature-box { width: 45%; }
        .footer { margin-top: 30px; font-size: 0.9em; color: #777; text-align: center; }

        @font-face {
            font-family: 'DejaVu Sans';
            src: url({{ storage_path('fonts/DejaVuSans.ttf') }}) format('truetype');
        }
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Demande d'insertion ou modification d'un résultat des années antérieures sur le système APOGEE (Par Étudiant)</h2>
        <p><strong>Établissement:</strong> {{ $data['etbl'] }}</p>
        <p><strong>Date de la demande:</strong> {{ $data['dateDM'] }}</p>
    </div>

    <div class="section">
        <h3 class="section-title">Informations de l'Étudiant</h3>
        <div class="student-info">
            <p><strong>Nom & Prénom:</strong> {{ $data['NomPrenom'] }}</p>
            <p><strong>Numéro APOGEE:</strong> {{ $data['NumApogee'] }}</p>
            <p><strong>Cycle:</strong> {{ $data['typ'] }}</p>
            <p><strong>Filière:</strong> {{ $data['flr'] }}</p>
            <p><strong>Semestre:</strong> {{ $data['Semestre'] }}</p>
            <p><strong>Année universitaire concernée:</strong> {{ $data['AnneeCon'] }}</p>
            <p><strong>Nature de la demande:</strong> {{ $data['nrtDM'] }}</p>
        </div>
    </div>

    <div class="section">
        <h3 class="section-title">Liste des Modules</h3>
        <table class="module-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Session</th>
                    <th>Note Initiale</th>
                    <th>Note Corrigée</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['modules'] as $module)
                <tr>
                    <td>{{ $module['M'] }}</td>
                    <td>{{ $module['S'] }}</td>
                    <td>{{ $module['NI'] }}</td>
                    <td>{{ $module['NC'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3 class="section-title">Raison du retard</h3>
        <p>{{ $data['raison'] }}</p>
    </div>

    <div class="signature">
        <div class="signature-box">
            <p>Signature du Responsable Pédagogique</p>
            <p>Nom: __________________________</p>
            <p>Date: __________________________</p>
        </div>
        <div class="signature-box">
            <p>Signature du Responsable APOGEE</p>
            <p>Nom: __________________________</p>
            <p>Date: __________________________</p>
        </div>
    </div>

    <div class="footer">
        <p>Document généré automatiquement le {{ date('d/m/Y à H:i') }}</p>
    </div>
</body>
</html>
