<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau Client - TEST</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-indigo-700 p-4 mb-8 shadow-lg text-white">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-4">
            <div class="font-bold text-xl tracking-wider uppercase">AssurCRM</div>
            
            <div class="flex items-center space-x-6 text-sm">
                <a href="{{ route('contracts.index') }}" class="hover:text-indigo-200">Portefeuille</a>
                <a href="{{ route('clients.create') }}" class="text-indigo-200 border-b-2 border-indigo-200 pb-1">Nouveau Client</a>
                <a href="{{ route('contracts.create') }}" class="hover:text-indigo-200">Nouveau Contrat</a>
                
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
</body>
</html>