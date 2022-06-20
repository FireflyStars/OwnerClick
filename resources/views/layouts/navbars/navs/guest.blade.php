<!-- Start Navbar Area -->
<div class="navbar-area navbar-style-three">
    <div class="pakap-responsive-nav">
        <div class="container">
            <div class="pakap-responsive-menu">
                <div class="logo">
                    <a href="{{ route('home.home') }}"><img src="/img/logob-min.png" alt="OwnerClick Logo"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="pakap-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand logo" href="{{ route('home.home') }}"><img src="/img/logob-min.png"  alt="logo"></a>
                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="{{route('guest.how-it-works')}}" class="nav-link">{{__('home.how_it_works')}}</a></li>
                        <li class="nav-item"><a href="{{route('guest.features')}}" class="nav-link">{{__('home.features')}}</a></li>
                        <li class="nav-item"><a href="{{route('guest.faq')}}" class="nav-link">{{__('home.faqs')}}</a></li>
                    </ul>
                    <div class="others-option">
                        <a href="{{ route('login') }}" class="btn-white-outline">
                            <i class="ri-login-box-line"></i>
                            @if(!Browser::isMobile()){{ __('login') }}@endif</a>
                        <a href="{{ route('register') }}" class="default-btn">{{ __('register') }}</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
