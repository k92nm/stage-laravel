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

        @if($urgences > 0)
        <div class="mb-6 bg-orange-50 border border-orange-400 p-4 rounded-xl shadow-sm flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-2xl mr-3">🔔</span>
                <div>
                    <h3 class="text-orange-800 font-bold">Action Requise</h3>
                    <p class="text-orange-700 text-sm">Vous avez <strong>{{ $urgences }} contract(s) qui vont expirer dans moins de 30 jours.</p>
                </div>
            </div>
            <span class="text-xs font-black uppercase text-orange-400 tracking-widest">Urgent</span>
        </div>
        @endif

        
        
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
                        <th class="p-5">Garanties</th>
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
                        <td class="p-5 text-xs text-gray-600">
                            @if($contract->garanties->isEmpty())
                                <span class="text-gray-400 italic">Aucune</span>
                            @else
                                <div class="flex flex-wrap gap-1">
                                    @foreach($contract->garanties as $garantie)
                                        <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full font-semibold">{{ $garantie->label }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="p-5 text-sm">
                            @php
                                $endDate = \Carbon\Carbon::parse($contract->end_date);
                                $now = \Carbon\Carbon::now();
                                $diffInDays = $now->diffInDays($endDate, false); // false pour avoir un nombre négatif si expiré
                            @endphp

                            @if($diffInDays < 0)
                                <span class="flex items-center text-red-600 font-black">
                                    <span class="h-2 w-2 rounded-full bg-red-600 animate-pulse mr-2"></span>
                                    Expiré ({{ abs($diffInDays) }} j)
                                </span>
                            @elseif($diffInDays <= 30)
                                <span class="flex items-center text-orange-500 font-bold">
                                    <span class="h-2 w-2 rounded-full bg-orange-500 mr-2"></span>
                                    J-{{ floor($diffInDays) }} (À renouveler)
                                </span>
                            @else
                                <span class="flex items-center text-green-600">
                                    <span class="h-2 w-2 rounded-full bg-green-600 mr-2"></span>
                                    {{ $endDate->format('d/m/Y') }}
                                </span>
                            @endif
                        </td>
                        <td class="p-5 text-right font-mono font-bold text-indigo-700">
                            {{ number_format($contract->premium_amount, 2, ',', ' ') }} €
                        </td>
                        <td class="p-5 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('contracts.edit', $contract->id) }}" class="text-indigo-500 hover:text-indigo-700 transition" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-7 14h12a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1 1 0 01-.707-.293l-1-1A1 1 0 0012.086 3h-2.172a1 1 0 00-.707.293l-1 1A1 1 0 017.5 5H4a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </a>
                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" onsubmit="return confirm('Es-tu sûr de vouloir supprimer ce contrat ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-20 text-center text-gray-300 italic">
                            Aucun contrat trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>