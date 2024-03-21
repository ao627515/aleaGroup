<div class="card mb-3 border " style="max-width: 500px; border-radius: 30px;">
    <div class="row no-gutters">
        <div class="col-md-3" style="border-radius: 30px">
            <img src="{{ asset('dist/img/aleagroup_logo.jpeg') }}" alt="..."
                class="img-fluid border border-secondary" style="width: 100%; border-radius: 30px; border-color: #707070">
        </div>
        <div class="col-md-9">
            <div class="card-body py-3 px-3">
                {{-- <h5 class="card-title mb-3">{{ $event->getName() }}</h5> --}}
                <h5 class="card-title mb-2 text-dark">{{ \Str::limit($event->getName(),25)  }}</h5>
                <p class="card-text mb-2 text-dark">
                    Participant : {{ $event->participantsCount() }}
                </p>
                <p class="card-text"><small class="text-muted">Créer le {{ $event->getCreated_at() }}</small></p>
            </div>
        </div>
    </div>
</div>
