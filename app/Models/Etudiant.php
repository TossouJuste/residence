<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    protected $primaryKey = 'matricule';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'nationalite',
        'adresse_personnelle',
        'handicap',
        'type_handicap',
        'certificat_handicap',
    ];

     protected $casts = [
        'date_naissance' => 'date',
    ];

    /**
     * Un étudiant peut avoir plusieurs demandes.
     */
    public function demandes()
    {
        return $this->hasMany(Demande::class, 'etudiant_matricule', 'matricule');
    }

}
