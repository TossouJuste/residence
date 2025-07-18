<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    // Champs autorisés à être remplis
    protected $fillable = [
        'nom',
        'type',
    ];

    /**
     * Relation : Un établissement peut avoir plusieurs demandes.
     */
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
