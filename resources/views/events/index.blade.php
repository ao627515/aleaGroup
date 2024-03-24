@extends('layouts.app')

@section('content')
    <div class="card">
        @if ($errors->has('f_create_name'))
            <div class="alert alert-danger text-center">
                @if ($errors->has('f_create_name'))
                    {{ $errors->first('f_create_name') }}
                @endif
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-header px-5">
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#create_event">
                Créer un évènement
            </button>
        </div>
        <div class="card-header px-5">
            <h2 class="text-center mb-5">Recherche et Filtres</h2>

            <form id="f_search">
                <div class="row row-cols-1 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    <div class="col">
                        <x-forms.input :all="[
                            'label' => ['text' => 'Nom'],
                            'grid' => ['col-sm-3', 'col-sm-9'],
                            'name' => 'f_search_name',
                            'type' => 'text',
                        ]" autocomplete />
                    </div>
                    <div class="col">
                        <x-forms.input :all="[
                            'label' => ['text' => 'Inscrit le'],
                            'name' => 'f_filter_created_at',
                            'grid' => ['col-sm-3', 'col-sm-9'],
                            'type' => 'date',
                        ]" autocomplete />
                    </div>
                    <div class="col">
                        <button type="submit" form="f_search" class="btn btn-primary d-block w-100 mb-3">Rechecher</button>
                    </div>
                    <div class="col">
                        {{-- <button type="reset" form="f_search"
                            class="btn btn-info d-block w-100 mn-3">{{ __('Réénitialisé') }}</button> --}}
                        <a href="{{ route('event.index') }}" class="btn btn-info d-block w-100">Réénitialisé</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card body pt-3 px-5">
            <h2 class="text-center mb-3">Liste des évènements</h2>
            <div class="row row-cols-1 row-cols-sm-2  ">
                @forelse ($records as $value)
                    <a href="{{ route('event.show', $value) }}">
                        <div class="col">
                            <x-event.event-card :event="$value" />
                        </div>
                    </a>
                @empty
                    <div class="offset-sm-3 w-100">
                        <p class="w-100 text-center lead">Vide</p>
                    </div>
                @endforelse
            </div>
        </div>
        {{-- <div class="card-footer">
            <div class="float-right ">
                {{ $records->appends(request()->except('page'))->links() }}
            </div>
        </div> --}}
    </div>

    <x-modal id="create_event" title="Création d'un event" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <x-slot name="body">
            <form action="{{ route('event.store') }}" method="post" id="f_create_event">
                @csrf
                <x-forms.input :all="[
                    'label' => ['text' => 'Nom'],
                    'grid' => ['col-sm-3', 'col-sm-9'],
                    'name' => 'f_create_name',
                    'type' => 'text',
                ]" autocomplete required />
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" form="f_create_event" class="btn btn-primary">Valider</button>
        </x-slot>
    </x-modal>
@endsection
