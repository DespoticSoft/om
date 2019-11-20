<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="perfect-scrollbar-off nav-open">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Office Management</title>
    {{--    font--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    {{--    Icon--}}
    <link href="{{ asset('adset/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('adset/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    {{--    Argon--}}
    <link href="{{ asset('adset/css/argon-dashboard.css?v=1.1.0') }}" rel="stylesheet" />

    {{--    mix--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <noscript> You need to enable JavaScript to run this app. </noscript>
    <div id="app"></div>

    <script src="{{ asset('adset/js/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adset/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--   Optional JS   -->
    <script src="{{ asset('adset/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('adset/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <!--   Argon JS   -->
    <script src="{{ asset('adset/js/argon-dashboard.min.js?v=1.1.0') }}"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });
    </script>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
