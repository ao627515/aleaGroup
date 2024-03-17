@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
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

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-danger btn-block">
                                Se Déconnecter
                            </button>
                        </form>
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
                                <a class="nav-link " href="#activity" data-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class=" tab-pane " id="activity">
                                liste des utilisateurs
                            </div>
                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="settings">
                                <form action="{{ route('user.update', $user) }}" method="POST" id="personnal_data" class="mb-3">
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
                                            'label' => ['text' => 'Role'],
                                            'name' => 'role',
                                            'options' => ['admin' => 'Administrateur', 'user' => 'Utilisateur', ],
                                            'optionsParameters' => [
                                                'selected_with_value' => $user->role,
                                            ]
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
                                            'type' => 'password'
                                        ]" />

                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-3 col-form-label', 'col-sm-9'],
                                            'label' => ['text' => 'Nouveau Mot de passe'],
                                            'name' => 'new_password',
                                            'type' => 'password'
                                        ]" />

                                        <x-forms.input :all="[
                                            'group' => ['class' => 'mb-3'],
                                            'grid' => ['col-sm-3 col-form-label', 'col-sm-9'],
                                            'label' => ['text' => 'Confirmé le Mot de passe'],
                                            'name' => 'new_password_confirmation',
                                            'type' => 'password'
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
                            </div>
                            <!-- /.tab-pane -->
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
@endsection
