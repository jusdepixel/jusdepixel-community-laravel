<!doctype html>
<html lang="fr">
@include('layout/head')
<body>
    @include('layout/background')
    @include('layout/header')

    <main class="container mt-5 mb-5">
        @if(Session::has('message'))
            <p class="mb-5 alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>
