<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <h1 class="text-xl font-bold mb-4">Démonstration XSS</h1>

            <form method="GET" action="/security/xss">
                <input type="text" name="q" value="{{ request('q') }}" class="border p-2 w-full mb-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">
                    Tester
                </button>
            </form>

            <hr class="my-4">

            <h3 class="font-semibold">Affichage sécurisé</h3>
            <div class="border p-2 mb-4">
                {{ request('q') }}
            </div>

            <h3 class="font-semibold">Affichage non sécurisé</h3>
            <div class="border p-2">
                {!! request('q') !!}
            </div>

        </div>
    </div>
</x-app-layout>