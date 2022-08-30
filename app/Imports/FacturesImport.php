<?php

namespace App\Imports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\ToModel;

class FacturesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // protected $id;

    // function __construct($id) {
    //     $this->id = $id;
    // }

    public function model(array $row)
    {
        return new Facture([
            'date' => $row[0],
            'montant_supplementaire' => $row[1],
            'echeance' => $row[2],
            'statut' => $row[3],
            'F_OHXACT' => $row[4],
            'F_CUSTCODE' => $row[5],
            'CUSTCODE' => $row[6],
        ]);
    }
}
