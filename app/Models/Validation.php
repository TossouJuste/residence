<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    protected $fillable = [
        'classement_id',
        'num_quittance',
        'photo_quittance',
        'validation_quittance',
        'num_recu_loyer',
        'photo_recu_loyer', 
        'photo_identite', 
        'validation_cb',
    ];

    // Relation avec Classement
    public function classement()
    {
        return $this->belongsTo(Classement::class);
    }
}
