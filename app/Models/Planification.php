<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Ajout du soft delete
use Carbon\Carbon;

class Planification extends Model
{
    use HasFactory, SoftDeletes; // Utilisation du soft delete

    protected $fillable = [
        'annee_academique_id',
        'date_debut',
        'date_fin',
        'statut',
        'description',
        'cree_par',
    ];
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    protected $dates = ['date_debut', 'date_fin', 'deleted_at']; // Gestion automatique des dates

    // Relation avec l'année académique
    public function anneeAcademique()
    {
        return $this->belongsTo(AnneeAcademique::class);
    }

    // Relation avec l'utilisateur (intendant qui crée la planification)
    public function createur()
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    // Relation avec les demandes
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    // Formatage des dates (ex: 12/03/2025)
    public function getDateDebutFormattedAttribute()
    {
        return Carbon::parse($this->date_debut)->format('d/m/Y');
    }

    public function getDateFinFormattedAttribute()
    {
        return Carbon::parse($this->date_fin)->format('d/m/Y');
    }
}
