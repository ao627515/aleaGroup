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
                'value' => $event->getName(),
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
                {{-- @foreach ($userParticipants as $value)
                    <x-forms.checkbox :all="[
                        'name' => 'participants[]',
                        'id' => 'participant' . $value->id,
                        'label' => ['text' => $value->getName()],
                        'grid' => ['offset-sm-3 col-sm-9'],
                        'value' => $value->id,
                        'checked' => $participantsRecords->contains('id', $value->id),
                    ]" />
                    <hr>
                @endforeach --}}
                @forelse ($userParticipants as $value)
                    <x-forms.checkbox :all="[
                        'name' => 'participants[]',
                        'id' => 'participant' . $value->id,
                        'label' => ['text' => $value->getName()],
                        'grid' => ['offset-sm-3 col-sm-9'],
                        'value' => $value->id,
                        'checked' => $participantsRecords->contains('id', $value->id),
                    ]" />
                    <hr>
                @empty
                    <div>
                        <p class="lead w-100">Aucun participant créer</p>
                    </div>
                @endforelse
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


@section('scripts')
    <script src="{{ asset('dist/js/header_event_dropdown.js') }}"></script>
@endsection
