@extends('layouts.app')

@section('content')
    <div class="card sticky-top">
        <div class="card-header">
            <button class="btn btn-outline-primary">Imprimer</button>
            <button class="btn btn-outline-primary">Modifier</button>
            <button class="btn btn-outline-primary">Supprimer</button>
            <button class="btn btn-outline-primary">Ajouter un participants</button>
            <button class="btn btn-outline-primary">Creer un participants</button>
        </div>
        <div class="card-header px-5">
            <ul class="nav nav-pills ">
                <li class="nav-item w-50">
                    <a class="nav-link btn btn-outline-primary @if (true) active @endif" href=""
                        >Groupes</a>
                </li>

                <li class="nav-item w-50">
                    <a class="nav-link btn btn-outline-primary @if (true) active  @endif" href=""
                        >Participants</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
