@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/avatar_p.jpeg') }}"
                                alt="User profile picture" />
                        </div>

                        <h3 class="profile-username text-center">
                            {{ $user->getName() }}
                        </h3>

                        <p class="text-muted text-center">
                            {{ $user->getRole() }}
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Evènements</b>
                                <a class="float-right">??</a>
                            </li>
                            <li class="list-group-item">
                                <b>Participants</b>
                                <a class="float-right">??</a>
                            </li>
                        </ul>

                        @if ($user->id === auth()->user()->id)
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-danger btn-block">
                                    Se Déconnecter
                                </button>
                            </form>
                        @endif
                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link @if(!$isUsersListPage)active @endif" href="#settings" data-toggle="tab">Paramètres</a>
                            </li>
                            @if ($user->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link @if($isUsersListPage)active @endif" href="#users_list" data-toggle="tab">Utilisateurs</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane @if(!$isUsersListPage) active @endif" id="settings">
                                <form action="{{ route('user.update', $user) }}" method="POST" id="personnal_data"
                                    class="mb-3">
                                    @csrf
                                    @method('put')
                                    <fieldset class="border px-5">
                                        <legend>Infos personnel</legend>
                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-2 col-form-label', 'col-sm-10'],
                                            'label' => ['text' => 'Nom'],
                                            'name' => 'name',
                                            'value' => $user->getName(),
                                        ]" />

                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-2 col-form-label', 'col-sm-10'],
                                            'label' => ['text' => 'Téléphone'],
                                            'name' => 'phone',
                                            'value' => $user->phone,
                                        ]" />

                                        <x-forms.select :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-2 col-form-label', 'col-sm-10'],
                                            'label' => ['text' => 'Rôle'],
                                            'name' => 'role',
                                            'options' => ['admin' => 'Administrateur', 'user' => 'Utilisateur'],
                                            'optionsParameters' => [
                                                'selected_with_key' => $user->role,
                                            ],
                                        ]" />
                                        <div class="form-group row">
                                            <div class="offset-sm-5 col-sm-7">
                                                <button type="submit" form="personnal_data" class="btn btn-info">
                                                    Soumettre
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                                <form action="{{ route('password.update') }}" method="POST" id="change_password">
                                    @csrf
                                    @method('put')
                                    <fieldset class="border mb-3 px-5">
                                        <legend>Mots de passe</legend>

                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-3 col-form-label', 'col-sm-9'],
                                            'label' => ['text' => 'Ancien Mot de passe'],
                                            'name' => 'current_password',
                                            'type' => 'password',
                                        ]" />

                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-3 col-form-label', 'col-sm-9'],
                                            'label' => ['text' => 'Nouveau Mot de passe'],
                                            'name' => 'new_password',
                                            'type' => 'password',
                                        ]" />

                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-3 col-form-label', 'col-sm-9'],
                                            'label' => ['text' => 'Confirmé le Mot de passe'],
                                            'name' => 'new_password_confirmation',
                                            'type' => 'password',
                                        ]" />
                                        <div class="form-group row">
                                            <div class="offset-sm-5 col-sm-7">
                                                <button type="submit" form="change_password" class="btn btn-info">
                                                    Soumettre
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>

                                @can('update', $user)
                                    <form action="{{ route('user.destroyAccount', $user) }}" method="post" class="form-action"
                                        id="destroy_account">
                                        <fieldset class="border mb-3 px-5 py-2">
                                            <legend>Compte</legend>
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger action-btn mb-3" data-toggle="modal"
                                                data-target="#delete_account">
                                                Supprimer mon compte
                                            </button>
                                        </fieldset>
                                    </form>
                                @endcan

                            </div>
                            <!-- /.tab-pane -->
                            @if ($user->isAdmin())
                                <div class="tab-pane @if($isUsersListPage) active @endif" id="users_list">
                                    <div class="mb-3">
                                        <div class="card-header px-5">
                                            <form id="f_search">
                                                @csrf
                                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6  ">
                                                    <div class="col">
                                                        <x-forms.input :all="[
                                                            'label' => ['text' => 'Nom'],
                                                            'name' => 'f_search_name',
                                                            'type' => 'text',
                                                        ]" />
                                                    </div>
                                                    <div class="col">
                                                        <x-forms.input :all="[
                                                            'label' => ['text' => 'Tel'],
                                                            'name' => 'f_search_phone',
                                                            'type' => 'text',
                                                        ]" />
                                                    </div>
                                                    <div class="col">
                                                        <x-forms.select :all="[
                                                            'label' => ['text' => 'Rôle'],
                                                            'name' => 'f_search_role',
                                                            'options' => ['admin' => 'Administrateur', 'user' => 'Utilisateur'],
                                                            'defaultOption' => ['text' => 'Sélectionnée un rôle']
                                                        ]" />
                                                    </div>
                                                    <div class="col">
                                                        <x-forms.input :all="[
                                                            'label' => ['text' => 'Inscrit le'],
                                                            'name' => 'f_search_created_at',
                                                            'type' => 'date',
                                                        ]" />
                                                    </div>

                                                    <div class="col">
                                                        <div class="mb-2 text-white">ergfh</div>
                                                        <button type="submit" form="f_search"
                                                            class="btn btn-primary ">{{ __('Rechercher') }}</button>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-2 text-white">ergfh</div>
                                                        <button type="reset" form="f_search"
                                                            class="btn btn-info ">{{ __('Réénitialisé') }}</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <h2>Liste des utilisateurs</h2>
                                    {{-- table-responsive --}}
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Téléphone</th>
                                                <th>Rôle</th>
                                                <th>Inscrit le</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($records as $value)
                                                <tr>
                                                    <td>{{ $value->getName() }} </td>
                                                    <td>{{ $value->getPhone() }}</td>
                                                    <td>{{ $value->getRole() }}</td>
                                                    <td>{{ $value->getCreated_at() }}</td>
                                                    <td class="d-flex justify-content-around">
                                                        <a href="{{ route('user.show', $value) }}"
                                                            class="btn btn-info">{{ __('Voir') }}</a>
                                                        @if ($value->id === auth()->user()->id)
                                                            <form action="{{ route('user.destroy', $value) }}"
                                                                method="post" class="form-action">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="button" class="btn btn-danger action-btn"
                                                                    data-toggle="modal" data-target="#delete_user">
                                                                    Supprimer
                                                                </button>
                                                            </form>
                                                        @endif
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
                                    <div class="float-right p-3">
                                        {{ $records->appends(request()->except('page'))->links() }}
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            @endif
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <x-modal id="delete_user" title="Demande de confirmation">
        <x-slot name="body">
            Voullez-vous supprimer cet utilisateur ?
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-primary confirmDelete">Oui</button>
        </x-slot>
    </x-modal>

    <x-modal id="delete_account" title="Demande de confirmation">
        <x-slot name="body">
            Voullez-vous supprimer votre compte ?
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <button type="button" class="btn btn-primary confirmDelete">Oui</button>
        </x-slot>
    </x-modal>
@endsection

@section('scripts')
    <script src="{{ asset('dist/js/modalScript.js') }}"></script>
@endsection
