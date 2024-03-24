<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav m-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            {{ $header_title ?? '' }}
        </li>

    </ul>

    @if (request()->route()->getName() == 'event.show.participants' || request()->route()->getName() == 'event.show.groups')
        <ul class="navbar-nav" id="header_dropdown_sm">
            <li class="nav-item mr-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#update_event"
                    style="font-size: 14px;">
                    <i class="nav-icon fa-regular fa-pen-to-square"></i>
                </button>
            </li>
            <li class="nav-item mr-3">
                <button class="btn btn-danger" data-toggle="modal" data-target="#delete_event" style="font-size: 14px;">
                    <i class="nav-icon fa-solid fa-trash-can"></i>
                </button>
            </li>
        </ul>
    @endif
</nav>
