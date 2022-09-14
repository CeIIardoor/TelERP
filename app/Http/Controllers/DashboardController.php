<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\Facture;
use App\Models\Organisation;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $forfaitsfixe = Abonnement::with('forfait')->whereHas('forfait', function ($query) {
            $query->where('type', 'Fixe');
        })->count();
        $forfaitsmobile = Abonnement::with('forfait')->whereHas('forfait', function ($query) {
            $query->where('type', 'Mobile');
        })->count();
        $forfaitsinternet = Abonnement::with('forfait')->whereHas('forfait', function ($query) {
            $query->where('type', 'Internet');
        })->count();

        $factures = Facture::all();
        $organisations = Organisation::all();
        $abonnements = Abonnement::all();

        return Inertia::render('Dashboard', [
            'forfaitsfixe' => $forfaitsfixe,
            'forfaitsmobile' => $forfaitsmobile,
            'forfaitsinternet' => $forfaitsinternet,
            'factures' => $factures,
            'organisations' => $organisations,
            'abonnements' => $abonnements,
        ]);
    }
}
