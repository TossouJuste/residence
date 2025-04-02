<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Définir les champs qui peuvent être remplis massivement
    protected $fillable = ['nom', 'nbr_batiment', 'description'];

     // Relation avec Batiments (une ville a plusieurs bâtiments)
     public function batiments()
     {
         return $this->hasMany(Batiment::class);
     }
    // Spécifier la table associée (si elle diffère de la convention par défaut)
    // protected $table = 'cities';
}
