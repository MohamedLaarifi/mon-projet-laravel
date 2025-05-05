<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffreERP extends Model
{
    use HasFactory;

    protected $table = 'offres';

    protected $fillable = [
        'nomOffre', 'prixOffre', 'description', 'admin_id'
    ];

    public function demandes()
    {
        return $this->belongsToMany(DemandeDevis::class, 'demande_devis_offre_e_r_p');
    }
    public function admin()
{
    return $this->belongsTo(Admin::class);
}

}

