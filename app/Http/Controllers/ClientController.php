<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    // Pour afficher le formulaire de creation d'un client
    public function create()
    {
        return view('clients.create');
    }

    //Enregistrer un nouveau client
    public function store(Request $request)
    {
        // Verification des donnée
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string',
        ]);

        // Creation du client
        Client::create($validated);

        // Redirection apres creation
        return redirect()->back()->with('success', 'Le client a bien été ajouté !');
    }

    public function show(\App\Models\Client $client)
{
    // On charge les contrats liés à ce client précis
    $client->load('contracts');
    
    return view('clients.show', compact('client'));
}
}
