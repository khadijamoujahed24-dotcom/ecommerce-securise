@extends('layouts.app')

@section('content')
<style>
    .confirmation-page {
        background: #f5f7fb;
        min-height: 100vh;
        padding: 60px 0;
    }

    .confirmation-wrapper {
        max-width: 980px;
        margin: 0 auto;
    }

    .confirmation-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .confirmation-header {
        background: linear-gradient(135deg, #0f172a, #1e3a8a);
        color: #fff;
        padding: 34px;
        text-align: center;
    }

    .confirmation-header h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .confirmation-header p {
        margin: 0;
        color: rgba(255, 255, 255, 0.85);
    }

    .confirmation-body {
        padding: 34px;
    }

    .confirmation-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 24px;
    }

    .info-box {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 18px;
    }

    .info-box h5 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 14px;
        color: #111827;
    }

    .info-row {
        padding: 8px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-size: 0.92rem;
        color: #6b7280;
        display: block;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .status-awaiting {
        background: #fef3c7;
        color: #92400e;
    }

    .status-paid {
        background: #dcfce7;
        color: #166534;
    }

    .status-default {
        background: #e5e7eb;
        color: #374151;
    }

    .confirmation-note {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 24px;
    }

    .confirmation-actions {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .confirmation-actions .btn {
        border-radius: 12px;
        padding: 12px 22px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .confirmation-grid {
            grid-template-columns: 1fr;
        }

        .confirmation-body,
        .confirmation-header {
            padding: 24px;
        }
    }
</style>

<div class="confirmation-page">
    <div class="container confirmation-wrapper">

        @if(session('success'))
            <div class="alert alert-success rounded-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="confirmation-card">
            <div class="confirmation-header">
                <h1>Commande enregistrée</h1>
                <p>Votre demande a bien été prise en compte.</p>
            </div>

            <div class="confirmation-body">
                <div class="confirmation-note">
                    @if($order->payment_method === 'bank')
                        Votre commande est en attente de vérification du virement bancaire par l’administrateur.
                    @elseif($order->payment_method === 'cash')
                        Votre commande sera réglée à la livraison.
                    @else
                        Votre commande a été enregistrée avec succès.
                    @endif
                </div>

                <div class="confirmation-grid">
                    <div class="info-box">
                        <h5>Informations de la commande</h5>

                        <div class="info-row">
                            <span class="info-label">Numéro de commande</span>
                            <span class="info-value">#{{ $order->id }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Montant total</span>
                            <span class="info-value">{{ number_format($order->total, 2) }} MAD</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Mode de paiement</span>
                            <span class="info-value">
                                @if($order->payment_method === 'cash')
                                    Paiement à la livraison
                                @elseif($order->payment_method === 'bank')
                                    Virement bancaire
                                @else
                                    {{ $order->payment_method ?? 'Non défini' }}
                                @endif
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Statut</span>
                            <span class="info-value">
                                <span class="status-badge
                                    @if($order->status === 'awaiting_confirmation') status-awaiting
                                    @elseif($order->status === 'paid') status-paid
                                    @else status-default
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="info-box">
                        <h5>Informations client</h5>

                        <div class="info-row">
                            <span class="info-label">Nom complet</span>
                            <span class="info-value">{{ $order->full_name ?? '-' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Adresse email</span>
                            <span class="info-value">{{ $order->email ?? '-' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Téléphone</span>
                            <span class="info-value">{{ $order->phone ?? '-' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Adresse</span>
                            <span class="info-value">{{ $order->address ?? '-' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Ville</span>
                            <span class="info-value">{{ $order->city ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                @if($order->payment_method === 'bank' && ($order->bank_reference || $order->payment_note))
                    <div class="info-box mb-4">
                        <h5>Détails du virement</h5>

                        @if($order->bank_reference)
                            <div class="info-row">
                                <span class="info-label">Référence de virement</span>
                                <span class="info-value">{{ $order->bank_reference }}</span>
                            </div>
                        @endif

                        @if($order->payment_note)
                            <div class="info-row">
                                <span class="info-label">Note</span>
                                <span class="info-value">{{ $order->payment_note }}</span>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="confirmation-actions">
                    <a href="{{ route('products.catalogue') }}" class="btn btn-outline-secondary">
                        Retour au catalogue
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-primary">
                        Retour à l’accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection