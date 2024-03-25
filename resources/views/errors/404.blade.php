@extends('layouts.guest')


@section('content')
    @php
        $page_title = '404';
    @endphp
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oups ! Page non trouvée.</h3>

            <p>
                Nous n'avons pas trouvé la page que vous recherchiez.
                En attendant, vous pouvez <a href="{{ route('event.index') }}">retourner la page d'accueil</a> ou essayer
                d'utiliser
                le formulaire de recherche.
            </p>
        </div>
        <!-- /.error-content -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary m-auto d-block">Page précédente</a>
        </div>
        <div>
            @if (auth()->check())
                <a href="{{ route('event.index') }}" class="btn btn-primary m-auto d-block">Page d'accueil</a>
            @endif
        </div>
    </div>
    <!-- /.error-page -->
@endsection
