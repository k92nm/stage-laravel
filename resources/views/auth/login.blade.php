<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-black text-indigo-700 uppercase tracking-tighter">AssurCRM</h2>
        <p class="text-gray-500 text-sm mt-2">Accédez à votre portefeuille de courtage</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Adresse Email</label>
            <x-text-input id="email" class="block mt-1 w-full border-gray-200 rounded-xl focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mot de passe</label>
            <x-text-input id="password" class="block mt-1 w-full border-gray-200 rounded-xl focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-indigo-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif

            <button class="ms-3 bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-800 transition shadow-lg shadow-indigo-100">
                Se connecter
            </button>
        </div>
    </form>
</x-guest-layout>