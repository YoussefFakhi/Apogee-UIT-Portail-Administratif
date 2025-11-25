@extends('layouts.app3')

@section('title', 'Connexion APOGEE')

@section('content')
<div class="login-container">
    <div class="login-header">
        <h2><i class="ri-book-2-fill"></i> Connexion Portail</h2>
    </div>

    <!-- Display validation errors -->
    @if ($errors->any())
        <center><div class="alert alert-danger" style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </center>
    @endif

    <form method="POST" id="loginForm" action="{{ route('login.submit') }}">
        @csrf
        <div class="login-body">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="email@universite.com" required
                       value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password"
                    class="form-control" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">
                    <i class="ri-login-box-line"></i> Se connecter
                </button>
            </div>
        </div>
    </form>

    <div class="login-footer">
        <a href="#"><i class="ri-lock-password-line"></i> Mot de passe oublié ?</a>
    </div>
</div>
@endsection

<style>
/* Optimized Compact Login Form */
.login-container {
    width: 100%;
    max-width: 380px;
    margin: 60px auto 30px;
    background: #1a1a1a;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 12px rgba(0,0,0,0.25);
}

.login-header {
    background: #34197e;
    padding: 1.1rem;
    text-align: center;
}

.login-header h2 {
    color: white;
    margin: 0;
    font-size: 1.25rem;
}

.login-body {
    padding: 1.4rem;
}

.form-group {
    margin-bottom: 1.1rem;
}

.form-label {
    display: block;
    margin-bottom: 0.4rem;
    font-size: 0.88rem;
    color: #ddd;
}

.form-control {
    width: 100%;
    padding: 0.7rem 0.9rem;
    background: #2a2a2a;
    border: 1px solid #333;
    border-radius: 5px;
    color: white;
    font-size: 0.92rem;
}

.btn-login {
    width: 100%;
    padding: 0.7rem;
    background: white;
    color: #34197e;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 0.3rem;
}

.login-footer {
    padding: 0.9rem;
    text-align: center;
    font-size: 0.82rem;
    border-top: 1px solid #333;
}

.login-footer a {
    color: #aaa;
    text-decoration: none;
    transition: color 0.15s;
}

.login-footer a:hover {
    color: #ccc;
}

@media (max-width: 480px) {
    .login-container {
        margin: 40px auto 20px;
        max-width: 92%;
    }

    .login-body {
        padding: 1.2rem;
    }
}
</style>
