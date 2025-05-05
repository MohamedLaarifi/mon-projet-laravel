<?php

namespace App\Http\Controllers;

use App\Models\DemandeDevis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeDevisController extends Controller
{
    //  Accessible uniquement par l'admin (protégé dans les routes)
    public function index()
    {
        return DemandeDevis::with('client', 'admin', 'offres')->get();
    }

    //  Création publique
    public function store(Request $request)
{
    $data = $request->validate([
        'nomClient' => 'required|string',
        'emailClient' => 'required|email',
        'télé' => 'required|string',
        'société' => 'nullable|string',
        'adresse' => 'nullable|string',

        'typeService' => 'required|string',
        'detailsProjet' => 'required|string',
        'budgetEstime' => 'nullable|numeric',
        'datelimite' => 'nullable|date',
    ]);

    // Vérifier si le client existe déjà
    $client = \App\Models\Client::where('emailClient', $data['emailClient'])->first();

    if (!$client) {
        // Création du client
        $client = \App\Models\Client::create([
            'nomClient' => $data['nomClient'],
            'emailClient' => $data['emailClient'],
            'télé' => $data['télé'],
            'société' => $data['société'] ?? '',
            'adresse' => $data['adresse'] ?? '',
        ]);
    }

    // Création de la demande
    $demande = DemandeDevis::create([
        'typeService' => $data['typeService'],
        'detailsProjet' => $data['detailsProjet'],
        'budgetEstime' => $data['budgetEstime'] ?? 0,
        'datelimite' => $data['datelimite'] ?? now(),
        'client_id' => $client->id,
    ]);

    return response()->json([
        'message' => 'Demande enregistrée avec succès',
        'demande' => $demande
    ], 201);
}


    //  Vue d’une demande spécifique
    public function show($id)
    {
        return DemandeDevis::with('client', 'admin', 'offres')->findOrFail($id);
    }

    //  Acceptation d'une demande
    public function accepter($id)
    {
        $demande = DemandeDevis::findOrFail($id);
        $demande->admin_id = Auth::id();
        $demande->save();

        return response()->json(['message' => 'Demande acceptée', 'demande' => $demande]);
    }

    public function update(Request $request, $id)
    {
        $demande = DemandeDevis::findOrFail($id);
        $demande->update($request->except('offre_ids'));

        if ($request->has('offre_ids')) {
            $demande->offres()->sync($request->offre_ids);
        }

        return $demande->load('offres');
    }

    public function destroy($id)
    {
        DemandeDevis::destroy($id);
        return response()->json(['message' => 'Demande supprimée']);
    }
}
