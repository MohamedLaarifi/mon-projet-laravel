<?php

namespace App\Http\Controllers;

use App\Models\OffreERP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreERPController extends Controller
{
    public function index()
    {
        // Toutes les offres avec leurs admins
        return OffreERP::with('admin')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomOffre' => 'required|string',
            'prixOffre' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // 👇 Utilise le guard 'admin'
        $data['admin_id'] = Auth::guard('admin')->id();

        $offre = OffreERP::create($data);
        return response()->json($offre, 201); // 201: Created
    }

    public function show($id)
    {
        $offre = OffreERP::with('admin')->findOrFail($id);
        return response()->json($offre);
    }

    public function update(Request $request, $id)
    {
        $offre = OffreERP::findOrFail($id);

        // 👇 Autorisation : seul l'admin authentifié peut modifier son offre
        if (Auth::guard('admin')->id() !== $offre->admin_id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $data = $request->validate([
            'nomOffre' => 'sometimes|string',
            'prixOffre' => 'sometimes|numeric',
            'description' => 'sometimes|string',
        ]);

        $offre->update($data);
        return response()->json($offre);
    }

    public function destroy(Request $request, $id)
    {
        $offre = OffreERP::findOrFail($id);

        // 👇 Autorisation : seul l'admin authentifié peut supprimer son offre
        if (Auth::guard('admin')->id() !== $offre->admin_id) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $offre->delete();
        return response()->json(['message' => 'Offre supprimée']);
    }
}
