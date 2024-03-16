@if (session('success'))
    <x-alert type="success" :dismissible="true" :message="session('success')" />
@endif

@if (session('error'))
    <x-alert type="danger" :dismissible="true" :message="session('error')" />
@endif

@if (session('warning'))
    <x-alert type="warning" :dismissible="true" :message="session('warning')" />
@endif

@if (session('info'))
    <x-alert type="info" :dismissible="true" :message="session('info')" />
@endif

