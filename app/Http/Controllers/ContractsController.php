<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer tous les contrats avec les relations nécessaires
        $contracts = Contract::with(['client', 'typeContrat', 'etatContrat'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        // Compter le nombre total de clients
        $countClients = Client::count();

        // Compter le nombre total de contrats
        $countContracts = Contract::count();

        // Calculer la prime totale
        $totalPrimes = Contract::sum('prime');

        // Calculer le nombre de contrats qui expirent dans moins de 30 jours
        $urgences = Contract::where('end_date', '<=', now()->addDays(30))
                            ->where('end_date', '>=', now())
                            ->count();

        return view('contracts.index', compact('contracts', 'countClients', 'countContracts', 'totalPrimes', 'urgences'));
    }
}