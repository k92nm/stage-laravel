<?php

namespace App\Http\Controllers;

use App\Models\Contract; // Import du modèle Contrat
use App\Models\Client;   // Import du modèle Client pour la liste déroulante
use Illuminate\Http\Request;

class ContractController extends Controller
{
    // Affiche le formulaire de création de contrat
    public function create()
    {
        // On récupère tous les clients pour pouvoir en choisir un dans le formulaire
        $clients = Client::all(); 
        return view('contracts.create', compact('clients'));
    }

    // Enregistre le contrat
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id', // Vérifie que le client existe
            'company_name' => 'required|string',
            'policy_number' => 'required|string|unique:contracts',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date', // L'échéance doit être après le début
            'premium_amount' => 'required|numeric',
        ]);

        Contract::create($validated);

        return redirect()->back()->with('success', 'Le contrat a été enregistré avec succès !');

        
    }

    public function index(Request $request)
{
    $search = $request->input('search');

    // On prépare la requête de base
    $query = Contract::with('client');

    // Si une recherche est effectuée, on filtre par nom de client ou compagnie
    if ($search) {
        $query->whereHas('client', function($q) use ($search) {
            $q->where('firstname', 'like', "%{$search}%")
              ->orWhere('lastname', 'like', "%{$search}%");
        })->orWhere('company_name', 'like', "%{$search}%");
    }

    $contracts = $query->orderBy('end_date', 'asc')->get();

    // On garde les calculs pour les cartes du haut
    $totalPrimes = $contracts->sum('premium_amount');
    $countContracts = $contracts->count();
    $countClients = \App\Models\Client::count();

    return view('contracts.index', compact('contracts', 'totalPrimes', 'countContracts', 'countClients'));
}

public function destroy(Contract $contract)
{
    // On supprime le contrat de la base de données
    $contract->delete();

    // On redirige vers la liste avec un message de succès
    return redirect()->route('contracts.index')->with('success', 'Le contrat a été supprimé avec succès.');
}
}