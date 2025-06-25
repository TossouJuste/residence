<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes';

    protected $fillable = [
        'code_suivi',
        'statut_demande',
        'annee_etude',
        'filiere',
        'fiche_preinscription',
        'etudiant_matricule',
        'etablissement_id',
        'planification_id',
    ];


    /**
     * Une demande appartient à un étudiant.
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_matricule', 'matricule');
    }

    /**
     * Une demande appartient à un établissement.
     */
    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    /**
     * Une demande appartient à une planification.
     */
    public function planification()
    {
        return $this->belongsTo(Planification::class);
    }

    public function classement()
    {
        return $this->hasOne(Classement::class, 'code_suivi', 'code_suivi');
    }
}
