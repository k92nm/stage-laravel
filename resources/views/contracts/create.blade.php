<x-app-layout>
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

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Des erreurs sont presentes :</p>
                <ul class="list-disc ml-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-600 mb-2">Garanties associees</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($garanties as $garantie)
                        <label class="flex items-start gap-2 border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="checkbox" name="garanties[]" value="{{ $garantie->id }}" class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @checked(in_array($garantie->id, old('garanties', [])))>
                            <span>
                                <span class="block font-semibold text-gray-700">{{ $garantie->label }}</span>
                                <span class="block text-xs text-gray-500">{{ $garantie->description }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition shadow-lg mt-8">
                Valider et Créer le Contrat
            </button>
        </form>
    </div>
</x-app-layout>