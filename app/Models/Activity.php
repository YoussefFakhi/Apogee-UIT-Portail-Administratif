<?php


// app/Models/Activity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id', 'type', 'data'];

    protected $casts = [
        'data' => 'array',
        'created_at' => 'datetime:d/m/Y H:i'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDescriptionAttribute()
    {
        $types = [
            'inscription' => 'Demande d\'inscription année antérieure',
            'compte' => 'Demande de compte fonctionnel APOGEE',
            'resultat_etudiant' => 'Insertion résultat étudiant',
            'resultat_module' => 'Insertion résultat module'
        ];

        return $types[$this->type] ?? 'Activité inconnue';
    }
}
