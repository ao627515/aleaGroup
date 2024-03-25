@extends('layouts.guest')

@php
    $data['page_title'] = '402';
    $data['header_title'] = '402';
@endphp

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 402</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Paiement requis.</h3>

            <p>
                Pour accéder à cette page, un paiement est requis.
                Veuillez effectuer le paiement requis ou contacter l'administrateur du site pour plus d'informations.
            </p>
        </div>
        <!-- /.error-content -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary m-auto d-block">Page précédente</a>
        </div>
        <div>
            @if (auth()->check())
                <a href="{{ route('event.index') }}" class="btn btn-primary m-auto d-block">Page d'accueil</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary m-auto d-block">Se connecter</a>
            @endif
        </div>
    </div>
    <!-- /.error-page -->
@endsection
