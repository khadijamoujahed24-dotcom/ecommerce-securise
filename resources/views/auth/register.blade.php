@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h2 class="text-center mb-4">Inscription</h2>

                <form method="POST" action="#">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" class="form-control" placeholder="Entrez votre nom complet">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresse email</label>
                        <input type="email" class="form-control" placeholder="Entrez votre email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" placeholder="Choisissez un mot de passe">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" placeholder="Confirmez votre mot de passe">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Créer un compte</button>
                </form>

                <p class="text-center mt-3">
                    Déjà inscrit ?
                    <a href="{{ url('/login') }}">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection