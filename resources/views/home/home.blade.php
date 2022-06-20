@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('home.title'),
'metaDescription' => __('home.meta_description') ])

@section('content')
    <!-- Start Gradient Banner Area -->
    <div class="gradient-banner-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="overview-content gradient-banner-content">
                        <h1><div>{{ __('home.main_slogan_header_2_1') }}</div><div>{{ __('home.main_slogan_header_2_2') }}</div></h1>
                        <h3>{{ __('home.main_slogan_header') }}</h3>
                        <p>{{ __('home.main_slogan') }}</p>
                        <div class="row align-items-center pt-4">
                            <div class="col-md-12">
                                <a id="request-demo" href="{{ route('register') }}"
                                   class="btn-white-outline">{{__('home.free_trail')}}</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12 ">
                    <div class="gradient-banner-image" data-aos="fade-up">
                        <img src="/img/devices8.png"  alt="banner-img">
                    </div>

                </div>
            </div>
        </div>
        <div class="banner-shape1"><img src="/assets/img/shape/shape9.png" alt="image"></div>
    </div>
    <!-- End Gradient Banner Area -->


    <!-- Start App Progress Area -->
    <div class="app-progress-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="app-progress-image text-center">
                        <img src="/img/ownerclick_property.png" alt="app-img" data-aos="fade-up" class="aos-init aos-animate">
                        <div class="d-inline-block">
                            <img data-src="/img/browser.svg" src="/img/browser.svg" alt="{{__('home.use_on_browser')}}" class=" lazyloaded m-2" width="124" >
                            <img data-src="/img/appstore.svg" src="/img/appstore.svg" alt="{{__('home.use_on_appstore')}}" class=" lazyloaded m-2" width="124" >
                            <img data-src="/img/googleplay.svg" src="/img/googleplay.svg" alt="{{__('home.use_on_googleplay')}}" class=" lazyloaded m-2" width="124" >
                            <img data-src="/img/huawei-gallery.svg" src="/img/huawei-gallery.svg" alt="{{__('home.use_on_huaweigallery')}}" class=" lazyloaded m-2" width="124" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="app-progress-content">
                        <span class="sub-title">{{__('home.what_is_ownerclick')}}</span>
                        <h2>{{__('home.what_is_ownerclick_subtitle')}}</h2>
                        <p>{{__('home.what_is_ownerclick_explain_1')}}</p>
                        <p>{{__('home.what_is_ownerclick_explain_2')}}</p>

                        <a href="{{ route('register') }}" class="default-btn">{{__('home.free_trail')}}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End App Progress Area -->

    <!-- Start Features Area -->
    <div class="features-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">{{__('home.why_ownerclick')}}</span>
                <h3>{{__('home.why_ownerclick_subtitle')}}</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                    <div class="single-features-item without-hover">
                        <div class="icon">
                            <i class="ri-funds-line"></i>
                        </div>
                        <h3>{{__('home.feature_title_1')}}</h3>
                        <p>{{__('home.feature_explain_1')}}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                    <div class="single-features-item without-hover">
                        <div class="icon bg2">
                            <i class="ri-file-paper-line"></i>
                        </div>
                        <h3>{{__('home.feature_title_2')}}</h3>
                        <p>{{__('home.feature_explain_2')}}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                    <div class="single-features-item without-hover">
                        <div class="icon bg3">
                            <i class="ri-shield-check-line"></i>
                        </div>
                        <h3>{{__('home.feature_title_3')}}</h3>
                        <p>{{__('home.feature_explain_3')}}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                    <div class="single-features-item without-hover">
                        <div class="icon bg4">
                            <i class="ri-bar-chart-2-line"></i>
                        </div>
                        <h3>{{__('home.feature_title_4')}}</h3>
                        <p>{{__('home.feature_explain_4')}}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                    <div class="single-features-item without-hover">
                        <div class="icon bg5">
                            <i class="ri-exchange-line"></i>
                        </div>
                        <h3>{{__('home.feature_title_5')}}</h3>
                        <p>{{__('home.feature_explain_5')}}</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                    <div class="single-features-item without-hover">
                        <div class="icon bg6">
                            <i class="ri-notification-4-line"></i>
                        </div>
                        <h3>{{__('home.feature_title_6')}}</h3>
                        <p>{{__('home.feature_explain_6')}}</p>
                    </div>
                </div>

            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                <div class="view-more-box">
                    <a href="{{route('guest.features')}}" class="default-btn">{{__('home.all_features_button')}}</a>
                </div>
            </div>

        </div>
    </div>
    <!-- End Features Area -->

    <!-- Start Features Area -->
    <div class="features-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="features-content">
                        <h2>{{ __('home.who_can_use') }}</h2>
                        <p>{{ __('home.who_can_use_explain') }}</p>
                        <ul class="features-list">
                            <li>
                                <div class="icon bg1">
                                    <i class="ri-user-line"></i>
                                </div>
                                <h3>{{__('owners')}}</h3>
                                <p>{{__('home.use_owners')}}</p>
                            </li>
                            <li>
                                <div class="icon bg2">
                                    <i class="ri-user-2-line"></i>
                                </div>
                                <h3>{{__('property_specialists')}}</h3>
                                <p>{{__('home.use_property_specialists')}}</p>
                            </li>

                            <li>
                                <div class="icon bg3">
                                    <i class="ri-team-line"></i>
                                </div>
                                <h3>{{__('home.companies')}}</h3>
                                <p>{{__('home.use_companies')}}</p>
                            </li>
                            <li>
                                <div class="icon bg4">
                                    <i class="ri-group-line"></i>
                                </div>
                                <h3>{{__('tenants')}}</h3>
                                <p>{{__('home.use_tenants')}}</p>
                            </li>
                        </ul>
                        <div class="btn-box">
                            <a href="{{ route('register') }}" class="default-btn">{{__('home.free_trail')}}</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="features-image text-center who-use">
                        <!--<img src="assets/img/app/app-img1.png" alt="app-img" data-aos="fade-up">-->
                        <img src="/img/ownerclick_mobile_screen.png" alt="app-img" data-aos="fade-up">
                                       <div class="shape">
                            <img class="shape3" src="assets/img/shape/shape2.png" alt="shape">
                            <img class="shape4" src="assets/img/shape/shape3.png" alt="shape">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-shape1"><img src="assets/img/shape/bg-shape1.png" alt="bg-shape"></div>
    </div>
    <!-- End Features Area -->



    <!-- Start Software Integrations Area -->
    <div class="software-integrations-area bg-gradient-color ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="software-integrations-content white-color">
                        <span class="sub-title">{{__('home.integrations')}}</span>
                        <h2>{{__('home.integrations_subtitle')}}</h2>
                        <p>{{__('home.integrations_explain')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="software-integrations-list">
                        <img src="assets/img/shape/border.png" alt="border">
                        <ul>
                            <li data-aos="fade-down">
                                <img src="/img/visa.png" class="integration-list" alt="Visa">
                              <!--  <i class="ri-emotion-unhappy-line"></i>-->
                                <!--   <i class="ri-money-dollar-circle-line"></i> -->
                             </li>
                             <li data-aos="fade-right">
                                 <img src="/img/mastercard.png" class="integration-list" alt="Visa">
                                <!--    <i class="ri-open-arm-fill"></i> -->
                            </li>
                            <li data-aos="fade-up">
                                <img src="/img/troy.png" class="integration-list" alt="Visa">
                               <!--    <i class="ri-exchange-dollar-fill"></i> -->
                            </li>
                            <li data-aos="fade-down">
                                <img src="/img/drive.png" class="integration-list" alt="Visa">
                             <!--   <i class="ri-folder-3-line"></i> -->
                            </li>
                            <li data-aos="fade-up">
                                <img src="/img/onedrive.jpg" class="integration-list" alt="Visa">
                                <!-- <i class="ri-bank-line"></i> -->
                            </li>
                            <li><img src="/img/logor-icon.png" class="frame" alt="OwnerClick Logo"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape8"><img src="assets/img/shape/shape7.png" alt="shape"></div>
    </div>
    <!-- End Software Integrations Area -->

    <!-- Start App Progress Area -->
    <div class="app-progress-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="app-progress-image text-center">
                        <img src="/img/property_management_software.png" alt="app-img" data-aos="fade-right" class="aos-init aos-animate">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="app-progress-content">
                        <span class="sub-title">{{__('home.problem_solutions_title')}}</span>
                        <h2>{{__('home.problem_solutions_subtitle')}}</h2>
                        <ul class="problem-list">
                            <li><div class="icon">
                                    <i class="ri-emotion-unhappy-line"></i>
                                </div><span>{{__('home.problem_solutions_list_1')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-bank-card-line"></i>
                                </div><span>{{__('home.problem_solutions_list_2')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-funds-line"></i>
                                </div><span>{{__('home.problem_solutions_list_3')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-exchange-box-line"></i>
                                </div><span>{{__('home.problem_solutions_list_4')}}</span>
                            </li>
                            <li><div class="icon">
                                    <i class="ri-draft-line"></i>
                                </div><span>{{__('home.problem_solutions_list_5')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-folders-line"></i>
                                </div><span>{{__('home.problem_solutions_list_6')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-auction-line"></i>
                                </div><span>{{__('home.problem_solutions_list_7')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-hammer-line"></i>
                                </div><span>{{__('home.problem_solutions_list_8')}}</span></li>
                            <li><div class="icon">
                                    <i class="ri-door-line"></i>
                                </div><span>{{__('home.problem_solutions_list_9')}}</span></li>
                        </ul>
                        <p>{{__('home.problem_solutions_list_explain')}}</p>
                        <a href="{{ route('register') }}" class="default-btn">{{__('register')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End App Progress Area -->

    <!-- Start Software Integrations Area -->
@include('home.sections.try-ownerclick')
    <!-- End Software Integrations Area -->





    <!--<div id="get-in-touch" class="container" style="height: auto;">

        <div class="row pt-5 justify-content-center text-dark">
            <div class="col-lg-12">
                <div class="section_tittle text-center">
                    {{--                    <i class="bigBlueIcon fa fa-angle-double-down"></i>--}}
        <h2>{{__('home.get_in_touch')}}</h2>
                    <p>{{__('home.get_in_touch_explain')}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 ml-auto mr-auto">
            <form method="post" action="{{ route('contact.store') }}#get-in-touch">
                @csrf

        <div class=" card-login card-hidden mb-3">

@if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert h4 text-center text-success">
{{\Illuminate\Support\Facades\Session::get('success')}}
            </div>
@else
        <div class="">

            <div class="row">
                <div
                    class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3 col-12 col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-address-book"></i></span></div>
                                        <input placeholder="{{__('name')}}" type="text" class="form-control" name="name"
                                               id="name" value="{{ old('name')}}">
                                    </div>
                                    @if ($errors->has('name'))
            <div id="name-error" class="error text-danger pl-3" for="name"
                 style="display: block;">
                <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif </div>

                                <div
                                    class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3 col-12 col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-envelope"></i></span></div>
                                        <input placeholder="{{__('email')}}" type="email" class="form-control"
                                               name="email" id="email" value="{{ old('email')}}">
                                    </div>
                                    @if ($errors->has('email'))
            <div id="email-error" class="error text-danger pl-3" for="email"
                 style="display: block;">
                <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif </div>

                                <div
                                    class="bmd-form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mt-3 col-12 col-md-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-phone"></i></span></div>
                                        <input placeholder="{{__('phone')}}" type="text" class="form-control"
                                               name="phone" id="phone" value="{{ old('phone')}}">
                                    </div>
                                    @if ($errors->has('phone'))
            <div id="phone-error" class="error text-danger pl-3" for="phone"
                 style="display: block;">
                <strong>{{ $errors->first('phone') }}</strong>
                                        </div>
                                    @endif </div>
                            </div>
                            <div class="row">
                                <div
                                    class="bmd-form-group{{ $errors->has('subject') ? ' has-danger' : '' }} mt-3 col-12 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-quote-right"></i></span></div>
                                        <input placeholder="{{__('subject')}}" type="text" class="form-control"
                                               name="subject" id="subject" value="{{ old('subject')}}">
                                    </div>
                                    @if ($errors->has('subject'))
            <div id="subject-error" class="error text-danger pl-3" for="subject"
                 style="display: block;">
                <strong>{{ $errors->first('subject') }}</strong>
                                        </div>
                                    @endif</div>
                            </div>
                            <div class="row">
                                <div
                                    class="bmd-form-group{{ $errors->has('message') ? ' has-danger' : '' }} mt-3 col-12 ">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-comment"></i></span></div>
                                        <textarea class="form-control" name="message" id="message" rows="4"
                                                  placeholder="{{__('your_messages')}}">{{ old('message')}}</textarea>
                                    </div>
                                    @if ($errors->has('message'))
            <div id="message-error" class="error text-danger pl-3" for="message"
                 style="display: block;">
                <strong>{{ $errors->first('message') }}</strong>
                                        </div>
                                    @endif</div>

                            </div>
                        </div>
                        <div class=" justify-content-center text-right">
                            <button type="submit" class="btn btn-info btn-link btn-lg">{{__('send')}}</button>
                        </div>
                    @endif
        </div>
    </form>

</div>

</div>
-->
@endsection
@section('js')

@endsection
