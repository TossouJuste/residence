<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationMatricule extends Model
{
    protected $fillable = ['matricule', 'email', 'code_verification', 'base_uac_id'];

    public function baseUac()
    {
        return $this->belongsTo(BaseUac::class);
    }

    public function demande()
    {
        return $this->hasOne(Demande::class);
    }
}


