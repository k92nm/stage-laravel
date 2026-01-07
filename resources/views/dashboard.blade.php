<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 mt-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tableau de Bord</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <p class="text-xs text-gray-500 uppercase font-bold">Total Clients</p>
                <p class="text-3xl font-bold text-gray-800">{{ $countClients ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-indigo-500">
                <p class="text-xs text-gray-500 uppercase font-bold">Contrats Actifs</p>
                <p class="text-3xl font-bold text-gray-800">{{ $countContracts ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                <p class="text-xs text-gray-500 uppercase font-bold">Volume de Primes</p>
                <p class="text-3xl font-bold text-green-600">{{ number_format($totalPrimes ?? 0, 2, ',', ' ') }} €</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="p-4">Client</th>
                        <th class="p-4">Compagnie</th>
                        <th class="p-4 text-right">Prime</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @isset($contracts)
                        @foreach($contracts as $contract)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-bold text-indigo-700">
                                {{ $contract->client->lastname ?? 'N/A' }}
                            </td>
                            <td class="p-4">{{ $contract->company_name }}</td>
                            <td class="p-4 text-right font-mono">
                                {{ number_format($contract->premium_amount, 2, ',', ' ') }} €
                            </td>
                        </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>