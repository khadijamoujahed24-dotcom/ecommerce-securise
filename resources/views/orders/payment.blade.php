@extends('layouts.app')

@section('content')
<style>
    .payment-page {
        background: #f5f7fb;
        min-height: 100vh;
        padding: 60px 0;
    }

    .payment-wrapper {
        max-width: 1150px;
        margin: 0 auto;
    }

    .payment-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .payment-left {
        background: linear-gradient(135deg, #0f172a, #1e3a8a);
        color: #fff;
        height: 100%;
        padding: 36px;
    }

    .payment-left h2 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .payment-left p {
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 30px;
    }

    .summary-box {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 18px;
        padding: 22px;
    }

    .summary-row {
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-label {
        font-size: 0.92rem;
        opacity: 0.8;
        display: block;
        margin-bottom: 4px;
    }

    .summary-value {
        font-size: 1.1rem;
        font-weight: 700;
    }

    .status-pill {
        display: inline-block;
        margin-top: 6px;
        padding: 6px 14px;
        border-radius: 999px;
        background: #facc15;
        color: #111827;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .payment-right {
        padding: 36px;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 6px;
    }

    .section-subtitle {
        color: #6b7280;
        margin-bottom: 26px;
    }

    .form-label {
        font-weight: 600;
        color: #111827;
    }

    .form-control {
        height: 48px;
        border-radius: 12px;
    }

    textarea.form-control {
        height: auto;
    }

    .payment-method-card {
        border: 1.5px solid #e5e7eb;
        border-radius: 16px;
        padding: 16px 18px;
        margin-bottom: 14px;
        transition: 0.25s ease;
        cursor: pointer;
    }

    .payment-method-card:hover {
        border-color: #2563eb;
        background: #f8fbff;
    }

    .payment-method-card input {
        margin-right: 10px;
    }

    .bank-extra {
        display: none;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 16px;
        padding: 18px;
        margin-top: 10px;
        margin-bottom: 16px;
    }

    .payment-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .payment-actions .btn {
        border-radius: 12px;
        padding: 12px 22px;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .payment-left,
        .payment-right {
            padding: 26px;
        }
    }
</style>

<div class="payment-page">
    <div class="container payment-wrapper">

        @if(session('success'))
            <div class="alert alert-success rounded-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger rounded-4 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger rounded-4 shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="payment-card">
            <div class="row g-0">
                <div class="col-lg-4">
                    <div class="payment-left">
                        <h2>Paiement</h2>
                        <p>Complétez vos informations et choisissez le mode de règlement adapté.</p>

                        <div class="summary-box">
                            <div class="summary-row">
                                <span class="summary-label">Commande</span>
                                <span class="summary-value">#{{ $order->id }}</span>
                            </div>

                            <div class="summary-row">
                                <span class="summary-label">Montant total</span>
                                <span class="summary-value">{{ number_format($order->total, 2) }} MAD</span>
                            </div>

                            <div class="summary-row">
                                <span class="summary-label">Statut</span>
                                <span class="status-pill">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="payment-right">
                        <div class="section-title">Informations de paiement</div>
                        <div class="section-subtitle">
                            Vérifiez vos coordonnées avant de confirmer la commande.
                        </div>

                        <form action="{{ route('payment.pay', $order->id) }}" method="POST">
                            @csrf

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nom complet</label>
                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        value="{{ old('full_name') }}"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Adresse email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', auth()->user()->email ?? '') }}"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Téléphone</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone') }}"
                                        required
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Ville</label>
                                    <input
                                        type="text"
                                        name="city"
                                        class="form-control"
                                        value="{{ old('city') }}"
                                        required
                                    >
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Adresse</label>
                                    <input
                                        type="text"
                                        name="address"
                                        class="form-control"
                                        value="{{ old('address') }}"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mode de paiement</label>

                                <label class="payment-method-card d-block">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="cash"
                                        {{ old('payment_method') === 'cash' ? 'checked' : '' }}
                                        required
                                    >
                                    Paiement à la livraison
                                </label>

                                <label class="payment-method-card d-block">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="bank"
                                        {{ old('payment_method') === 'bank' ? 'checked' : '' }}
                                        required
                                    >
                                    Virement bancaire
                                </label>
                            </div>

                            <div id="bank-extra" class="bank-extra">
                                <div class="mb-3">
                                    <label class="form-label">Référence de virement</label>
                                    <input
                                        type="text"
                                        name="bank_reference"
                                        class="form-control"
                                        value="{{ old('bank_reference') }}"
                                        placeholder="Ex : VIR-2026-00125"
                                    >
                                </div>

                                <div class="mb-0">
                                    <label class="form-label">Note</label>
                                    <textarea
                                        name="payment_note"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Ajoutez une précision si nécessaire"
                                    >{{ old('payment_note') }}</textarea>
                                </div>
                            </div>

                            <div class="alert alert-info rounded-4">
                                En cas de virement bancaire, la commande restera en attente jusqu’à validation manuelle.
                            </div>

                            <div class="payment-actions">
                                <a href="{{ route('products.catalogue') }}" class="btn btn-outline-secondary">
                                    Retour
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    Confirmer la commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleBankFields() {
        const bankRadio = document.querySelector('input[name="payment_method"][value="bank"]');
        const bankExtra = document.getElementById('bank-extra');

        if (bankRadio && bankRadio.checked) {
            bankExtra.style.display = 'block';
        } else {
            bankExtra.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
            radio.addEventListener('change', toggleBankFields);
        });

        toggleBankFields();
    });
</script>
@endsection