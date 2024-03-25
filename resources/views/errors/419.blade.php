@extends('layouts.guest')


@section('content')
    @php
        $page_title = '419';
    @endphp

    <div class="error-page">
        <h2 class="headline text-warning"> 419</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Session expirée.</h3>

            <p>
                Votre session a expiré. Veuillez rafraîchir la page et réessayer.
                Si le problème persiste, veuillez vous reconnecter.
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
