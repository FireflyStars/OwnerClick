@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'user_agreement', 'title' => __('auth.user_agreement')])

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>{{__('auth.user_agreement')}}</h2>
            <ul>
                <li><a href="/">{{__('home')}}</a></li>
                <li>{{__('auth.user_agreement')}}</li>
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


<div class="how-it-works-area ptb-100">
    <div class="container">
        <div class="privacy-policy-content">
            {!! __('contracts.user-agreement') !!}
        </div>
    </div>
</div>
<!-- End How It Works Area -->
@endsection
