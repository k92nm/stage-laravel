<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-200">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <span class="bg-indigo-100 text-indigo-700 p-2 rounded-lg mr-3">👤</span>
            Créer une fiche client
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Prénom</label>
                    <input type="text" name="firstname" class="w-full border-gray-300 border p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ex: Jean" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nom</label>
                    <input type="text" name="lastname" class="w-full border-gray-300 border p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ex: Dupont" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                <input type="email" name="email" class="w-full border-gray-300 border p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="jean.dupont@exemple.com" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-1">Téléphone</label>
                <input type="text" name="phone" class="w-full border-gray-300 border p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="06 12 34 56 78">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition shadow-lg mt-4">
                Enregistrer le Client
            </button>
        </form>
    </div>
</x-app-layout>