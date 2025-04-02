<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes';

    protected $fillable = [
        'planification_id', // Ajout de la clé étrangère
        'nom', 'prenom', 'telephone', 'email', 'date_naissance',
        'lieu_naissance', 'domicile', 'etablissement', 'filiere',
        'annee_etude', 'fiche_inscription', 'sexe', 'nationalite', 'adresse_personnelle',
        'statut_aide', 'salarie', 'ancien_resident', 'batiments',
        'redoublant', 'adresse_residence_parents', 'handicap',
        'type_handicap', 'certificat_handicap', 'code_suivi', 'statut'
    ];

    // Casting des champs boolean pour éviter les erreurs
    protected $casts = [ 
        'salarie' => 'boolean',
        'ancien_resident' => 'boolean',
        'redoublant' => 'boolean',
        'handicap' => 'boolean',
    ];

    // Relation avec Planification
    public function planification()
    {
        return $this->belongsTo(Planification::class);
    }

    // Relation avec Classement (une demande acceptée peut être classée)
    public function classement()
    {
        return $this->hasOne(Classement::class, 'code_suivi', 'code_suivi');
    }

}
