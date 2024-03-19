<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('event.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AléaGroup Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AléaGroup</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar_p.jpeg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.show', auth()->user()) }}"
                    class="d-block">{{ ucwords(auth()->user()->name) }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link @if (request()->segment(1) === 'event') active @endif">
                        <i class="nav-icon fa-solid fa-layer-group"></i>
                        <p>
                            Evènements
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('participant.index') }}"
                        class="nav-link @if (request()->segment(1) === 'participant') active @endif">
                        <i class="nav-icon fa-solid fa-user-plus"></i>
                        <p>
                            Participants
                            {{-- <span class="badge badge-info right">{{ App\Models\Participant::count() }}</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.show', auth()->user()) }}"
                        class="nav-link @if (request()->segment(1) === 'user') active @endif">
                        <i class="nav-icon fa-solid fa-id-badge"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-danger" data-toggle="modal"
                        data-target="#logout_user" style="cursor: pointer">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                         <p>
                            Se Déconnecter
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
