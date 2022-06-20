<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
      <div id="ajax-content" class="content">
    @yield('content')
      </div>
    @include('layouts.footers.auth')
  </div>
</div>
