@extends('layouts.app')

@section('title', 'ibnTofail University')

@section('breadcrumbs')
    {{-- @include('components.breadcrumbs') --}}
    <div class="breadcrumb-container">
        <div class="breadcrumb-content">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">>Home</a>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('components.quick-access')

    <h2 class="portal-title">le Portail des Demandes Administratives</h2>
    <p class="portal-subtitle">Choisissez une demande parmi les options ci-dessous :</p>

    <div class="degree-section">
        <h3 class="degree-title">Licence / Master</h3>
        <div class="degree-options">
            <a href="{{ url('/inscription-annee-anterieure') }}"> {{--done  --}}
                <div class="degree-card">
                    <i class="ri-clipboard-line"></i>
                    <span>INSCRIPTION ADMINISTRATIVE</span>
                </div>
            </a>
            <a href="{{ url('/insertion-resultat-module') }}">
                <div class="degree-card"> {{--done --}}
                    <i class="ri-file-list-line"></i>
                    <span>RÉSULTAT PAR MODULE</span>
                </div>
            </a>
            <a href="{{ url('/insertion-resultat-etudiant') }}"> {{--done  --}}
                <div class="degree-card">
                    <i class="ri-user-line"></i>
                    <span>RÉSULTAT ÉTUDIANT</span>
                </div>
            </a>
            <a href="{{ url('#') }}"> {{--404  --}}
                <div class="degree-card">
                    <i class="ri-calculator-line"></i>
                    <span>CALCUL DES NOTES</span>
                </div>
            </a>
        </div>
    </div>

    <div class="doctorat-section">
        <h3 class="doctorat-title">Doctorat</h3>
        <div class="doctorat-options">   {{--404  --}}
            <a href="{{ url('#') }}">
                <div class="doctorat-card">
                    <i class="ri-file-edit-line"></i>
                    <span>INSCRIPTION DOCTORAT</span>
                </div>
            </a>
            <a href="{{ url('#') }}">
                <div class="doctorat-card">             {{--404  --}}
                    <i class="ri-flask-line"></i>
                    <span>NOUVELLE SPÉCIALITÉ DOCTORAT</span>
                </div>
            </a>
        </div>
    </div>

    <div class="compte-section">
        <h3 class="compte-title">Compte Fonctionnel</h3>
        <div class="compte-options"> {{--done  --}}
            <a href="{{ url('/compte-fonctionnel-apogee') }}">
                <div class="compte-card">
                    <i class="ri-account-circle-line"></i>
                    <span>COMPTE FONCTIONNEL APOGÉE</span>
                </div>
            </a>
        </div>
    </div>
@endsection
