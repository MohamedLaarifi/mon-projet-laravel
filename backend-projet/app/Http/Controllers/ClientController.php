<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomClient' => 'required',
            'emailClient' => 'required|email|unique:clients',
            'télé' => 'required',
            'société' => 'required',
            'adresse' => 'required',
        ]);

        return Client::create($data);
    }

    public function show($id)
    {
        return Client::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return $client;
    }

    public function destroy($id)
    {
        Client::destroy($id);
        return response()->json(['message' => 'Client supprimé']);
    }
}
