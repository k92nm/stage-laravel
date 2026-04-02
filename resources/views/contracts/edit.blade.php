<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="bg-amber-100 text-amber-700 p-2 rounded-lg mr-3">✏️</span>
            Modifier un contrat
        </h1>

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

        <form action="{{ route('contracts.update', $contract) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 mb-1 text-indigo-700">Client</label>
                <select name="client_id" class="w-full border-indigo-300 border-2 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 bg-indigo-50 font-bold" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" @selected(old('client_id', $contract->client_id) == $client->id)>
                            {{ $client->firstname }} {{ $client->lastname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Compagnie d'Assurance</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $contract->company_name) }}" class="w-full border-gray-300 border p-2.5 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Numero de Police</label>
                    <input type="text" name="policy_number" value="{{ old('policy_number', $contract->policy_number) }}" class="w-full border-gray-300 border p-2.5 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Type de Risque</label>
                    <input type="text" name="type" value="{{ old('type', $contract->type) }}" class="w-full border-gray-300 border p-2.5 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Montant de la Prime (EUR)</label>
                    <input type="number" step="0.01" name="premium_amount" value="{{ old('premium_amount', $contract->premium_amount) }}" class="w-full border-gray-300 border p-2.5 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Date d'effet</label>
                    <input type="date" name="start_date" value="{{ old('start_date', \Illuminate\Support\Str::of($contract->start_date)->substr(0, 10)) }}" class="w-full border-gray-300 border p-2.5 rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Date d'echeance</label>
                    <input type="date" name="end_date" value="{{ old('end_date', \Illuminate\Support\Str::of($contract->end_date)->substr(0, 10)) }}" class="w-full border-gray-300 border p-2.5 rounded-lg" required>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-600 mb-2">Garanties associees</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @php
                        $selectedGaranties = old('garanties', $contract->garanties->pluck('id')->toArray());
                    @endphp
                    @foreach($garanties as $garantie)
                        <label class="flex items-start gap-2 border border-gray-200 rounded-lg p-3 hover:bg-gray-50">
                            <input type="checkbox" name="garanties[]" value="{{ $garantie->id }}" class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" @checked(in_array($garantie->id, $selectedGaranties))>
                            <span>
                                <span class="block font-semibold text-gray-700">{{ $garantie->label }}</span>
                                <span class="block text-xs text-gray-500">{{ $garantie->description }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <a href="{{ route('contracts.index') }}" class="w-1/2 text-center bg-gray-200 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-300 transition">
                    Annuler
                </a>
                <button type="submit" class="w-1/2 bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition shadow-lg">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
