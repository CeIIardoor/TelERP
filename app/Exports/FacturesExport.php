<?php

namespace App\Exports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;

class FacturesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function collection()
    {
        $factures = Facture::where('abonnement_id', $this->id)->get(['date', 'montant_supplementaire', 'echeance', 'statut', 'F_OHXACT', 'F_CUSTCODE', 'CUSTCODE']);
        $factures->map(function($facture) {
            $facture->date = Carbon::parse($facture->date)->format('d-m-Y');
            $facture->echeance = Carbon::parse($facture->echeance)->format('d-m-Y');
            return $facture;
        });
        $factures->prepend(['Date', 'Montant Supplementaire', 'Echéance', 'Statut', 'F_OHXACT', 'F_CUSTCODE', 'CUSTCODE']);
        return $factures;
    }
}
