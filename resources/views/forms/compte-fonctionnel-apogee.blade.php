@extends('layouts.app')

@section('title', 'Compte fonctionnel apogee')

@section('breadcrumbs')
    {{-- @include('components.breadcrumbs') --}}
    <div class="breadcrumb-container">
        <div class="breadcrumb-content">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">>Home</a>
                <a href="{{ url('/compte-fonctionnel-apogee') }}">>Compte Fonctionnel Apogée</a>

            </div>
        </div>
    </div>
@endsection

@section('content')
            @include('components.quick-access')


            <div class="form-container">
                <h2>Demande d'ouverture ou de modification d'un compte APOGEE</h2>

                <form id="compteForm" action="{{ route('generate.compte.pdf') }}" method="POST">
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
                        <label>Nature de la demande</label>
                        <input type="text" name="demNTR" required>
                    </div>

                    <div class="form-group">
                        <label>Nom et Prénom du demandeur</label>
                        <input type="text" name="nomPrenomUser" required>
                    </div>

                    <div class="form-group">
                        <label>Nom d'utilisateur APOGEE</label>
                        <input type="text" name="userName" required>
                    </div>

                    <div class="form-group">
                        <label>Fonction</label>
                        <input type="text" name="fonction" required>
                    </div>

                    <h4 class="small-section">Centres</h4>

                    <div class="form-group">
                        <label>Centre de gestion</label>
                        <input type="text" name="strg1" required>
                    </div>

                    <div class="form-group">
                        <label>Centre de traitement</label>
                        <input type="text" name="strg2" required>
                    </div>

                    <div class="form-group">
                        <label>Centre d'inscription pédagogique</label>
                        <input type="text" name="strg3" required>
                    </div>

                    <div class="form-group">
                        <label>Centre d'incompatibilité</label>
                        <input type="text" name="strg4" required>
                    </div>

                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" name="tele" required>
                    </div>

                    <div class="form-group">
                        <label>Adresse MAC de l'ordinateur</label>
                        <input type="text" name="mac" required>
                    </div>

                    <h4 class="small-section">Privilèges du Compte Utilisateur d'APOGEE</h4>

                    <div class="vertical-checkbox-group">
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p1" value="✅">
                            Inscription Administrative
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p2" value="✅">
                            Inscription Pédagogique
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p3" value="✅">
                            Résultat
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p4" value="✅">
                            Structure des enseignements
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p5" value="✅">
                            Dossier Étudiant
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p6" value="✅">
                            Modalités de contrôle des connaissances
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p7" value="✅">
                            Épreuves
                        </label>
                    </div>

                    <h4 class="small-section">Accès aux fonctionnalités réservées au responsable APOGÉE</h4>

                    <div class="vertical-checkbox-group">
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p8" value="✅">
                            T (Ouverture et Fermeture de la session)
                        </label>
                        <label class="vertical-checkbox">
                            <input type="checkbox" name="p9" value="✅">
                            A
                        </label>
                    </div>

                    <button type="submit" class="submit-btn">Générer le PDF</button>
                </form>
            </div>

            <div id="loadingScreen">
                <div class="spinner"></div>
                <p class="loading-text">Génération du PDF en cours, veuillez patienter...</p>
            </div>


    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('compteForm');
            const loadingScreen = document.getElementById('loadingScreen');



            function showLoading() {
                loadingScreen.style.display = 'flex';
            }

            function hideLoading() {
                loadingScreen.style.display = 'none';
            }
        });


        //profile
            document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('compteForm');
            const loadingScreen = document.getElementById('loadingScreen');

            if (form) {
                form.addEventListener('submit', function() {
                    // showLoading();
                });
            }

            function showLoading() {
                if (loadingScreen) loadingScreen.style.display = 'flex';
            }
        });
    </script>
    @endpush
@endsection
