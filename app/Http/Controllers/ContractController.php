<?php

namespace App\Http\Controllers;

use App\Models\Contract; // Import du modèle Contrat
use App\Models\Client;   // Import du modèle Client pour la liste déroulante
use App\Models\Garantie;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // On prépare la requête de base
        $query = Contract::with(['client', 'garanties']);

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
        $countClients = Client::count();

        // Calculer le nombre de contrats qui expirent dans moins de 30 jours
        $urgences = Contract::where('end_date', '<=', now()->addDays(30))
                            ->where('end_date', '>=', now())
                            ->count();

        $statsCompagnies = Contract::select('company_name', \DB::raw('sum(premium_amount) as total'))
                            ->groupBy('company_name')
                            ->orderBy('total', 'desc')
                            ->get();

        return view('contracts.index', compact('contracts', 'totalPrimes', 'countContracts', 'countClients', 'urgences', 'statsCompagnies'));
    }

    // Affiche le formulaire de création de contrat
    public function create()
    {
        // On récupère tous les clients pour pouvoir en choisir un dans le formulaire
        $clients = Client::all();
        $garanties = Garantie::orderBy('label')->get();

        return view('contracts.create', compact('clients', 'garanties'));
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
            'garanties' => 'nullable|array',
            'garanties.*' => 'exists:garanties,id',
        ]);

        $contract = Contract::create($validated);
        $contract->garanties()->sync($request->input('garanties', []));

        return redirect()->route('contracts.index')->with('success', 'Le contrat a été enregistré avec succès !');
    }

    // Affiche le formulaire d'édition d'un contrat
    public function edit(Contract $contract)
    {
        $clients = Client::orderBy('lastname')->orderBy('firstname')->get();
        $garanties = Garantie::orderBy('label')->get();
        $contract->load('garanties');

        return view('contracts.edit', compact('contract', 'clients', 'garanties'));
    }

    // Met à jour un contrat existant
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'company_name' => 'required|string',
            'policy_number' => 'required|string|unique:contracts,policy_number,' . $contract->id,
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'premium_amount' => 'required|numeric',
            'garanties' => 'nullable|array',
            'garanties.*' => 'exists:garanties,id',
        ]);

        $contract->update($validated);
        $contract->garanties()->sync($request->input('garanties', []));

        return redirect()->route('contracts.index')->with('success', 'Le contrat a été modifié avec succès !');
    }

    public function destroy(Contract $contract)
    {
        // On supprime le contrat de la base de données
        $contract->delete();

        // On redirige vers la liste avec un message de succès
        return redirect()->route('contracts.index')->with('success', 'Le contrat a été supprimé avec succès.');
    }
}