<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portefeuille Contrats - AssurCRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <nav class="bg-indigo-700 p-4 mb-10 shadow-lg">
        <div class="max-w-6xl mx-auto flex justify-between items-center text-white px-4">
            <div class="font-bold text-xl uppercase tracking-wider">TEST</div>
            <div class="space-x-8 text-sm font-medium">
                <a href="{{ route('contracts.index') }}" class="text-indigo-200 border-b-2 border-indigo-200 pb-1">Portefeuille</a>
                <a href="{{ route('clients.create') }}" class="hover:text-indigo-200">Nouveau Client</a>
                <a href="{{ route('contracts.create') }}" class="hover:text-indigo-200">Nouveau Contrat</a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <p class="text-xs text-gray-500 uppercase font-bold">Total Clients</p>
                <p class="text-3xl font-bold text-gray-800">{{ $countClients }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-indigo-500">
                <p class="text-xs text-gray-500 uppercase font-bold">Contrats Actifs</p>
                <p class="text-3xl font-bold text-gray-800">{{ $countContracts }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                <p class="text-xs text-gray-500 uppercase font-bold">Volume de Primes</p>
                <p class="text-3xl font-bold text-green-600">{{ number_format($totalPrimes, 2, ',', ' ') }} €</p>
            </div>
        </div>

        <div class="mb-6">
            <form action="{{ route('contracts.index') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="Nom du client ou compagnie..." value="{{ request('search') }}"
                       class="flex-1 p-3 rounded-lg border border-gray-300 outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700">Rechercher</button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="p-4 border-b">Client</th>
                        <th class="p-4 border-b">Compagnie</th>
                        <th class="p-4 border-b">Type</th>
                        <th class="p-4 border-b">Échéance</th>
                        <th class="p-4 border-b text-right">Prime</th>
                        <th class="p-4 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($contracts as $contract)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">
                            <a href="{{ route('clients.show', $contract->client->id) }}" class="text-indigo-600 font-bold hover:underline">
                                {{ $contract->client->firstname }} {{ $contract->client->lastname }}
                            </a>
                        </td>
                        <td class="p-4 text-gray-700">{{ $contract->company_name }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-[10px] font-bold uppercase">
                                {{ $contract->type }}
                            </span>
                        </td>
                        <td class="p-4 text-sm">
                            @php $isExpired = \Carbon\Carbon::parse($contract->end_date)->isPast(); @endphp
                            <span class="{{ $isExpired ? 'text-red-600 font-bold' : '' }}">
                                {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}
                            </span>
                        </td>
                        <td class="p-4 text-right font-mono font-bold">
                            {{ number_format($contract->premium_amount, 2, ',', ' ') }} €
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" onsubmit="return confirm('Supprimer ce contrat ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($contracts->isEmpty())
                <div class="p-10 text-center text-gray-400 italic">Aucun contrat trouvé.</div>
            @endif
        </div>
    </div>
</body>
</html>