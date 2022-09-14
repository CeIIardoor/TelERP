<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonnement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function forfait()
    {
        return $this->belongsTo(Forfait::class);
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function scopeFilterOnlyTrashed($query)
    {
        return $query->onlyTrashed();
    }
}
