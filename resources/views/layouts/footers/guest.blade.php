    <!-- Start Footer Area -->
    <footer class="footer-area footer-style-two bg-black">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <a href="/" class="logo">
                            <img src="/img/logob-min.png" alt="logo">
                        </a>
                        <p>

                        {!! __('home.company_address') !!}<br/>
                            {{__('home.company_phone')}}
                        </p>
                        <ul class="social-links">
                            <li><a href="https://www.facebook.com/ownerclicktr/" target="_blank"><i class="ri-facebook-fill"></i></a></li>
                            <li><a href="https://twitter.com/ownerclick_tr" target="_blank"><i class="ri-twitter-fill"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/77039426/admin/" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
                            <li><a href="https://www.instagram.com/ownerclick_tr/" target="_blank"><i class="ri-instagram-fill"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget pl-2">
                        <h3>OwnerClick</h3>
                        <ul class="links-list">
                            <li><a href="{{route('guest.about-us')}}">{{__('home.about_us')}}</a></li>
                            <li><a href="{{ route('guest.partnership') }}">{{ __('partnership') }}</a></li>
                            <li><a href="{{route('contracts.user-agreement')}}">{{__('auth.user_agreement')}}</a></li>
                            <li><a href="{{route('contracts.privacy-policy')}}">{{__('home.privacy_policy_short')}}</a></li>
                            <li><a href="{{route('guest.contact')}}">{{__('home.contact')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="single-footer-widget">
                        <h3>{{__('home.links')}}</h3>
                        <ul class="links-list">
                          <!--  <li><a href="privacy-policy.html">Return Policy</a></li> -->
                            <li><a href="{{route('guest.features')}}">{{__('home.features')}}</a></li>
                            <li><a href="{{route('guest.faq')}}">{{__('home.faqs')}}</a></li>
                            <li><a href="{{route('guest.how-it-works')}}">{{__('home.how_it_works')}}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <p>{{__('home.mission')}}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="single-footer-widget">
                        <div class="single-footer-widget">
                            <div class="d-inline-block">
                                <img data-src="/img/browser.svg" src="/img/browser.svg" alt="{{__('home.use_on_browser')}}" class=" lazyloaded m-2" width="124" >
                                <img data-src="/img/appstore.svg" src="/img/appstore.svg" alt="{{__('home.use_on_appstore')}}" class=" lazyloaded m-2" width="124" >
                                <img data-src="/img/googleplay.svg" src="/img/googleplay.svg" alt="{{__('home.use_on_googleplay')}}" class=" lazyloaded m-2" width="124" >
                                <img data-src="/img/huawei-gallery.svg" src="/img/huawei-gallery.svg" alt="{{__('home.use_on_huaweigallery')}}" class=" lazyloaded m-2" width="124" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <p>Copyright @ {{ date("Y")}} <strong>{{__('home.company_name')}}</strong>. - {{__('home.all_right_reserved')}}</p>
            </div>
        </div>
    </footer>
    <!-- End Footer Area -->

