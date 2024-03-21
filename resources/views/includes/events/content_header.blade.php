<div class="card sticky-top">
    @if ($errors->has('participants') || $errors->has('f_update_name') || $errors->has('f_create_name'))
        <div class="alert alert-danger text-center">
            @if ($errors->has('participants'))
                {{ $errors->first('participants') }}

            @elseif ($errors->has('f_update_name'))
                {{ $errors->first('f_update_name') }}

            @elseif ($errors->has('f_create_name'))
                {{ $errors->first('f_create_name') }}
            @endif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card-header">
        {{-- <button class="btn btn-outline-primary">Imprimer</button>
        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#update_event">Modifier</button>
        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#delete_event">Supprimer</button>
        <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#add_participant">Ajouter un participants</button>
        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#create_participant">Creer un
            participants</button> --}}

            <div class="btn-group w-100 py-3 wrap">
                <button class="btn btn-outline-secondary">Imprimer la liste des groupes</button>
                <button class="btn btn-outline-secondary">Information sur l'évènement</button>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#update_event">Modifier l'évènement</button>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#delete_event">Supprimer l'évènement</button>
                <button class="btn btn-outline-secondary"  data-toggle="modal" data-target="#add_participant">Ajouter un participants</button>
                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#create_participant">Creer un
                    participants</button>
              </div>
    </div>
    <div class="card-header px-5">
        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
            <a class="btn btn-outline-primary @if (request()->route()->getName() === 'event.show.groups') active @endif"
                href="{{ route('event.show.groups', $event) }}">Groupes</a>
                <a class="btn btn-outline-primary @if (request()->route()->getName() === 'event.show.participants') active @endif"
                    href="{{ route('event.show.participants', $event) }}">Participants</a>
          </div>
    </div>
</div>
