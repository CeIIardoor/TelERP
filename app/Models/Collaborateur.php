<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborateur extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'n_client',
        'nom',
        'prenom',
        'ville',
        'CIN',
        'derniere_affectation',
        'dernier_grade',
        'gestionnaire',
        'derniere_province',
        'organisation_id',
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('nom')->orderBy('prenom');
    }
}
