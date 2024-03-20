@extends('layouts.app')

@section('content')
    <div class="card">
        @if ($errors->has('f_create_name') || $errors->has('f_update_name'))
            <div class="alert alert-danger text-center">
                @if ($errors->has('f_create_name'))
                    {{ $errors->first('f_create_name') }}
                @elseif ($errors->has('f_update_name'))
                    {{ $errors->first('f_update_name') }}
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
            <h2 class="text-center mb-5">Liste des évènements</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $value)
                        <tr>
                            <td>{{ $value->getName() }} </td>
                            <td>{{ $value->getCreated_at() }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('event.show', $value) }}" class="btn btn-info">Voir</a>
                                <button type="button" class="btn btn-primary btn-update" data-toggle="modal"
                                    data-target="#update_event" data-url="{{ route('event.update', $value) }}"
                                    data-value="{{ $value->getName() }}">
                                    Modifier
                                </button>
                                <form action="{{ route('event.destroy', $value) }}" method="post"
                                    class="form-action">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger action-btn" data-toggle="modal"
                                        data-target="#delete_event">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="w-100">
                                    <p class="w-100 text-center lead">Vide</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="float-right ">
                {{ $records->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>

    <x-modal id="delete_event" title="Demande de confirmation">
        <x-slot name="body">
            Voullez-vous supprimer ce event ?
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-primary confirmModal">Oui</button>
        </x-slot>
    </x-modal>

    <x-modal id="update_event" title="Mise a jours d'un event" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <x-slot name="body">
            <form method="post" id="f_update_event">
                @csrf
                @method('put')
                <x-forms.input :all="[
                    'label' => ['text' => 'Nom'],
                    'grid' => ['col-sm-3', 'col-sm-9'],
                    'name' => 'f_update_name',
                    'type' => 'text',
                ]" autocomplete required />
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" form="f_update_event" class="btn btn-primary">Valider</button>
        </x-slot>
    </x-modal>

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

@section('scripts')
    <script>
        const buttons = document.querySelectorAll('.btn-update');
        const updateField = document.querySelector("form#f_update_event input[name='f_update_name']");
        const updateForm = document.querySelector("form#f_update_event");

        buttons.forEach(element => {
            element.onclick = (() => {
                let url = element.dataset.url;
                let value = element.dataset.value;
                updateForm.action = url;
                updateField.value = value;
            });
        });
    </script>
@endsection
