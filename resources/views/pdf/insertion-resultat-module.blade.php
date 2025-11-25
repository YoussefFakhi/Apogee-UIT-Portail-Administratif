<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande d'insertion ou modification d'un résultat (Par Module)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #2c3e50;
            font-size: 16px;
            margin-bottom: 5px;
        }
        h4 {
            color: #2c3e50;
            font-size: 14px;
            margin: 15px 0 10px 0;
        }
        .section {
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-label {
            font-weight: bold;
            display: inline-block;
            width: 250px;
        }
        .form-value {
            display: inline-block;
        }
        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11px;
        }
        .student-table th, .student-table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .student-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .signature-area {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 200px;
            border-top: 1px solid #000;
            text-align: center;
            padding-top: 5px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Demande d'insertion ou modification d'un résultat des années antérieures (Par Module)</h2>
    </div>

    <div class="section">
        <div class="form-group">
            <span class="form-label">Etablissement:</span>
            <span class="form-value">{{ $data['etbl'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Date de la demande:</span>
            <span class="form-value">{{ $data['dateDM'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Cycle:</span>
            <span class="form-value">{{ $data['typ'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Filière:</span>
            <span class="form-value">{{ $data['flr'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Nom du Module:</span>
            <span class="form-value">{{ $data['module'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Nature de la demande:</span>
            <span class="form-value">{{ $data['nrtDM'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Semestre:</span>
            <span class="form-value">{{ $data['Semestre'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Année universitaire concernée:</span>
            <span class="form-value">{{ $data['AnneeCon'] }}</span>
        </div>
    </div>

    <h4>Liste des Étudiants</h4>
    <table class="student-table">
        <thead>
            <tr>
                <th>Numéro APOGEE</th>
                <th>Nom & Prénom</th>
                <th>Session</th>
                <th>Note Initiale</th>
                <th>Note Corrigée</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['students'] as $student)
            <tr>
                <td>{{ $student['apogee'] }}</td>
                <td>{{ $student['name'] }}</td>
                <td>{{ $student['session'] }}</td>
                <td>{{ $student['note_initiale'] }}</td>
                <td>{{ $student['note_corrigee'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section">
        <div class="form-group">
            <span class="form-label">Raison du retard:</span>
        </div>
        <div style="border: 1px solid #ddd; padding: 8px; min-height: 60px;">
            {{ $data['raso'] }}
        </div>
    </div>

    <div class="section">
        <div class="form-group">
            <span class="form-label">Responsable du Module:</span>
            <span class="form-value">{{ $data['ResP'] }}</span>
        </div>

        <div class="form-group">
            <span class="form-label">Coordinateur de la Filière:</span>
            <span class="form-value">{{ $data['Cordi'] }}</span>
        </div>
    </div>

    <div class="signature-area">
        <div class="signature-box">
            Responsable du Module<br><br>
            Signature et cachet
        </div>
        <div class="signature-box">
            Coordinateur de la Filière<br><br>
            Signature et cachet
        </div>
    </div>
</body>
</html>
