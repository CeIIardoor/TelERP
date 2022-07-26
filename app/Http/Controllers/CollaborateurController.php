<?php

namespace App\Http\Controllers;

use App\Models\Collaborateur;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
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
                    'organisation' => [
                        'id' => $collaborateur->organisation->id ?? null,
                        'intitule' => $collaborateur->organisation->intitule ?? "Non affecté",
                        'sigle' => $collaborateur->organisation->sigle ?? "",
                    ],
                ]),
            'filters' => Request::only('search'),
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

    public function edit(Collaborateur $collaborateur)
    {
        return Inertia::render('Collaborateur/Edit', [
            'collaborateur' => [
                'id' => $collaborateur->id,
                'prenom' => $collaborateur->prenom,
                'nom' => $collaborateur->nom,
                'organisation_id' => $collaborateur->organisation_id,
                'derniere_affectation' => $collaborateur->derniere_affectation,
                'ville' => $collaborateur->ville,
                'CIN' => $collaborateur->CIN,
                'dernier_grade' => $collaborateur->dernier_grade,
                'gestionnaire' => $collaborateur->gestionnaire,
                'deleted_at' => $collaborateur->deleted_at,
            ],
            'organisations' => Organisation::where('collaborateur_id', $collaborateur->id)->get()
                ->orderBy('intitule')
                ->get()
                ->map
                ->only('id', 'intitule'),
        ]);
    }

    public function update(Collaborateur $collaborateur)
    {
        $collaborateur->update(
            Request::validate([
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
            ])
        );

        return Redirect::back()->with('success', 'Collaborateur mis à jour.');
    }

    public function destroy(Collaborateur $collaborateur)
    {
        $collaborateur->delete();

        return Redirect::back()->with('success', 'Collaborateur supprimé.');
    }

    public function restore(Collaborateur $collaborateur)
    {
        $collaborateur->restore();

        return Redirect::back()->with('success', 'Collaborateur restauré.');
    }
}