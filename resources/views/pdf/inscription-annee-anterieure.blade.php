<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande d'inscription administrative à une année antérieure</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        h2 { color: #2c3e50; text-align: center; }
        .header { margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        .student-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .student-table th, .student-table td { border: 1px solid #ddd; padding: 8px; }
        .student-table th { background-color: #f2f2f2; }
        .signature { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Demande d'inscription administrative à une année antérieure</h2>
    </div>

    <div class="section">
        <p><strong>Etablissement:</strong> {{ $data['etbl'] }}</p>
        <p><strong>Date de la demande:</strong> {{ $data['dateDM'] }}</p>
        <p><strong>Cycle:</strong> {{ $data['typ'] }}</p>
        <p><strong>Filière:</strong> {{ $data['flr'] }}</p>
        <p><strong>Nature de la demande:</strong> {{ $data['nrtDM'] }}</p>
        <p><strong>Année d'inscription concernée:</strong> {{ $data['aneINS'] }}</p>
    </div>

    <div class="section">
        <h3>Liste des Étudiants</h3>
        <table class="student-table">
            <thead>
                <tr>
                    <th>Numéro APOGEE</th>
                    <th>Nom & Prénom</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['students'] as $student)
                <tr>
                    <td>{{ $student['apogee'] }}</td>
                    <td>{{ $student['name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <p><strong>La raison du retard:</strong></p>
        <p>{{ $data['mtf'] }}</p>
    </div>

    <div class="signature">
        <p>Signature et cachet</p>
    </div>
</body>
</html>
