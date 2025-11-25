@extends('layouts.app4')

@section('title', 'Profil Utilisateur')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar" id="userAvatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="profile-info">
            <h2 id="userName">{{ $user->name }}</h2>
            <p id="userEmail">{{ $user->email }}</p>
        </div>
    </div>

    <div class="profile-card">
        <h3><i class="ri-information-line"></i> Informations Personnelles</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $user->email }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Nom Complet:</span>
                <span class="info-value">{{ $user->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Établissement:</span>
                <span class="info-value">
                    @isset($user->school)
                        {{ $user->school->name }} ({{ $user->school->code }})
                    @else
                        Non spécifié
                    @endisset
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Fonction:</span>
                <span class="info-value">{{ $user->fonction ?? 'Non spécifié' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Téléphone:</span>
                <span class="info-value">{{ $user->tele ?? 'Non spécifié' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Nom d'utilisateur APOGEE:</span>
                <span class="info-value">{{ $user->userName ?? 'Non spécifié' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Adresse MAC:</span>
                <span class="info-value">{{ $user->mac ?? 'Non spécifié' }}</span>
            </div>
        </div>
    </div>

    <div class="profile-card">
        <h3><i class="ri-shield-user-line"></i> Privilèges</h3>
        <div class="privileges-grid">
            @foreach (range(1, 9) as $i)
                @if ($user->{'p'.$i})
                <div class="privilege-item">
                    <span class="privilege-badge">P{{ $i }}</span>
                    <span class="privilege-check">✅</span>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="profile-card">
        <h3><i class="ri-history-line"></i> Dernières Activités</h3>
        @if($activities->count() > 0)
            <div class="activities-list">
                @foreach($activities as $activity)
                    <div class="activity-item">
                        <i class="ri-file-text-line activity-icon"></i>
                        <div class="activity-content">
                            <strong class="activity-title">{{ $activity->description }}</strong>
                            <small class="activity-time">{{ $activity->created_at->diffForHumans() }}</small>
                            @if(!empty($activity->data))
                                <div class="activity-details">
                                    @foreach($activity->data as $key => $value)
                                        <span class="detail-item">
                                            <span class="detail-label">{{ ucfirst($key) }}:</span>
                                            <span class="detail-value">
                                                @if(is_array($value))
                                                    {{ count($value) }}
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </span>
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="activity-placeholder">
                <i class="ri-time-line"></i>
                <p>Aucune activité récente</p>
            </div>
        @endif
    </div>

    <div class="profile-actions">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="ri-logout-circle-r-line"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

<style>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 1.5rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #eee;
}

.profile-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #34197e;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-right: 1.5rem;
}

.profile-info h2 {
    margin: 0;
    color: #333;
    font-size: 1.5rem;
}

.profile-info p {
    margin: 0.25rem 0 0;
    color: #666;
}

.profile-card {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    background: #f9f9f9;
    border-radius: 8px;
}

.profile-card h3 {
    margin-top: 0;
    margin-bottom: 1rem;
    color: #34197e;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
}

.info-label {
    font-weight: 500;
    color: #555;
    font-size: 0.9rem;
}

.info-value {
    color: #222;
    font-weight: 500;
}

.privileges-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 0.75rem;
}

.privilege-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.privilege-badge {
    background: #e0e0ff;
    color: #34197e;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.85rem;
}

/* Activities Section Styles */
.activities-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.activity-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 12px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.activity-icon {
    font-size: 1.2rem;
    color: #34197e;
    margin-top: 2px;
}

.activity-content {
    flex: 1;
}

.activity-title {
    display: block;
    color: #333;
    margin-bottom: 4px;
}

.activity-time {
    color: #666;
    font-size: 0.85rem;
}

.activity-details {
    margin-top: 8px;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.detail-item {
    background: #f0f0f0;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.85rem;
}

.detail-label {
    font-weight: 500;
    color: #555;
}

.detail-value {
    color: #222;
}

.activity-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.5rem;
    color: #888;
}

.activity-placeholder i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.profile-actions {
    display: flex;
    justify-content: flex-end;
}

.logout-btn {
    background: #f8f9fa;
    color: #dc3545;
    border: 1px solid #dc3545;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
}

.logout-btn:hover {
    background: #dc3545;
    color: white;
}

@media (max-width: 768px) {
    .profile-container {
        padding: 1rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .activity-details {
        flex-direction: column;
        gap: 4px;
    }
}
</style>
@endsection
