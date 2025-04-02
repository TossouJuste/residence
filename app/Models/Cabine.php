<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabine extends Model
{
    use HasFactory;

    // Les attributs pouvant être assignés en masse
    protected $fillable = [
        'code',
        'batiment_id',  
        'places_disponibles'
    ];

    // Relation avec Batiment (une cabine appartient à un bâtiment)
    public function batiment()
    {
        return $this->belongsTo(Batiment::class);
    }

    // Relation avec Classement (une cabine a plusieurs classements)
    public function classements()
    {
        return $this->hasMany(Classement::class);
    }
}
