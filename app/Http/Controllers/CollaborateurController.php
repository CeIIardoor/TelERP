<?php

namespace App\Http\Controllers;

use App\Models\Collaborateur;
use App\Models\Organisation;
use Auth;
use Redirect;
use Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CollaborateurController extends Controller
{
    public function index()
    {
        return Inertia::render('Collaborateur/Index', [
            'collaborateurs' => Collaborateur::query()
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
                ->paginate(10)
                ->withQueryString()
                ->through(fn($collaborateur) => [
                    'id' => $collaborateur->id,
                    'n_client' => $collaborateur->n_client,
                    'nom' => $collaborateur->nom,
                    'prenom' => $collaborateur->prenom,
                    'ville' => $collaborateur->ville,
                    'CIN' => $collaborateur->CIN,
                    'derniere_affectation' => $collaborateur->derniere_affectation,
                    'dernier_grade' => $collaborateur->dernier_grade,
                    'gestionnaire' => $collaborateur->gestionnaire,
                    'derniere_province' => $collaborateur->derniere_province,
                    'organisation' => [
                        'id' => $collaborateur->organisation->id ?? 0,
                        'intitule' => $collaborateur->organisation->intitule ?? "Non affecté",
                        'sigle' => $collaborateur->organisation->sigle ?? "NULL",
                    ],
                ]),
            'filters' => Request::only('search'),
            'orgs' => Organisation::all(),
            ]);
    }

    public function create()
    {
        return Inertia::render('Collaborateur/Create');
    }

    public function store()
    {
        Collaborateur::create(
            Request::validate([
                'prenom' => ['required', 'max:50'],
                'nom' => ['required', 'max:50'],
                'organisation_id' => ['nullable', Rule::exists('organisations', 'id')->where(function ($query) {
                    $query->where('account_id', Auth::user()->account_id);
                })],
                'derniere_affectation' => ['nullable', 'max:100'],
                'ville' => ['nullable', 'max:50'],
                'CIN' => ['nullable', 'max:20'],
                'dernier_grade' => ['nullable', 'max:100'],
                'gestionnaire' => ['nullable', 'max:100'],
            ])
        );

        return Redirect::route('collaborateurs')->with('success', 'Collaborateur créé.');
    }

    public function update(Collaborateur $collaborateur)
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

        $collaborateur->update($attributes);

        return Redirect::back()->with('success', 'Collaborateur mis à jour.');
    }

    public function delete(Collaborateur $collaborateur)
    {
        $collaborateur->delete();

        return Redirect::back()->with('error', 'Collaborateur supprimé.');
    }

    public function restore(Collaborateur $collaborateur)
    {
        $collaborateur->restore();

        return Redirect::back()->with('success', 'Collaborateur restauré.');
    }

    public function destroy(Collaborateur $collaborateur)
    {
        $collaborateur->destroy();
        
        return Redirect::back()->with('success', 'Collaborateur supprimé de la corbeille.');
    }
}
