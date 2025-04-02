<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    use HasFactory;
    protected $table = 'annees_academiques';
    protected $fillable = ['nom','date_debut','date_fin'];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];
    // Relation avec les planifications
    public function planifications()
    {
        return $this->hasMany(Planification::class);
    }
}
