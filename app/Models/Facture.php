<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'montant_supplementaire',
        'echeance',
        'statut',
        'F_OHXACT',
        'F_CUSTCODE',
        'CUSTCODE',
        'abonnement_id',
    ];

    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class, 'abonnement_id');
    }
}
