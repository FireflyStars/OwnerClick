@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'features', 'title' => __('home.features')])

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>{{__('home.features')}}</h2>
            <ul>
                <li><a href="/">{{__('home')}}</a></li>
                <li>{{__('home.features')}}</li>
            </ul>
        </div>
    </div>
    <div class="divider"></div>
    <div class="lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <div class="banner-shape1"><img src="/assets/img/shape/shape9.png" alt="image"></div>
</div>
<!-- End Page Title Area -->

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
            <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                <div class="single-features-item without-hover">
                    <div class="icon bg5">
                        <i class="ri-keynote-line"></i>
                    </div>
                    <h3>{{__('home.feature_title_7')}}</h3>
                    <p>{{__('home.feature_explain_7')}}</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                <div class="single-features-item without-hover">
                    <div class="icon bg4">
                        <i class="ri-home-smile-line"></i>
                    </div>
                    <h3>{{__('home.feature_title_8')}}</h3>
                    <p>{{__('home.feature_explain_8')}}</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                <div class="single-features-item without-hover">
                    <div class="icon bg3">
                        <i class="ri-wallet-line"></i>
                    </div>
                    <h3>{{__('home.feature_title_9')}}</h3>
                    <p>{{__('home.feature_explain_9')}}</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                <div class="single-features-item without-hover">
                    <div class="icon bg2">
                        <i class="ri-bank-line"></i>
                    </div>
                    <h3>{{__('home.feature_title_10')}}</h3>
                    <p>{{__('home.feature_explain_10')}}</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                <div class="single-features-item without-hover">
                    <div class="icon bg1">
                        <i class="ri-team-line"></i>
                    </div>
                    <h3>{{__('home.feature_title_11')}}</h3>
                    <p>{{__('home.feature_explain_11')}}</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
                <div class="single-features-item without-hover">
                    <div class="icon bg6">
                        <i class="ri-smartphone-line"></i>
                    </div>
                    <h3>{{__('home.feature_title_12')}}</h3>
                    <p>{{__('home.feature_explain_12')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Features Area -->
@include('home.sections.try-ownerclick')
@endsection
