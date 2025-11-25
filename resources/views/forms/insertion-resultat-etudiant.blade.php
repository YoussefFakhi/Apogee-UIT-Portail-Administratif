@extends('layouts.app')

@section('title', 'Insertion-resultat-etudiant')

@section('breadcrumbs')
    {{-- @include('components.breadcrumbs') --}}
    <div class="breadcrumb-container">
        <div class="breadcrumb-content">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">>Home</a>
                <a href="{{ url('/insertion-resultat-etudiant') }}">>Résultat Étudiant </a>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('components.quick-access')

    <div class="form-container">
        <h2>Demande d'insertion ou modification d'un résultat des années antérieures sur le système APOGEE (Par Étudiant)</h2>

        <form id="resultatForm" action="{{ route('generate.resultat.pdf') }}" method="POST">
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
                <label>Nom & Prénom</label>
                <input type="text" name="NomPrenom" required>
            </div>

            <div class="form-group">
                <label>Numéro APOGEE</label>
                <input type="text" name="NumApogee" required>
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
                <label>Semestre</label>
                <input type="text" name="Semestre" required>
            </div>

            <div class="form-group">
                <label>Année universitaire concernée</label>
                <input type="text" name="AnneeCon" required>
            </div>

            <div class="form-group">
                <label>Nature de la demande</label>
                <input type="text" name="nrtDM" required>
            </div>

            <h4 class="small-section">Liste des Modules</h4>

            <div id="modules-container">
                <div class="module-row">
                    <input type="text" name="modules[0][M]" placeholder="Nom du Module" required>
                    <input type="text" name="modules[0][S]" placeholder="Session" required>
                    <input type="text" name="modules[0][NI]" placeholder="Note Initiale" required>
                    <input type="text" name="modules[0][NC]" placeholder="Note Corrigée" required>
                    <button type="button" class="btn btn-danger remove-module-btn">❌</button>
                </div>
            </div>

            <button type="button" id="add-module-btn" class="btn btn-success">+ Ajouter un module</button>

            <div class="form-group">
                <label>Raison du retard d'insertion ou correction des notes</label>
                <textarea name="raison" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">Générer le PDF</button>
        </form>
    </div>

    <div id="loadingScreen" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center; flex-direction: column; color: white;">
        <div class="spinner" style="border: 5px solid #f3f3f3; border-top: 5px solid #3498db; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite;"></div>
        <p class="loading-text" style="margin-top: 15px; font-size: 18px;">Génération du PDF en cours, veuillez patienter...</p>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resultatForm');
            const modulesContainer = document.getElementById('modules-container');
            const addModuleBtn = document.getElementById('add-module-btn');
            const loadingScreen = document.getElementById('loadingScreen');

            let moduleIndex = 1;

            // Add module row
            addModuleBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'module-row';
                newRow.innerHTML = `
                    <input type="text" name="modules[${moduleIndex}][M]" placeholder="Nom du Module" required>
                    <input type="text" name="modules[${moduleIndex}][S]" placeholder="Session" required>
                    <input type="text" name="modules[${moduleIndex}][NI]" placeholder="Note Initiale" required>
                    <input type="text" name="modules[${moduleIndex}][NC]" placeholder="Note Corrigée" required>
                    <button type="button" class="btn btn-danger remove-module-btn">❌</button>
                `;
                modulesContainer.appendChild(newRow);

                // Add remove event to new button
                newRow.querySelector('.remove-module-btn').addEventListener('click', function() {
                    newRow.remove();
                });

                moduleIndex++;
            });

            // Form submission handling
            if (form) {
                form.addEventListener('submit', function() {
                    showLoading();
                    // The form will submit normally to the Laravel route
                });
            }

            // Add remove event to initial button
            const initialRemoveBtn = document.querySelector('.remove-module-btn');
            if (initialRemoveBtn) {
                initialRemoveBtn.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            }

            function hideLoading() {
                if (loadingScreen) {
                    loadingScreen.style.display = 'none';
                }
            }

            // Add CSS animation for spinner
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
    @endpush
@endsection
