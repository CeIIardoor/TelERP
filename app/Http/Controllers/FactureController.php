<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use App\Models\Organisation;
use App\Models\Facture;
use Auth;
use Redirect;
use Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use PDF;
use DB;
use Excel;
use App\Exports\FacturesExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use App\Imports\FacturesImport;


class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id){
        $abonnement = Abonnement::findOrFail($id);
        return Inertia::render('Factures/Index', [
            'abonnement' => [
                'id' => $abonnement->id,
                'n_client' => $abonnement->n_client,
                'nom' => $abonnement->nom,
                'prenom' => $abonnement->prenom,
                'mensualite' => $abonnement->mensualite,
                'ville' => $abonnement->ville,
                'CIN' => $abonnement->CIN,
                'derniere_affectation' => $abonnement->derniere_affectation,
                'dernier_grade' => $abonnement->dernier_grade,
                'gestionnaire' => $abonnement->gestionnaire,
                'derniere_province' => $abonnement->derniere_province,
                'organisation' => [
                    'id' => $abonnement->organisation->id ?? 0,
                    'intitule' => $abonnement->organisation->intitule ?? "Non affecté",
                    'sigle' => $abonnement->organisation->sigle ?? "Ø",
                ],
            ],
            'factures' => $abonnement->factures()
                    ->latest()
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn($facture) => [
                        'id' => $facture->id,
                        'date' => $facture->date,
                        'montant_supplementaire' => $facture->montant_supplementaire,
                        'echeance' => $facture->echeance,
                        'statut' => $facture->statut,
                        'F_OHXACT' => $facture->F_OHXACT,
                        'F_CUSTCODE' => $facture->F_CUSTCODE,
                        'CUSTCODE' => $facture->CUSTCODE,
                        'DOHA' => $facture->DOHA,
                        'ND_SUP' => $facture->ND_SUP,
                        'LOGIN' => $facture->LOGIN,
                        'REF_FACT' => $facture->REF_FACT,
                        'PRODUIT' => $facture->PRODUIT,
                        'PL_TAR' => $facture->PL_TAR,
                        'DR' => $facture->DR,
                        'F21' => $facture->F21,
                        'F22' => $facture->F22,
                        'F23' => $facture->F23,
                        'intrus' => $facture->intrus,
                        'justif' => $facture->justif,
                        'CMOTIF_RS' => $facture->CMOTIF_RS,
                    ]),
            ]);
    }

    public function download($id){
        $facture = Facture::findOrFail($id);
        $abonnement = Abonnement::findOrFail($facture->abonnement_id);
        $forfait = DB::table('forfaits')->where('id', $abonnement->forfait_id)->first();
        $organisation = Organisation::findOrFail($abonnement->organisation_id);

        $pdf = PDF::loadView('Facture', compact('facture', 'abonnement', 'organisation', 'forfait'));

        return $pdf->download('Facture '.$facture->CUSTCODE.'.pdf');
    }

    public function exportxlsx($id){
        $abonnement = Abonnement::findOrFail($id);
        return Excel::download(new FacturesExport($id), 'Factures '.$abonnement->n_client.'.xlsx');
    }

    public function importxlsx($id){
        $abonnement = Abonnement::findOrFail($id);
        $file = Request::file('fichierfactures');
        if($file == null){
            return Redirect::back()->with('error', 'Veuillez choisir un fichier');
        }
        $extension = $file->getClientOriginalExtension();
        if($extension == 'xlsx'){
            $data = Excel::toArray(new FacturesImport, $file);
            $data = $data[0];
            $data = array_slice($data, 1);
            foreach($data as $facture){
                $facture = array_combine(['date', 'montant_supplementaire', 'echeance', 'statut', 'F_OHXACT', 'F_CUSTCODE', 'CUSTCODE'], $facture);
                $facture['abonnement_id'] = $id;
                $facture['montant_supplementaire'] = $facture['montant_supplementaire'] == null ? 0 : $facture['montant_supplementaire'];
                Facture::create($facture);
            }
            return Redirect::back()->with('success', 'Factures importées avec succès');
        }else{
            return Redirect::back()->with('error', 'Le fichier doit être au format xlsx');
        }
    }

    public function destroy(facture $facture)
    {
        $facture->delete();
        return Redirect::back()->with('success', 'Facture supprimée avec succès.');
    }
}
