<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('css')
    <link href="{{url('/vendor/adminlte/dist/css/adminlte.min.css')}}" rel="stylesheet">
    <link href="{{url('/')}}/assets/css/style.css?ver={{config('app.version')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('main')
    </div>
    @yield('js')
    <script src="{{url('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}/assets/js/main.js"></script>
    <script src="{{url('/')}}/assets/js/main.js"></script>
</body>
</html>