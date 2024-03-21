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
                            <td colspan="2">
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

    @include('events.show.modals')
@endsection
