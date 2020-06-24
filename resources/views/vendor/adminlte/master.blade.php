<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 3'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    @if(! config('adminlte.enabled_laravel_mix'))
    <link rel="shortcut icon" href="/img/indice.ico" >
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @include('adminlte::plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.20/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/typeahead/typeahead.css') }}">

    @yield('adminlte_css')

    @else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')

@if(! config('adminlte.enabled_laravel_mix'))
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/ui.datepicker-pt-BR.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('plugins/numeral/numeral.min.js') }}"></script>
<script src="{{ asset('plugins/numeral/locales/pt-br.min.js') }}"></script>
<script src="{{ asset('plugins/masks/jquery.mask.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
<script src="/js/global/FormataDataClass.js"></script>

@include('adminlte::plugins', ['type' => 'js'])

@yield('adminlte_js')
@else
<script src="{{ asset('js/app.js') }}"></script>
@endif

</body>
</html>
