<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', auth()->user()->language) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titlePage }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icons/icon-96x96.png">
    <link rel="icon" type="image/png" href="/images/icons/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0,  user-scalable=0, shrink-to-fit=no' name='viewport' />
    @auth()
        <meta name="app-key" content="{{ env('VAPID_PUBLIC_KEY') }}">

    @endauth
    {{--    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />--}}
{{--    <meta name="viewport"--}}
{{--          content="viewport-fit=cover, width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>--}}
    <!--     Fonts and icons     -->
    {{--    <link rel="stylesheet" type="text/css" href="{{ asset('material') }}/css/css.css?family=Roboto:300,400,500,700|Roboto+Slab:400,700" />--}}
    {{--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    --}}
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ mix('css/fontawesome.css') }}">
    @mobile
    <link type="text/css" rel="stylesheet" href="{{ mix('css/mobile.css') }}">
    @endmobile
    <!-- CSS Files -->
    {{--    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />--}}
<!-- CSS Just for demo purpose, don't include it in your project -->
    {{--    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />--}}
    {{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">--}}

    {{--        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css" rel="stylesheet" />--}}
    {{--        <link href="/css/custom.css?v=2.1.1" rel="stylesheet" />--}}
    {{--        <link type="text/css" rel="stylesheet" href="{{ asset('bootstrap-fileinput') }}/css/fileinput.min.css">--}}
    {{--        <link href="{{ asset('fullcalendar/main.css') }}" rel="stylesheet">--}}

    @laravelPWA
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_TAG')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '{{env('GOOGLE_TAG')}}');
    </script>
    {{--        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>--}}
    {{--        <script>--}}

    {{--            // Enable pusher logging - don't include this in production--}}
    {{--            Pusher.logToConsole = true;--}}

    {{--            var pusher = new Pusher('84719b20eca13927eaf1', {--}}
    {{--                cluster: 'eu'--}}
    {{--            });--}}

    {{--            var channel = pusher.subscribe('my-channel');--}}
    {{--            channel.bind('my-event', function(data) {--}}
    {{--                alert(JSON.stringify(data));--}}
    {{--            });--}}
    {{--        </script>--}}
    <script>
        var userId = {{ \Illuminate\Support\Facades\Auth::id() }};
    </script>
    @stack('head')

</head>
<body class="{{ $class ?? '' }}">
@include('sweetalert::alert')
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.page_templates.auth')
@endauth
@guest()
    @include('layouts.page_templates.guest')
@endguest


<!--   Core JS Files   -->
{{--        <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>--}}
{{--        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>--}}
{{--        <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>--}}
{{--        <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>--}}
{{--        <!-- Plugin for the momentJs  -->--}}
{{--        <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>--}}

{{--        <!--  Plugin for Sweet Alert -->--}}
{{--        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}

<script src="{{ mix('js/app.js') }}"></script>

@mobile
<script src="{{ mix('js/jquery.touchSwipe.min.js') }}"></script>
@endmobile

<script src="{{ mix('js/guest.js') }}"></script>


{{--        <script src="{{ asset('moment') }}/locale/{{str_replace('_', '-', app()->getLocale())}}.js"></script>--}}

<!-- Forms Validations Plugin -->
{{--        <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>--}}
<!-- Plugin for the Wizard, full documentation here: https://github.cquery.dataTaom/VinceG/twitter-bootstrap-wizard -->
{{--        <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>--}}
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
{{--        <script src="/js/bootstrap-select.js"></script>--}}
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
{{--        <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>--}}
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
{{--        <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>--}}
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
{{--        <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>--}}
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
{{--        <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>--}}
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
{{--        <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>--}}
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
{{--        <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>--}}
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
{{--        <script src="{{ asset('material') }}/js/core.js"></script>--}}
<!-- Library for adding dinamically elements -->
{{--        <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>--}}
<!--  Google Maps Plugin    -->
{{--        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>--}}
<!-- Chartist JS -->
{{--        <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>--}}
<!--  Notifications Plugin    -->
{{--        <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>--}}
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
{{--        <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>--}}
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
{{--        <script src="{{ asset('material') }}/demo/demo.js"></script>--}}
{{--        <script src="{{ asset('material') }}/js/settings.js"></script>--}}
{{--        <script src="{{ asset('material') }}/js/jquery.dataTables.min.js"></script>--}}
{{--        <script src="{{ asset('material') }}/js/dataTables.bootstrap4.min.js"></script>--}}
{{--        <script src="{{ asset('bootstrap-fileinput') }}/js/fileinput.min.js"></script>--}}
{{--        <script src="{{ asset('bootstrap-fileinput') }}/themes/fas/theme.min.js"></script>--}}

<!-- Scripts -->
{{--    <script src="{{ asset('fullcalendar/main.js')}}"></script>--}}
{{--    <script src="{{ asset('fullcalendar/locales/'.str_replace('_', '-', app()->getLocale()).'.js')}}"></script>--}}

{{--<script src="{{ mix('js/custom.js') }}"></script>--}}

<script>

    $(document).ready(function () {
        //todo Datatable açılacak mı?
        //$('.dataTable').DataTable( {  responsive: true});

        @if(\Illuminate\Support\Facades\Auth::user()->confirm_profile_at === null)
        createModal('#confirmProfileModal')
        getAjax(null, '#confirmProfileModal .modal-dialog', '{{route('wizard.profile')}}', false, false, false)
        $('#confirmProfileModal').modal({
            show: false,
            backdrop: 'static'
        }).modal('show')
        @endif

    });
</script>
@auth
    <script src="{{ asset('js/enable-push.js') }}" defer></script>
@endauth
@stack('js')
@yield('js')

</body>
</html>
