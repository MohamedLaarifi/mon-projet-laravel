<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = ['nomAdmin', 'emailAdmin', 'password'];
    protected $hidden = ['password'];

    public function demandes()
    {
        return $this->hasMany(DemandeDevis::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function offres()
    {
        return $this->hasMany(OffreERP::class);
    }
}
