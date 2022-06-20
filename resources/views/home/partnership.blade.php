@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'partnership', 'title' => __('partnership.title')])

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{__('partnership.h1')}}</h2>
                <ul>
                    <li><a href="/">{{__('home')}}</a></li>
                    <li>{{__('partnership.title')}}</li>
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


    <div class="features-area partnership ptb-100">
        <div class="container px-2 px-sm-0 " style="height: auto;">
            <div class="row align-items-start">
                <div class="col-lg-8 col-md-12">
                    <div class="features-content">
                        <h2><b>{{__('partnership.h1')}}</b></h2>
                        <p>
                            {{__('partnership.first_paragrapht')}}
                        </p>
                        <ul class="features-list">
                            <li>
                                <div class="bg-gradient icon text-black-50">
                                    <i class="ri-shopping-cart-2-line"></i>
                                </div>
                                <h3>{{__('partnership.marketing')}}</h3>
                                <p>{{__('partnership.partnership-explain-1')}}</p>
                            </li>
                            <li>
                                <div class="bg-gradient icon text-black-50">
                                    <i class="ri-auction-line"></i>
                                </div>
                                <h3>{{__('partnership.legal')}}</h3>
                                <p>{{__('partnership.partnership-explain-2')}}</p>
                            </li>
                            <li>
                                <div class="bg-gradient icon text-black-50">
                                    <i class="ri-currency-line"></i>
                                </div>
                                <h3>{{__('partnership.payment')}}</h3>
                                <p>{{__('partnership.partnership-explain-3')}}</p>
                            </li>
                            <li>
                                <div class="bg-gradient icon text-black-50">
                                    <i class="ri-user-2-line"></i>
                                </div>
                                <h3>{{__('partnership.consultancy')}}</h3>
                                <p>{{__('partnership.partnership-explain-4')}}</p>
                            </li>
                            <li>
                                <div class="bg-gradient icon text-black-50">
                                    <i class="ri-add-line"></i>
                                </div>
                                <h3>{{__('partnership.other')}}</h3>
                                <p> {{__('partnership.partnership-explain-last')}}</p>
                            </li>
                        </ul>
                        <h2 class="pt-5"><b>{{__('partnership.h4')}}</b></h2>
                        <p>
                            {{__('partnership.h4_explain')}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    @include('home.sections.contact-form')

                </div>
            </div>
        </div>
        <div class="bg-shape1"><img src="/assets/img/shape/bg-shape1.png" alt="bg-shape"></div>

    </div>


@endsection
