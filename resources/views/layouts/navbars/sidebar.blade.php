<?php if(!isset($activePage)) $activePage = ''; ?>
<div class="sidebar" data-color="info" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/" class="simple-text logo-normal logo-bg">


    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
            <a class="nav-link"
               href="{{ route('dashboard') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('dashboard') }}">
                <i class="material-icons">dashboard</i>
                <p>{{__('dashboard.dashboard')}}</p>
            </a>
        </li>
        <li class="nav-item{{ $activePage == 'properties' ? ' active' : '' }}">
        <a class="nav-link"
           href="{{ route('properties.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('properties.index') }}">
          <i class="material-icons">house</i>
            <p>{{__('dashboard.properties')}}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'persons' ? ' active' : '' }}">
        <a class="nav-link"
           href="{{ route('persons.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('persons.index') }}">
          <i class="material-icons">person</i>
            <p>{{__('dashboard.persons')}}</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'contracts' ? ' active' : '' }}">
        <a class="nav-link"
            href="{{ route('contracts.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('contracts.index') }}">
          <i class="material-icons">assignment</i>
            <p>{{__('dashboard.contracts')}}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'fixtures' ? ' active' : '' }}">
        <a class="nav-link"
            href="{{ route('fixtures.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('fixtures.index') }}">
          <i class="material-icons">event_seat</i>
            <p>{{__('dashboard.fixtures')}}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'payment-accounts' ? ' active' : '' }}">
        <a class="nav-link"
            href="{{ route('payment-accounts.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('payment-accounts.index') }}">
          <i class="material-icons">account_balance</i>
            <p>{{__('dashboard.bank_accounts')}}</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'calendar' ? ' active' : '' }}">
        <a class="nav-link"
            href="{{ route('calendar.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('calendar.index') }}">
          <i class="material-icons">event</i>
            <p>{{__('dashboard.calendar')}}</p>
        </a>
      </li>
{{--      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">--}}
{{--        <a class="nav-link"--}}
{{--            href="{{ route('fixtures.index') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('fixtures.index') }}">--}}
{{--          <i class="material-icons">notifications</i>--}}
{{--          <p>{{ __('Notifications') }}</p>--}}
{{--        </a>--}}
{{--      </li>--}}
        @mobile
        <div class="dropdown-divider"></div>
        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
            <a class="nav-link"
               href="{{ route('profile.edit') }}">
                <i class="material-icons">person</i>
                <p>Profil</p>
            </a>
        </li>
{{--        <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">--}}
{{--            <a class="nav-link"--}}
{{--               href="{{ route('profile.edit') }}" data-toggle="ajax" data-target="#ajax-content" data-redirect="true" data-href="{{ route('profile.edit') }}">--}}
{{--                <i class="material-icons">edit</i>--}}
{{--                <p>Ayarlar</p>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item{{ $activePage == 'logout' ? ' active' : '' }}">
            <a class="nav-link"
               href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="material-icons text-danger">logout</i>
                <p class="font-weight-normal text-danger">Çıkış Yap</p>
            </a>
        </li>
        @endmobile
    </ul>
  </div>
</div>
