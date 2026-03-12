<!-- resources/views/auth/login.blade.php -->

<x-guest-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Connexion</h2>

<<<<<<< HEAD
                <form method="POST" action="#">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Adresse email</label>
                        <input type="email" class="form-control" placeholder="Entrez votre email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" placeholder="Entrez votre mot de passe">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>

                <p class="text-center mt-3">
                    Pas encore de compte ?
                    <a href="{{ url('/register') }}">S’inscrire</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
=======
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
           @if ($errors->has('email'))
               <div class="text-red-600 mt-2" id="throttle-message">
                   {{ $errors->first('email') }}
                </div>
            @endif

        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password"
                                          name="password" required autocomplete="current-password" />
                            @if ($errors->has('password'))
                                <div class="text-red-600 mt-2">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                       name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                   href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-primary-button class="ms-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <p class="text-center mt-3">
                        Pas encore de compte ?
                        <a href="{{ url('/register') }}">S’inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Supprimer ou commenter si login-lock.js n'existe pas -->
    {{-- <script src="{{ asset('js/login-lock.js') }}"></script> --}}
</x-guest-layout>
>>>>>>> chapitre5-securite-b
