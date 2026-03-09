@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h2 class="text-center mb-4">Connexion</h2>

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
