<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseUac extends Model
{
    protected $fillable = ['matricule', 'nom', 'prenom', 'email_uac'];

    public function verificationMatricules()
    {
        return $this->hasMany(VerificationMatricule::class);
    }
}

