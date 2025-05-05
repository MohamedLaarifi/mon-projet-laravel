<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandeDevis extends Model
{
    use HasFactory;

    protected $table = 'demande_devis';

    protected $fillable = [
        'typeService', 'detailsProjet', 'budgetEstime', 'datelimite', 'client_id', 'admin_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function offres()
    {
        return $this->belongsToMany(OffreERP::class, 'demande_devis_offre', 'demande_devis_id', 'offre_id');
    }
}

