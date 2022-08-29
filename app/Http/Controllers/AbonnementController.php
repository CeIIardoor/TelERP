<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Organisation;
use Auth;
use Redirect;
use Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AbonnementController extends Controller
{
    public function index()
    {
        return Inertia::render('Abonnement/Index', [
            'abonnements' => Abonnement::query()
            ->when(Request::input('search'), function ($query, $search) {
                    $query->where('n_client', 'like', "%{$search}%")
                        ->orWhere('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('ville', 'like', "%{$search}%")
                        ->orWhere('CIN', 'like', "%{$search}%")
                        ->orWhereHas('organisation', function ($query) use ($search) {
                            $query->where('intitule', 'like', "%{$search}%")
                            ->orWhere('sigle', 'like', "%{$search}%");
                        });
                })->with('organisation')
                ->latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($abonnement) => [
                    'id' => $abonnement->id,
                    'n_client' => $abonnement->n_client,
                    'nom' => $abonnement->nom,
                    'prenom' => $abonnement->prenom,
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
                ]),
            'filters' => Request::only('search'),
            'orgs' => Organisation::all(),
            ]);
    }

    public function create()
    {
        return Inertia::render('Abonnement/Create',
            [
                'orgs' => Organisation::all(),
            ]);
    }

    public function store()
    {
        Abonnement::create(
            Request::validate([
                'prenom' => ['required', 'max:50'],
                'nom' => ['required', 'max:50'],
                'organisation_id' => ['nullable', Rule::exists('organisations', 'id')],
                'derniere_affectation' => ['nullable', 'max:100'],
                'ville' => ['nullable', 'max:50'],
                'CIN' => ['nullable', 'max:20'],
                'dernier_grade' => ['nullable', 'max:100'],
                'gestionnaire' => ['nullable', 'max:100'],
                'derniere_province' => ['nullable', 'max:100'],
                'n_client' => ['required', 'max:20'],
            ])
        );

        return Redirect::route('abonnement')->with('success', 'Abonnement créé.');
    }

    public function update(Abonnement $abonnement)
    {
        $attributes = Request::validate([
            'n_client' => ['required', 'max:50'],
            'nom' => ['required', 'max:50'],
            'prenom' => ['required', 'max:50'],
            'organisation_id' => [
                'nullable',
                Rule::exists('organisations', 'id'),
            ],
            'derniere_affectation' => ['nullable', 'max:100'],
            'ville' => ['nullable', 'max:50'],
            'CIN' => ['nullable', 'max:20'],
            'dernier_grade' => ['nullable', 'max:100'],
            'gestionnaire' => ['nullable', 'max:100'],
            'derniere_province' => ['nullable', 'max:100'],
        ]);

        $abonnement->update($attributes);

        return Redirect::back()->with('success', 'Abonnement mis à jour.');
    }

    public function delete(Abonnement $abonnement)
    {
        $abonnement->delete();

        return Redirect::back()->with('error', 'Abonnement supprimé.');
    }

    public function corbeille()
    {
        return Inertia::render('Abonnement/Corbeille', [
            'abonnements' => Abonnement::query()
            ->when(Request::input('search'), function ($query, $search) {
                    $query->where('n_client', 'like', "%{$search}%")
                        ->orWhere('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('ville', 'like', "%{$search}%")
                        ->orWhere('CIN', 'like', "%{$search}%")
                        ->orWhereHas('organisation', function ($query) use ($search) {
                            $query->where('intitule', 'like', "%{$search}%")
                            ->orWhere('sigle', 'like', "%{$search}%");
                        })->filterOnlyTrashed();
                })->with('organisation')
                ->onlyTrashed()
                ->latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($abonnement) => [
                    'id' => $abonnement->id,
                    'n_client' => $abonnement->n_client,
                    'nom' => $abonnement->nom,
                    'prenom' => $abonnement->prenom,
                    'ville' => $abonnement->ville,
                    'CIN' => $abonnement->CIN,
                    'derniere_affectation' => $abonnement->derniere_affectation,
                    'dernier_grade' => $abonnement->dernier_grade,
                    'gestionnaire' => $abonnement->gestionnaire,
                    'derniere_province' => $abonnement->derniere_province,
                    'deleted_at' => $abonnement->delete_at,
                    'organisation' => [
                        'id' => $abonnement->organisation->id ?? 0,
                        'intitule' => $abonnement->organisation->intitule ?? "Non affecté",
                        'sigle' => $abonnement->organisation->sigle ?? "Ø",
                    ],
                ]),
            'filters' => Request::only('search'),
            ]);
    }

    public function restore($id)
    {
        if(Auth::user()->role != 'Administrateur') {
            return Redirect::to('/abonnement')->with('error', 'Vous n\'avez pas les droits pour restaurer un abonnement.');
        }
        Abonnement::onlyTrashed()->findOrFail($id)->restore();

        return Redirect::back()->with('success', 'Abonnement restauré.');
    }

    public function destroy($id)
    {
        if(Auth::user()->role != 'Administrateur') {
            return Redirect::to('/abonnement')->with('error', 'Vous n\'avez pas les droits pour supprimer définitivement un abonnement.');
        }

        Abonnement::onlyTrashed()->findOrFail($id)->forceDelete();

        return Redirect::back()->with('success', 'Abonnement supprimé.');
    }
}
