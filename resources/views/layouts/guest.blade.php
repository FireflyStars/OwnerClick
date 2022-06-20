<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="/images/icons/icon-96x96.png">
    <link rel="icon" type="image/png" href="/images/icons/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=5.0, shrink-to-fit=no' name='viewport' />
        @if(isset($metaDescription))
    <meta name="description" content="{{$metaDescription}}">
        @endif

        <!--     Fonts and icons     -->
        @foreach(LaravelLocalization::getSupportedLocales() as $key => $language)
        <link rel="alternate" href="{{ LaravelLocalization::getLocalizedURL($key,route(\Illuminate\Support\Facades\Route::currentRouteName()))}}" hreflang="{{$key}}" />
        @endforeach
        <link rel="alternate" href="{{LaravelLocalization::getLocalizedURL('en',route(\Illuminate\Support\Facades\Route::currentRouteName()))}}" hreflang="x-default" />

        <link rel="stylesheet" href="{{mix('css/guest.css')}}">


        @laravelPWA
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_TAG')}}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{env('GOOGLE_TAG')}}');
        </script>
    </head>
    <body>
    @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest

    <div class="go-top"><i class="ri-arrow-up-s-line"></i></div>
        <!--   Core JS Files   -->
    <script src="{{mix('js/guest.js')}}"></script>

        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
{{--        <script src="{{ mix('/js/material-dashboard.js') }}" type="text/javascript"></script>--}}

        @yield('js')
        @stack('js')
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/25297811.js"></script>
    <!-- End of HubSpot Embed Code -->
    </body>
</html>
