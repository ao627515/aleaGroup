@extends('layouts.guest')


@section('content')
    @php
        $page_title = '500';
    @endphp
    <div class="error-page">
        <h2 class="headline text-warning"> 500</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Erreur interne du serveur.</h3>

            <p>
                Une erreur interne du serveur s'est produite. Veuillez réessayer ultérieurement.
                Si le problème persiste, veuillez contacter l'administrateur du site.
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
