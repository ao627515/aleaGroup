@extends('layouts.guest')

@php
    $data['page_title'] = '429';
    $data['header_title'] = '429';
@endphp

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 429</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Trop de requêtes.</h3>

            <p>
                Vous avez atteint le nombre maximum de requêtes autorisées.
                Veuillez réessayer ultérieurement ou contacter l'administrateur du site.
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
