<div class="card">
    <div class="card-header">
        <div class="btn-group w-100 py-3 ">
            <button class="btn btn-secondary p-2 fw-bold w-50  mr-1" data-toggle="modal" data-target="#add_participant" style="font-size: 14px;">
                <i class="fa-solid fa-upload"></i>
                Importé un participants
            </button>
            <button class="btn btn-secondary p-2 fw-bold w-50  ml-1" data-toggle="modal" data-target="#create_participant" style="font-size: 14px;">
                <i class="fa-solid fa-user-plus"></i>
                Créer un  participants
            </button>
        </div>
    </div>
</div>

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

    <div class="card-body px-4">
        <div class="btn-group w-100" role="group" aria-label="Basic outlined example">
            <a class="btn btn-outline-primary w-50 @if (request()->route()->getName() === 'event.show.groups') active @endif"
                href="{{ route('event.show.groups', $event) }}">Groupes</a>
            <a class="btn btn-outline-primary w-50 @if (request()->route()->getName() === 'event.show.participants') active @endif"
                href="{{ route('event.show.participants', $event) }}">Participants</a>
        </div>
    </div>
</div>
