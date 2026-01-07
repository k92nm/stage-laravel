<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Contrat - TEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-indigo-700 p-4 mb-8 shadow-lg text-white">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-4">
            <div class="font-bold text-xl tracking-wider uppercase">AssurCRM</div>
            
            <div class="flex items-center space-x-6 text-sm">
                <a href="{{ route('contracts.index') }}" class="hover:text-indigo-200">Portefeuille</a>
                <a href="{{ route('clients.create') }}" class="hover:text-indigo-200">Nouveau Client</a>
                <a href="{{ route('contracts.create') }}" class="text-indigo-200 border-b-2 border-indigo-200 pb-1">Nouveau Contrat</a>
                
                <div class="flex items-center border-l border-indigo-500 pl-6 ml-2">
                    <span class="mr-4 text-indigo-200 italic">{{ Auth::user()->firstname ?? Auth::user()->name }}</span>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-indigo-800 hover:bg-red-600 px-3 py-1 rounded transition text-xs font-bold uppercase">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="bg-indigo-100 text-indigo-700 p-2 rounded-lg mr-3">📄</span>
            Souscrire un nouveau contrat
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contracts.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 mb-1 text-indigo-700">Sélectionner le Client</label>
                <select name="client_id" class="w-full border-indigo-300 border-2 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-indigo-50 font-bold" required>
                    <option value="">-- Chercher un client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->firstname }} {{ $client->lastname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Compagnie d'Assurance</label>
                    <input type="text" name="company_name" class="w-full border-gray-300 border p-2.5 rounded-lg" placeholder="Ex: AXA, Allianz..." required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Numéro de Police</label>
                    <input type="text" name="policy_number" class="w-full border-gray-300 border p-2.5 rounded-lg" placeholder="Ex: POL-889900" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Type de Risque</label>
                    <input type="text" name="type" class="w-full border-gray-300 border p-2.5 rounded-lg" placeholder="Ex: Auto, Santé, Habitation" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Montant de la Prime (€)</label>
                    <input type="number" step="0.01" name="premium_amount" class="w-full border-gray-300 border p-2.5 rounded-lg" placeholder="0.00" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1 text-blue-600 italic">Date d'effet (Début)</label>
                    <input type="date" name="start_date" class="w-full border-gray-300 border p-2.5 rounded-lg bg-blue-50" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1 text-red-600 italic">Date d'échéance (Fin)</label>
                    <input type="date" name="end_date" class="w-full border-gray-300 border p-2.5 rounded-lg bg-red-50" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition shadow-lg mt-8">
                Valider et Créer le Contrat
            </button>
        </form>
    </div>
</body>
</html>