@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Finaliser la commande</h1>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card p-4">
                <h4 class="mb-3">Informations de livraison</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" class="form-control" placeholder="Votre nom">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" class="form-control" placeholder="Votre téléphone">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control" placeholder="Votre adresse">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ville</label>
                            <input type="text" class="form-control" placeholder="Votre ville">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mode de paiement</label>
                            <select class="form-select">
                                <option selected>Choisir</option>
                                <option>Paiement à la livraison</option>
                                <option>Carte bancaire</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirmer la commande</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4">
                <h4 class="mb-3">Résumé de la commande</h4>
                <p>PC Portable ASUS x1 <span class="float-end">8 999 DH</span></p>
                <p>Souris Gaming x2 <span class="float-end">598 DH</span></p>
                <hr>
                <h5>Total <span class="float-end text-primary">9 597 DH</span></h5>
            </div>
        </div>
    </div>
</div>
@endsection