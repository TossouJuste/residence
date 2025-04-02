<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_suivi',
        'cabine_id',
        'est_valide',
        'caissiere_id'
    ];

    /**
     * Relation avec la demande
     */
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'code_suivi', 'code_suivi');
    }

    /**
     * Relation avec la cabine
     */
    public function cabine()
    {
        return $this->belongsTo(Cabine::class);
    }

    /**
     * Relation avec la caissière (User)
     */
    public function caissiere()
    {
        return $this->belongsTo(User::class, 'caissiere_id');
    }
}
