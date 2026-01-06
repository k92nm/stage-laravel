<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche Client - {{ $client->firstname }} {{ $client->lastname }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8 bg-white p-6 rounded-lg shadow">
            <div class="flex items-center space-x-4">
                <div class="bg-indigo-600 text-white rounded-full h-16 w-16 flex items-center justify-center text-2xl font-bold">
                    {{ substr($client->firstname, 0, 1) }}{{ substr($client->lastname, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $client->firstname }} {{ $client->lastname }}</h1>
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold uppercase">Client Actif</span>
                </div>
            </div>
            <a href="{{ route('contracts.index') }}" class="text-gray-500 hover:text-gray-700">← Retour à la liste</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow h-fit">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Coordonnées</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-indigo-600">{{ $client->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Téléphone</p>
                        <p class="font-medium">{{ $client->phone ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Adresse</p>
                        <p class="font-medium text-gray-700">{{ $client->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Contrats en cours</h2>
                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-bold">
                            {{ $client->contracts->count() }} contrat(s)
                        </span>
                    </div>

                    @if($client->contracts->isEmpty())
                        <p class="text-gray-500 italic">Aucun contrat pour ce client.</p>
                    @else
                        <div class="divide-y">
                            @foreach($client->contracts as $contract)
                            <div class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $contract->company_name }} - {{ $contract->type }}</p>
                                    <p class="text-sm text-gray-500">N° {{ $contract->policy_number }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-indigo-600">{{ number_format($contract->premium_amount, 2) }} €</p>
                                    <p class="text-xs text-gray-400 font-bold uppercase">Échéance : {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>