@extends('layouts.app2')

@section('title', 'Demande de Compte APOGEE')

@section('content')
<div class="form-container">

    <!-- Display validation errors -->
    @if ($errors->any())
        <center><div class="alert alert-danger" style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div></center>
    @endif

    <div class="form-title-container">
        <i class="ri-user-line form-title-icon"></i>
        <span class="form-title-text">login compte APOGEE</span>
    </div>

    <form id="compteForm" method="POST" action="/registrationp">
        @csrf

        <!-- School Selection -->
        <div class="form-group">
            <label>Etablissement</label>
            <select name="school_id" required>
                <option value="">Sélectionnez un établissement</option>
                @foreach(App\Models\School::all() as $school)
                    <option value="{{ $school->id }}"
                        @if(old('school_id', Auth::user()->school_id ?? '') == $school->id) selected @endif>
                        {{ $school->name }} ({{ $school->code }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Name and Email (Extracted from email) -->
        <div class="form-row">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text"
                       value="{{ session('prenom') ?? (Auth::user() ? explode(' ', Auth::user()->name)[0] : '') }}"
                       readonly
                       class="locked-field">
                <input type="hidden" name="prenom" value="{{ session('prenom') ?? (Auth::user() ? explode(' ', Auth::user()->name)[0] : '') }}">
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input type="text"
                       value="{{ session('nom') ?? (Auth::user() ? (explode(' ', Auth::user()->name)[1] ?? '') : '') }}"
                       readonly
                       class="locked-field">
                <input type="hidden" name="nom" value="{{ session('nom') ?? (Auth::user() ? (explode(' ', Auth::user()->name)[1] ?? '') : '') }}">
            </div>
        </div>

        <!-- Locked Email Field -->
        <div class="form-group">
            <label>Email</label>
            <input type="email"
                   name="emailUser"
                   value="{{ session('email') ?? (Auth::user()->email ?? '') }}"
                   required
                   readonly
                   class="locked-field">
        </div>

        <!-- Function and Phone -->
        <div class="form-row">
            <div class="form-group">
                <label>Fonction</label>
                <input type="text" name="fonction"
                       value="{{ old('fonction', Auth::user()->fonction ?? '') }}"
                       required>
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="tel" name="tele"
                       value="{{ old('tele', Auth::user()->tele ?? '') }}"
                       required>
            </div>
        </div>

        <!-- Required Fields -->
        <div class="form-group">
            <label>Nom d'utilisateur APOGEE</label>
            <input type="text" name="userName"
                   value="{{ old('userName', Auth::user()->userName ?? '') }}"
                   required>
        </div>

        <div class="form-group">
            <label>Adresse MAC</label>
            <input type="text" name="mac"
                   value="{{ old('mac', Auth::user()->mac ?? '') }}"
                   placeholder="Format: 00:1A:2B:3C:4D:5E" required>
        </div>

        <!-- Centers (Required) -->
        <h3 class="section-title">Centres</h3>
        <div class="form-row">
            <div class="form-group">
                <label>Centre de gestion</label>
                <input type="text" name="strg1"
                       value="{{ old('strg1', Auth::user()->strg1 ?? '') }}"
                       required>
            </div>
            <div class="form-group">
                <label>Centre de traitement</label>
                <input type="text" name="strg2"
                       value="{{ old('strg2', Auth::user()->strg2 ?? '') }}"
                       required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Centre d'inscription pédagogique</label>
                <input type="text" name="strg3"
                       value="{{ old('strg3', Auth::user()->strg3 ?? '') }}"
                       required>
            </div>
            <div class="form-group">
                <label>Centre d'incompatibilité</label>
                <input type="text" name="strg4"
                       value="{{ old('strg4', Auth::user()->strg4 ?? '') }}"
                       required>
            </div>
        </div>

        <!-- Privileges Section -->
        <h3 class="section-title">Privilèges du Compte Utilisateur d'APOGEE</h3>
        <div class="privileges-grid">
            @foreach([
                'p1' => 'Inscription Administrative',
                'p2' => 'Inscription Pédagogique',
                'p3' => 'Résultat',
                'p4' => 'Structure des enseignements',
                'p5' => 'Dossier Étudiant',
                'p6' => 'Modalités de contrôle des connaissances',
                'p7' => 'Épreuves'
            ] as $field => $label)
                <label class="checkbox-option">
                    <input type="checkbox" name="{{ $field }}" value="1"
                        {{ old($field, Auth::user()->{$field} ?? false) ? 'checked' : '' }}>
                    {{ $label }}
                </label>
            @endforeach
        </div>

        <h3 class="section-title">Accès aux fonctionnalités réservées au responsable APOGÉE</h3>
        <div class="privileges-grid">
            @foreach([
                'p8' => 'T (Ouverture et Fermeture de la session)',
                'p9' => 'A'
            ] as $field => $label)
                <label class="checkbox-option">
                    <input type="checkbox" name="{{ $field }}" value="1"
                        {{ old($field, Auth::user()->{$field} ?? false) ? 'checked' : '' }}>
                    {{ $label }}
                </label>
            @endforeach
        </div>

        <div class="form-actions">
            <button type="submit" class="submit-btn">
                <i class="ri-file-download-line"></i> Enregistrer le profil APOGEE
            </button>
        </div>
    </form>
</div>

<style>
.locked-field {
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    cursor: not-allowed;
    color: #555;
}
.privileges-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 12px;
    margin: 15px 0;
}
/* .checkbox-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px;
    border-radius: 4px;
    background: #851c1c;
} */
.section-title {
    margin: 20px 0 10px;
    color: #34197e;
    font-size: 1.1rem;
}


.readonly-email {
        background-color: #f5f5f5;
        cursor: not-allowed;
        color: #555;
    }
</style>
@endsection
