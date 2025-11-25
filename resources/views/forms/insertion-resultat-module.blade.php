@extends('layouts.app')

@section('title', 'Insertion-resultat-module')

@section('breadcrumbs')
    <div class="breadcrumb-container">
        <div class="breadcrumb-content">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">>Home</a>
                <a href="{{ url('/insertion-resultat-module') }}">>Résultat par module </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('components.quick-access')

    <div class="form-container">
        <h2>Demande d'insertion ou modification d'un résultat des années antérieures (Par Module)</h2>

        <div id="loadingScreen">
            <div class="spinner"></div>
            <p class="loading-text">Génération du PDF en cours, veuillez patienter...</p>
        </div>

        <form id="resultatModuleForm" action="{{ route('generate.resultat-module.pdf') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Etablissement</label>
                <input type="text" name="etbl" required>
            </div>

            <div class="form-group">
                <label>Date de la demande</label>
                <input type="date" name="dateDM" required>
            </div>

            <div class="form-group">
                <label>Cycle</label>
                <input type="text" name="typ" required>
            </div>

            <div class="form-group">
                <label>Filière</label>
                <input type="text" name="flr" required>
            </div>

            <div class="form-group">
                <label>Nom du Module</label>
                <input type="text" name="module" required>
            </div>

            <div class="form-group">
                <label>Nature de la demande</label>
                <input type="text" name="nrtDM" required>
            </div>

            <div class="form-group">
                <label>Semestre</label>
                <input type="text" name="Semestre" required>
            </div>

            <div class="form-group">
                <label>Année universitaire concernée</label>
                <input type="text" name="AnneeCon" required>
            </div>

            <h4 class="small-section">Liste des Étudiants</h4>

            <div id="students-container">
                <div class="student-grid">
                    <div class="student-row">
                        <input type="text" name="students[0][apogee]" placeholder="Numéro APOGEE" required>
                        <input type="text" name="students[0][name]" placeholder="Nom & Prénom" required>
                        <input type="text" name="students[0][session]" placeholder="Session" required>
                        <input type="text" name="students[0][note_initiale]" placeholder="Note Initiale" required>
                        <input type="text" name="students[0][note_corrigee]" placeholder="Note Corrigée" required>
                        <button type="button" class="btn btn-danger remove-student-btn">❌</button>
                    </div>
                </div>
            </div>

            <button type="button" id="add-student-btn" class="btn btn-success">+ Ajouter un étudiant</button>

            <div class="form-group">
                <label>Raison du retard</label>
                <textarea name="raso" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>Responsable du Module</label>
                <input type="text" name="ResP" required>
            </div>

            <div class="form-group">
                <label>Coordinateur de la Filière</label>
                <input type="text" name="Cordi" required>
            </div>

            <button type="submit" class="submit-btn">Générer le PDF</button>
        </form>
    </div>

    @push('styles')
    <style>
        .form-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(800px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .student-row {
            display: grid;
            grid-template-columns: 100px 200px 80px 100px 100px 50px;
            gap: 10px;
            align-items: center;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
        }

        #loadingScreen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            color: white;
            margin-top: 15px;
            font-size: 18px;
        }

        .small-section {
            margin: 20px 0 10px 0;
            color: #333;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("resultatModuleForm");
            const loadingScreen = document.getElementById("loadingScreen");
            let studentIndex = 1;
            const container = document.getElementById("students-container");

            // Add student row
            document.getElementById("add-student-btn").addEventListener("click", function() {
                const studentGrid = container.querySelector(".student-grid");
                const newRow = document.createElement("div");
                newRow.className = "student-row";
                newRow.innerHTML = `
                    <input type="text" name="students[${studentIndex}][apogee]" placeholder="Numéro APOGEE" required>
                    <input type="text" name="students[${studentIndex}][name]" placeholder="Nom & Prénom" required>
                    <input type="text" name="students[${studentIndex}][session]" placeholder="Session" required>
                    <input type="text" name="students[${studentIndex}][note_initiale]" placeholder="Note Initiale" required>
                    <input type="text" name="students[${studentIndex}][note_corrigee]" placeholder="Note Corrigée" required>
                    <button type="button" class="btn btn-danger remove-student-btn">❌</button>
                `;
                studentGrid.appendChild(newRow);
                studentIndex++;
            });

            // Handle remove student row using event delegation
            container.addEventListener("click", function(e) {
                if (e.target.classList.contains("remove-student-btn")) {
                    e.target.closest('.student-row').remove();
                }
            });

            // Form submission handling
            if (form) {
                form.addEventListener("submit", function(e) {
                    // loadingScreen.style.display = "flex";

                    // You can add additional form validation here if needed
                    // If validation fails, call e.preventDefault() to stop submission
                });
            }
        });
    </script>
    @endpush
@endsection
