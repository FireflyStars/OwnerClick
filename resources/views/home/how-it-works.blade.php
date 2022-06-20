@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'how_it_works', 'title' => __('home.how_it_works')])

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>{{__('home.how_it_works')}}</h2>
            <ul>
                <li><a href="/">{{__('home')}}</a></li>
                <li>{{__('home.how_it_works')}}</li>
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
        <div class="how-it-works-content">
            <div class="number">1</div>
            <div class="row m-0">
                <div class="col-lg-3 col-md-12 p-0">
                    <div class="box">
                        <h3>{{__('how-it-works.step_1')}}</h3>
                        <span>{{__('how-it-works.step_1_title')}}</span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 p-0">
                    <div class="content">
                        <p>{{__('how-it-works.step_1_explain')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="how-it-works-content">
            <div class="number">2</div>
            <div class="row m-0">
                <div class="col-lg-3 col-md-12 p-0">
                    <div class="box">
                        <h3>{{__('how-it-works.step_2')}}</h3>
                        <span>{{__('how-it-works.step_2_title')}}</span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 p-0">
                    <div class="content">
                        <p>{{__('how-it-works.step_2_explain')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="how-it-works-content">
            <div class="number">3</div>
            <div class="row m-0">
                <div class="col-lg-3 col-md-12 p-0">
                    <div class="box">
                        <h3>{{__('how-it-works.step_3')}}</h3>
                        <span>{{__('how-it-works.step_3_title')}}</span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 p-0">
                    <div class="content">
                        <p>T{{__('how-it-works.step_3_explain')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="how-it-works-content">
            <div class="number">4</div>
            <div class="row m-0">
                <div class="col-lg-3 col-md-12 p-0">
                    <div class="box">
                        <h3>{{__('how-it-works.step_4')}}</h3>
                        <span>{{__('how-it-works.step_4_title')}}</span>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 p-0">
                    <div class="content">
                        <p>{{__('how-it-works.step_4_explain')}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End How It Works Area -->
@endsection
