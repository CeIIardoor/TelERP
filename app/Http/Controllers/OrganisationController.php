<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Auth;
use Redirect;
use Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class OrganisationController extends Controller
{
    public function index()
    {
        return Inertia::render('Organisation/Index', [
            'organisations' => Organisation::query()
            ->when(Request::input('search'), function ($query, $search) {
                    $query->where('intitule', 'like', "%{$search}%")
                        ->orWhere('sigle', 'like', "%{$search}%")
                        ->orWhere('ville', 'like', "%{$search}%")
                        ->orWhere('region', 'like', "%{$search}%")
                        ->orWhere('code_postal', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('code_postal', 'like', "%{$search}%")
                        ->orWhere('adresse', 'like', "%{$search}%");
                })->latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($organisation) => [
                    'id' => $organisation->id,
                    'intitule' => $organisation->intitule,
                    'sigle' => $organisation->sigle,
                    'region' => $organisation->region,
                    'ville' => $organisation->ville,
                    'email' => $organisation->email,
                    'code_postal' => $organisation->code_postal,
                    'adresse' => $organisation->adresse,
                ]),
            'filters' => Request::only('search'),
            'orgs' => Organisation::all(),
            ]);
    }

    public function create()
    {
        return Inertia::render('Organisation/Create');
    }

    public function store()
    {
        Organisation::create(
            Request::validate([
                'intitule' => ['required', 'max:50'],
                'sigle' => ['required', 'max:50'],
                'region' => ['required', 'max:50'],
                'ville' => ['required', 'max:50'],
                'email' => ['required', 'max:50'],
                'code_postal' => ['required', 'max:50'],
                'adresse' => ['required', 'max:100'],
            ])
        );

        return Redirect::route('organisation')->with('success', 'Organisation créé.');
    }

    public function update(Organisation $organisation)
    {
        $attributes = Request::validate([
            'intitule' => ['required', 'max:50'],
            'sigle' => ['required', 'max:50'],
            'region' => ['required', 'max:50'],
            'ville' => ['required', 'max:50'],
            'email' => ['required', 'max:50'],
            'code_postal' => ['required', 'max:50'],
            'adresse' => ['required', 'max:100'],
        ]);

        $organisation->update($attributes);

        return Redirect::back()->with('success', 'Organisation mis à jour.');
    }

    public function delete(Organisation $organisation)
    {
        $organisation->delete();

        return Redirect::back()->with('error', 'Organisation supprimé.');
    }

    public function corbeille()
    {
        return Inertia::render('Organisation/Corbeille', [
            'organisations' => Organisation::query()
            ->when(Request::input('search'), function ($query, $search) {
                    $query->where('intitule', 'like', "%{$search}%")
                        ->orWhere('sigle', 'like', "%{$search}%")
                        ->orWhere('ville', 'like', "%{$search}%")
                        ->orWhere('region', 'like', "%{$search}%")
                        ->orWhere('code_postal', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('code_postal', 'like', "%{$search}%")
                        ->orWhere('adresse', 'like', "%{$search}%")
                        ->filterOnlyTrashed();
                })
                ->onlyTrashed()
                ->latest()
                ->paginate(10)
                ->withQueryString()
                ->through(fn($organisation) => [
                    'id' => $organisation->id,
                    'intitule' => $organisation->intitule,
                    'sigle' => $organisation->sigle,
                    'region' => $organisation->region,
                    'ville' => $organisation->ville,
                    'email' => $organisation->email,
                    'code_postal' => $organisation->code_postal,
                    'adresse' => $organisation->adresse,
                ]),
            'filters' => Request::only('search'),
            ]);
    }

    public function restore($id)
    {
        if(Auth::user()->role != 'Administrateur') {
            return Redirect::to('/organisation')->with('error', 'Vous n\'avez pas les droits pour restaurer un organisation.');
        }
        Organisation::onlyTrashed()->findOrFail($id)->restore();

        return Redirect::back()->with('success', 'Organisation restauré.');
    }

    public function destroy($id)
    {
        if(Auth::user()->role != 'Administrateur') {
            return Redirect::to('/organisation')->with('error', 'Vous n\'avez pas les droits pour supprimer définitivement un organisation.');
        }

        Organisation::onlyTrashed()->findOrFail($id)->forceDelete();

        return Redirect::back()->with('success', 'Organisation supprimé.');
    }
}
