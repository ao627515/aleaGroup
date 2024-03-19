<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')

    <title>{{ $page_title ?? '' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- style custom -->
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('includes.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="px-5 mt-3">
                <x-msg-alert/>
            </div>
            <!-- Content Header (Page header) -->
            {{-- @include('includes.content_header') --}}

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        @include('includes.footer')

    </div>
    <!-- ./wrapper -->

    {{-- modal --}}
    <x-modal id="logout_user" title="Demande de confirmation">
        <x-slot name="body">
            Voullez-vous vous déconnectée ?
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-danger btn-block btn-primary confirmModal">
                    Oui
                </button>
            </form>
        </x-slot>
    </x-modal>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- js custom -->
    <script src="{{ asset('dist/js/modalScript.js') }}"></script>
    @yield('scripts')
</body>

</html>
