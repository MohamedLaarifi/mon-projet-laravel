<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomClient', 'emailClient', 'télé', 'société', 'adresse'
    ];

    public function demandes()
    {
        return $this->hasMany(DemandeDevis::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

