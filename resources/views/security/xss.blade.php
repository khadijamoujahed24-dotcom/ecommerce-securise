@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Test de sécurité XSS</h2>

    <form method="GET" action="{{ url('/security/xss') }}" class="mb-4">
        <div class="mb-3">
            <label for="q" class="form-label">Entrer une valeur à tester</label>
            <input type="text" name="q" id="q" class="form-control" value="{{ request('q') }}">
        </div>
        <button type="submit" class="btn btn-primary">Tester</button>
    </form>

    <div class="card p-3 mb-3">
        <h4>Affichage sécurisé</h4>
        <p>{{ request('q') }}</p>
    </div>

    <div class="card p-3">
        <h4>Affichage non sécurisé</h4>
        <p>{!! request('q') !!}</p>
    </div>
</div>
@endsection

