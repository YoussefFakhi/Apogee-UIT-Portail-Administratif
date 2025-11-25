@extends('layouts.app')

@section('title', 'Inscription Année Antérieure')

@section('breadcrumbs')
    {{-- @include('components.breadcrumbs') --}}
    <div class="breadcrumb-container">
        <div class="breadcrumb-content">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">>Home</a>
                <a href="{{ url('/inscription-annee-anterieure') }}">>Inscription Administratives</a>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('components.quick-access')

    <div class="form-container">
        <h2 class="text-center mb-4">Demande d'inscription administrative à une année antérieure</h2>
        <div id="loadingScreen">
            <div class="spinner"></div>
            <p class="loading-text">Génération du PDF en cours, veuillez patienter...</p>
        </div>
        <form id="inscriptionForm" action="{{ route('generate.inscription.pdf') }}" method="POST">
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
                <label>Nature de la demande</label>
                <input type="text" name="nrtDM" required>
            </div>

            <div class="form-group">
                <label>Année d'inscription concernée</label>
                <input type="text" name="aneINS" required>
            </div>

            <div class="form-group">
                <h3 style="color: var(--main-color);">Liste des Étudiants</h3>
                <div id="studentsContainer">
                    <div class="student-row">
                        <input type="text" name="students[0][apogee]" placeholder="Numéro APOGEE" required>
                        <input type="text" name="students[0][name]" placeholder="Nom & Prénom" required>
                        <button type="button" class="btn btn-danger remove-student-btn">❌</button>
                    </div>
                </div>
                <button type="button" id="addStudentBtn" class="btn btn-success">+ Ajouter un étudiant</button>
            </div>

            <div class="form-group">
                <label>La raison du retard</label>
                <textarea name="mtf" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">Générer le PDF</button>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('inscriptionForm');
            const studentsContainer = document.getElementById('studentsContainer');
            const addStudentBtn = document.getElementById('addStudentBtn');
            const loadingScreen = document.getElementById('loadingScreen');

            let studentIndex = 1;

            // Add student row
            addStudentBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'student-row';
                newRow.innerHTML = `
                    <input type="text" name="students[${studentIndex}][apogee]" placeholder="Numéro APOGEE" required>
                    <input type="text" name="students[${studentIndex}][name]" placeholder="Nom & Prénom" required>
                    <button type="button" class="btn btn-danger remove-student-btn">❌</button>
                `;
                studentsContainer.appendChild(newRow);

                // Add remove event to new button
                newRow.querySelector('.remove-student-btn').addEventListener('click', function() {
                    newRow.remove();
                });

                studentIndex++;
            });

            // Form submission handler
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Show loading screen

                    // The activity will be tracked by the controller
                    // Form will submit normally to the Laravel route
                });
            }

            function showLoading() {
                if (loadingScreen) {
                    loadingScreen.style.display = 'flex';
                }
            }

            function hideLoading() {
                if (loadingScreen) {
                    loadingScreen.style.display = 'none';
                }
            }

            // Add remove event to initial button
            const initialRemoveBtn = document.querySelector('.remove-student-btn');
            if (initialRemoveBtn) {
                initialRemoveBtn.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            }
        });
    </script>
    @endpush
@endsection
