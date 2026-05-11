@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Détail utilisateur</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4 shadow-sm border-0 rounded-4">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rôle</label>
                <select name="role" class="form-select" required>
                    <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Client</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Mettre à jour</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </form>

        <hr class="my-4">

        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer l'utilisateur</button>
        </form>
    </div>
</div>
@endsection