<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeDevis;
use App\Models\OffreERP;
use App\Models\Contact;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function stats(Request $request)
    {
        $from = $request->input('from') ? Carbon::parse($request->input('from'))->startOfDay() : null;
        $to = $request->input('to') ? Carbon::parse($request->input('to'))->endOfDay() : null;

        // Filtres appliqués
        $demandeQuery = DemandeDevis::query();
        $offreQuery = OffreERP::query();
        $contactQuery = Contact::query();

        if ($from && $to) {
            $demandeQuery->whereBetween('created_at', [$from, $to]);
            $offreQuery->whereBetween('created_at', [$from, $to]);
            $contactQuery->whereBetween('created_at', [$from, $to]);
        }

        return response()->json([
            'demandes' => $demandeQuery->count(),
            'offres' => $offreQuery->count(),
            'contacts' => $contactQuery->count(),

            // Pour les graphiques
            'demandes_par_jour' => $demandeQuery->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get(),

            'contacts_par_jour' => $contactQuery->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
        ]);
    }
}
