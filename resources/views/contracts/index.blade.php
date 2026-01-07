<x-app-layout>
    <x-slot name="title">Portefeuille - AssurCRM</x-slot>

    <div class="max-w-6xl mx-auto px-4 mt-8">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500 hover:shadow-md transition">
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Total Clients</p>
                <p class="text-3xl font-black text-gray-800">{{ $countClients ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-indigo-500 hover:shadow-md transition">
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Contrats Actifs</p>
                <p class="text-3xl font-black text-gray-800">{{ $countContracts ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition">
                <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Volume de Primes</p>
                <p class="text-3xl font-black text-green-600">{{ number_format($totalPrimes ?? 0, 2, ',', ' ') }} €</p>
            </div>
        </div>

        <div class="mb-8">
            <form action="{{ route('contracts.index') }}" method="GET" class="flex gap-2">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">🔍</span>
                    <input type="text" name="search" placeholder="Chercher un client ou une compagnie..." 
                           value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Rechercher
                </button>
                @if(request('search'))
                    <a href="{{ route('contracts.index') }}" class="bg-gray-200 text-gray-600 px-4 py-3 rounded-xl font-bold hover:bg-gray-300 transition flex items-center">
                        Effacer
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-gray-400 text-[11px] uppercase font-black tracking-widest">
                        <th class="p-5">Client</th>
                        <th class="p-5">Compagnie</th>
                        <th class="p-5">Type</th>
                        <th class="p-5">Échéance</th>
                        <th class="p-5 text-right">Prime</th>
                        <th class="p-5 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($contracts as $contract)
                    <tr class="hover:bg-indigo-50/30 transition">
                        <td class="p-5 font-bold">
                            <a href="{{ route('clients.show', $contract->client->id) }}" class="text-indigo-600 hover:underline">
                                {{ $contract->client->firstname }} {{ $contract->client->lastname }}
                            </a>
                        </td>
                        <td class="p-5 text-gray-500">{{ $contract->company_name }}</td>
                        <td class="p-5 text-xs font-bold uppercase tracking-tighter text-gray-400">
                            {{ $contract->type }}
                        </td>
                        <td class="p-5 text-sm">
                            @php $isExpired = \Carbon\Carbon::parse($contract->end_date)->isPast(); @endphp
                            <span class="{{ $isExpired ? 'text-red-500 font-bold' : '' }}">
                                {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}
                            </span>
                        </td>
                        <td class="p-5 text-right font-mono font-bold text-indigo-700">
                            {{ number_format($contract->premium_amount, 2, ',', ' ') }} €
                        </td>
                        <td class="p-5 text-center">
                            <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" 
                                  onsubmit="return confirm('Es-tu sûr de vouloir supprimer ce contrat ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-20 text-center text-gray-300 italic">
                            Aucun contrat trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>