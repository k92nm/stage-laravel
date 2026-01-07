<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>AssurCRM</title>
</head>
<body class="bg-gray-100">
    <nav class="bg-indigo-700 p-4 text-white shadow-lg">
        <div class="max-w-6xl mx-auto flex justify-between items-center px-4">
            <a href="{{ route('contracts.index') }}" class="font-bold text-xl uppercase tracking-wider">
                AssurCRM
            </a>
            
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('contracts.index') }}" class="text-indigo-200 border-b-2 border-indigo-200 pb-1">Portefeuille</a>
                
                <a href="{{ route('clients.create') }}" class="hover:text-indigo-200">Nouveau Client</a>
                <a href="{{ route('contracts.create') }}" class="hover:text-indigo-200">Nouveau Contrat</a>
                
                <div class="flex items-center border-l border-indigo-500 pl-6 ml-2">
                    <span class="mr-4 text-indigo-200 italic">{{ Auth::user()->name }}</span>
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

    <main class="py-10">
        {{ $slot }}
    </main>
</body>
</html>