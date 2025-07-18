<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
     use HasFactory;

    protected $fillable = [
        'classement_id',
        'montant',
        'reference'
    ];

    /**
     * Relation avec la classement
     */
    public function classement()
    {
        return $this->belongsTo(Classement::class);
    }
}
