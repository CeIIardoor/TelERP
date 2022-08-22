<?php

namespace App\Http\Controllers;


use App\Models\Abonnement;
use App\Models\Organisation;
use Auth;
use Redirect;
use Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

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
                        'statut' => $facture->statut,
                    ]),
            ]);
    }

    public function destroy(facture $facture)
    {
        $facture->delete();
        return Redirect::route('facture.index', $facture->abonnement_id)->with('success', 'Facture supprimée avec succès.');
    }
}
