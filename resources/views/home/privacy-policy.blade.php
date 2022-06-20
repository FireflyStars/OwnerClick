@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'privacy_policy_short', 'title' => __('home.privacy_policy_short')])

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>{{__('home.privacy_policy_short')}}</h2>
            <ul>
                <li><a href="/">{{__('home')}}</a></li>
                <li>{{__('home.privacy_policy_short')}}</li>
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

<!-- Start How It Works Area -->
<div class="how-it-works-area ptb-100">
    <div class="container">
        <div class="privacy-policy-content">
                        {!! __('contracts.privacy-policy') !!}
        </div>
    </div>
</div>
<!-- End How It Works Area -->
@endsection
