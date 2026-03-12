<x-guest-layout>
    <h2>Réinitialisation du mot de passe</h2>

    @if (session('status'))
        <div class="mb-4 font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email">Adresse email</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>

        <div>
            <button type="submit">
                Envoyer le lien de réinitialisation
            </button>
        </div>
    </form>
</x-guest-layout>