@extends('layouts.app')

@section('content')
    @include('includes.events.content_header')
    <div class="card">
        <div class="card-header px-5 mb-3">
            <h3 class="text-center">Recherche</h3>
            <form method="get">
                <div class="row row-cols-1 mx-5">
                    <div class="col mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="{{ __('Rechercher') }} {{ __('nom') }}"
                                name="search" value="{{ request()->input('search') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col  d-flex justify-content-around">
                        <div class="">
                            <button type="submit" class="btn btn-primary m-auto">{{ __('Rechercher') }}</button>

                        </div>
                        <div class="">
                            <a href="{{ route('event.show.participants', $event) }}" class="btn btn-info m-auto">{{ __('Réénitialisé') }}</a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body px-5">
            <h3 class="text-center w-100">Listes des participants</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="w-75">Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $value)
                        <tr>
                            <td class="w-75">{{ $value->getName() }} </td>
                            <td class="d-flex justify-content-around">
                                <form action="{{ route('event.participants.expel', $value) }}" method="post"
                                    class="form-action">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger action-btn" data-toggle="modal"
                                        data-target="#expel_participant">
                                        Expulser
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
    </div>
    <x-modal id="create_participant" title="Création d'un participant" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <x-slot name="body">
            <form action="{{ route('event.participants.create_add', $event) }}" method="post" id="f_create_participant">
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
            <button type="submit" form="f_create_participant" class="btn btn-primary">Valider</button>
        </x-slot>
    </x-modal>

    <x-modal id="update_event" title="Modifier un évènement" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <x-slot name="body">
            <form action="{{ route('event.update', $event) }}" method="post" id="f_update_event">
                @csrf
                @method('put')
                <x-forms.input :all="[
                    'label' => ['text' => 'Nom'],
                    'grid' => ['col-sm-3', 'col-sm-9'],
                    'name' => 'f_update_event_name',
                    'type' => 'text',
                    'value' => $event->getName()
                ]" autocomplete required />
            </form>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" form="f_update_event" class="btn btn-primary">Valider</button>
        </x-slot>
    </x-modal>


    <x-modal id="add_participant" title="Ajouter un participant" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" :scrollable="true">
        <x-slot name="body">
            <div class="container-fluid">
                <form action="{{ route('event.participants.add', $event) }}" method="post" id="f_add_participant">
                    @csrf
                    @foreach ($userParticipants as $value)
                        <x-forms.checkbox :all="[
                            'name' => 'participants[]',
                            'id' => 'participant' . $value->id,
                            'label' => ['text' => $value->getName()],
                            'grid' => ['offset-sm-3 col-sm-9'],
                            'value' => $value->id,
                            'checked' => $records->contains('id', $value->id),
                        ]" />
                        <hr>
                    @endforeach
                </form>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" form="f_add_participant" class="btn btn-primary">Valider</button>
        </x-slot>
    </x-modal>

    <x-modal id="expel_participant" title="Demande de confirmation">
        <x-slot name="body">
            Voullez-vous expulsé ce participant ?
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-primary confirmModal">Oui</button>
        </x-slot>
    </x-modal>

    <x-modal id="delete_event" title="Demande de confirmation">
        <x-slot name="body">
            Voullez-vous supprimé cet évènement ?
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <form action="{{ route('event.destroy', $event) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-primary">Oui</button>
            </form>
        </x-slot>
    </x-modal>
@endsection
