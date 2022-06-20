<?php if (!isset($activePage)) $activePage = ''; ?>
<!-- Navbar -->
<style>
    @media (max-width: 991px) {
        .sidebar::before, .off-canvas-sidebar nav .navbar-collapse::before {
            background-color: #f9f9f9 !important;
        }
    }
</style>
@if(Browser::isTablet() OR Browser::isDesktop())

<!-- Navbar -->
<nav class="d-none d-sm-block navbar navbar-expand-lg navbar-transparent navbar-absolute ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            {{--      <a class="navbar-brand" href="#">Burası Değişecek</a>--}}
            {{--@include('layouts.searchbox')--}}
            @include('layouts.searchbox')
        </div>

        <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Stats') }}
                        </p>
                    </a>
                </li>
                @include('layouts.notifications')
                <li class="nav-item dropdown">
                    <a class="nav-link d-inline-flex align-items-center" href="#pablo" id="navbarDropdownProfile"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{--            <i class="material-icons">person</i>--}}
                        {{--            <p class="d-lg-none d-md-block">--}}
                        {{--              {{ __('Account') }}--}}
                        {{--            </p>--}}
                        @if(\Illuminate\Support\Facades\Auth::user()->avatar != null)
                            <div class="profile-circle-mini-s m-auto"
                                 style="background: url('{{\Illuminate\Support\Facades\Auth::user()->avatar}}')"></div>
                        @else
                            <img src="/img/logor.png" style="width: 200px" class="m-auto" width="150"/>
                        @endif
                        {{--              <span class="">{{auth()->user()->name}}</span>--}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('dashboard.settings') }}</a>
                        {{--            <a class="dropdown-item" href="#">{{ __('Settings') }}</a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('dashboard.log_out') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@else
<nav class="d-block pt-0 d-sm-none navbar fixed-bottom bg-light">
    <div id="bottom-navigation" class="container-fluid ">

        <div class="d-flex justify-content-between">
            <div class="nav-item {{ $activePage == 'dashboard' ? ' active' : 'text-darkgray' }}">
                <a class="nav-link py-0 text-center small text-darkgray "
                   href="{{ route('dashboard') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true"
                   data-href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>Özet
                </a>
            </div>
            <div class="nav-item {{ $activePage == 'properties' ? ' active' : 'text-darkgray' }}">
                <a class="nav-link py-0 text-center small text-darkgray "
                   href="{{ route('properties.index') }}" data-toggle="ajax" data-target="#ajax-content"
                   data-redirect="true" data-href="{{ route('properties.index') }}">
                    <i class="material-icons">house</i>{{__('dashboard.property')}}</a>
            </div>
            <div class="nav-item {{ $activePage == 'persons' ? ' active' : 'text-darkgray' }}">
                <a class="nav-link py-0 text-center small text-darkgray"
                   href="{{route('home.events-info')}}" data-toggle="ajax" data-target="#ajax-content"
                   data-redirect="true" data-href="{{route('home.events-info')}}">
                    <i class="material-icons">event</i>{{__('dashboard.events')}}
                </a>
            </div>
            <div class="nav-item {{ $activePage == 'calendar'  ? ' active' : 'text-darkgray' }}">
                <a class="nav-link py-0 text-center small text-darkgray"
                   href="{{ route('calendar.index') }}" data-toggle="ajax" data-target="#ajax-content"
                   data-redirect="true" data-href="{{ route('calendar.index') }}">
                    <i class="material-icons">event</i>{{__('dashboard.calendar')}}
                    <div class="ripple-container"></div>
                    <div class="ripple-container"></div>
                </a>
            </div>
            {{--                <div class="nav-item {{ $activePage == 'fixtures' ? ' active' : 'text-darkgray' }}">--}}
            {{--                    <a class="nav-link py-0 text-center small text-darkgray"--}}
            {{--                       href="{{ route('fixtures.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('fixtures.index') }}">--}}
            {{--                        <i class="material-icons">event_seat</i>Demirbaş--}}
            {{--                        <div class="ripple-container"></div>--}}
            {{--                        <div class="ripple-container"></div>--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            <div class="nav-item {{ $activePage == 'payment-accounts' ? ' active' : 'text-darkgray' }}">
                <a class="nav-link py-0 text-center small text-darkgray"
                   href="{{ route('payment-accounts.index') }}" data-toggle="collapse" aria-controls="navigation-index"
                   aria-expanded="false" aria-label="Toggle navigation">
                    <button class="nav-link text-center small text-white navbar-toggler" type="button"
                            data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    {{ __('dashboard.more')}}
                </a>
                {{--                    <div class="nav-item">--}}
                {{--                        <button class="nav-link text-center small text-white navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">--}}
                {{--                            <span class="sr-only">Toggle navigation</span>--}}
                {{--                            <span class="navbar-toggler-icon icon-bar"></span>--}}
                {{--                            <span class="navbar-toggler-icon icon-bar"></span>--}}
                {{--                            <span class="navbar-toggler-icon icon-bar"></span>--}}
                {{--                        </button>--}}
                {{--                    </div>--}}
            </div>

        </div>
    </div>
</nav>


<nav id="mobile-header" class="p-1 fixed-top navbar" style="display: block">
    <div class="d-flex justify-content-between pt-2">
        {{--                <div class="nav-item">--}}
        {{--                    <a class="nav-link text-center small text-white" href="{{ route('properties.index') }}">--}}
        {{--                        <i class="fa fa-arrow-left"></i>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        @include('layouts.searchbox')

        @if(Browser::isMobile())
        <div style="height: 36px !important; overflow: hidden;">
            <img id="mobile-header-logo" src="/img/logob-min.png" style="height: 55px; object-fit: cover;"/>
            <div id="mobile-header-title" class="h5 text-white"></div>

        </div>
        @else
        <div id="header-title" class="font-weight-bold text-uppercase text-white">

            @if(isset($titlePage))
                {{--                        {{$titlePage}}--}}
            @else
                <img class="logo-header" src="/img/logob.png">
            @endif</div>
        {{--                @include('layouts.searchbox')--}}
        @endif
        <div id="notificationDropdown" data-href="{{route('push.notifications')}}"
             data-target="#navbarDropdownMenuLinkSection .notification-data">
            <a class="pr-3 text-white" href="{{route('push.notifications')}}" id="navbarDropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">notifications</i>
                <span class="notification"
                      style="{{(count(auth()->user()->unreadNotifications)==0)?'display:none':''}}">{{count(auth()->user()->unreadNotifications)}}</span>
            </a>
            <div id="navbarDropdownMenuLinkSection" class="dropdown-menu dropdown-menu-right"
                 aria-labelledby="navbarDropdownMenuLink">
                {{--        @foreach(auth()->user()->unreadNotifications as $notification)--}}
                {{--            <?php $prep = new \App\Models\Notification($notification); ?>--}}
                {{--            @if($prep->message)--}}
                {{--                <div class="dropdown-item d-block cursor-pointer d-flex p-3 border-bottom" href="#">--}}
                {{--                    <div class="justify-content-between pr-2"><div class="{{$prep->color}} m-auto notification-circle-mini text-white"><span class="material-icons">{{$prep->icon}}</span></div></div>--}}
                {{--                    <div class=" w-100">--}}
                {{--                        <div class="d-inline-flex justify-content-between align-items-end  w-100">--}}
                {{--                            <div class="font-weight-bold">{{$prep->title}}</div>--}}
                {{--                            <div class="text-gray font-small pl-3">{{$notification->created_at}}</div>--}}
                {{--                        </div>--}}
                {{--                        <div class="text-gray">{!! $prep->message !!}</div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            @endif--}}
                {{--        @endforeach--}}
                <div class="notification-data">

                </div>
                <div id="no-notification-section" class="text-center d-none"><i
                        class="fa fa-bell-slash fa-2x p-3 mt-3"></i><h5
                        class="mb-3">{{__('dashboard.no_notification')}}</h5></div>
                <div class="auto-load text-center">
                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
                         xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite"/>
                </path>
            </svg>
                </div>
            </div>
        </div>
    </div>
</nav>
@endif

