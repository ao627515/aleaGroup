@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-5/css/bootstrap.min.css') }}">
@endsection

@section('content')
    @include('includes.events.content_header')
    <div class="card">
        <div class="container">
            <div class="card-body">
                <div class="container">
                    <h3 class="text-center mb-3">Paramètres de génération</h3>
                    <div class="card m-auto" style="max-width: 540px">
                        @if ($errors->has('groupsGenerateErrors'))
                            <div class="alert alert-danger text-center">
                                {{ $errors->first('groupsGenerateErrors') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="p-3">
                            <form action="{{ route('groups.generate', $event) }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <x-forms.input :all="[
                                            'label' => ['text' => 'Nombre de groupes'],
                                            'name' => 'groups',
                                            'type' => 'number',
                                            'value' => $event->groupsCount() != 0 ? $event->groupsCount() : 0,
                                        ]" />
                                    </div>

                                    <div class="col">
                                        <x-forms.input :all="[
                                            'label' => ['text' => 'Nombre de membres'],
                                            'name' => 'members',
                                            'type' => 'number',
                                            'value' => !$event->groupsCount() ? 1 : ($event->groups()->first()->membersCount() == 0 ? 1 : $event->groups()->first()->membersCount())
                                        ]" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="submit" class="btn btn-primary">Générer</button>
                                        <button type="button" class="btn btn-secondary example-popover"
                                        data-bs-toggle="popover" data-bs-placement="bottom">
                                        {{-- <i class="fa-solid fa-info"></i> --}}
                                        <i class="fa-solid fa-circle-info"></i>
                                      </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!$records->isEmpty())
        <div class="card py-3 px-5">
            <div class="container">
                @foreach ($records as $value)
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="{{ '#panelsStayOpen-collapse-' . $value->number }}" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    <i class="me-3 fa-solid fa-users-line"></i>
                                    Groupe {{ $value->number }}
                                </button>
                            </h2>
                            <div id="{{ 'panelsStayOpen-collapse-' . $value->number }}"
                                class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <table class="table table-striped">
                                        <tbody>
                                            @foreach ($value->members as $member)
                                                <tr>
                                                    <td>{{ $member->getName() }}</td>
                                                    {{-- <td class="w-25">actions</td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @include('events.show.modals')

@endsection

@section('scripts')
    <script src="{{ asset('plugins/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        const popover = new bootstrap.Popover('.example-popover', {
            title: 'Génération de groupes',
            container: 'body',
            content: 'asdvvrvr<br>dwa',
            html: true
        })
    </script>
@endsection
