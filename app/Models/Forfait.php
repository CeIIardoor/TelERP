<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forfait extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function abonnements()
    {
        return $this->belongsToMany(Abonnement::class);
    }
}
