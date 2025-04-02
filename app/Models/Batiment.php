<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'nbr_cabine','sexe', 'description', 'city_id'];

    // Relation avec la table City
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relation avec Cabines (un bâtiment a plusieurs cabines)
    public function cabines()
    {
        return $this->hasMany(Cabine::class);
    }
}
