<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Client;
class ContactController extends Controller
{
    public function index()
    {
        return Contact::with('client')->get();
    }
public function store(Request $request)
{
    $data = $request->validate([
        'nom' => 'required|string',
        'email' => 'required|email',
        'téléphone' => 'required|string',
        'société' => 'nullable|string',
        'message' => 'required|string',
    ]);

    // Vérifie si le client existe déjà
    $client = Client::firstOrCreate(
        ['emailClient' => $data['email']], // Condition de recherche
        [
            'nomClient' => $data['nom'],
            'télé' => $data['téléphone'],
            'société' => $data['société'] ?? '',
            'adresse' => '', // Tu peux ajouter un champ si nécessaire
        ]
    );

    // Crée le message de contact lié au client
    $contact = Contact::create([
        'message' => $data['message'],
        'client_id' => $client->id,
    ]);

    return response()->json([
        'message' => 'Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.',
        'contact' => $contact
    ], 201);
}


    public function show($id)
    {
        return Contact::with('client')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        return $contact;
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return response()->json(['message' => 'Contact supprimé']);
    }

    
}
