@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'about_us', 'title' => __('home.about_us')])

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{__('home.about_us')}}</h2>
                <ul>
                    <li><a href="/">{{__('home')}}</a></li>
                    <li>{{__('home.about_us')}}</li>
                </ul>
            </div>
        </div>
        <div class="divider"></div>
        <div class="lines text-muted">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="banner-shape1"><img src="/assets/img/shape/shape9.png" alt="image"></div>
    </div>
    <!-- End Page Title Area -->


    <div class="features-area partnership ">
        <div class="container-fluid px-2 px-sm-0 " style="height: auto;">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="features-content overview-content">
                        <h3><b>{{__('home.our_vision_title')}}</b></h3>
                        <p>{{__('home.our_vision_explain')}}
                        </p>
                        <h3><b>{{__('home.our_mission_title')}}</b></h3>
                        <p>{{__('home.our_mission_explain')}}
                        </p>
                        <h3><b>{{__('home.our_values_title')}}</b></h3>
                        <ul>
                            <li>{{__('home.our_vision_explain_list_1')}}</li>
                            <li>{{__('home.our_vision_explain_list_2')}}</li>
                            <li>{{__('home.our_vision_explain_list_3')}}</li>
                            <li>{{__('home.our_vision_explain_list_4')}}</li>
                            <li>{{__('home.our_vision_explain_list_5')}}</li>
                            <li>{{__('home.our_vision_explain_list_6')}}</li>
                        </ul>


                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="">
                        <div>
                            <img
                                src="/img/bilisimvadisi_ownerclick.jpg"/>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
