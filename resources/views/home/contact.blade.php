@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'contact', 'title' => __('home.contact')])

@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{__('home.contact')}}</h2>
                <ul>
                    <li><a href="/">{{__('home')}}</a></li>
                    <li>{{__('home.contact')}}</li>
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


    <!-- Start Contact Area -->
    <div class="contact-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                  @include('home.sections.contact-form')
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="maps">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3020.62030413046!2d29.50776421591245!3d40.79236087932329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cb219fb27ddacf%3A0x5e5dbea1b92cca7f!2sBili%C5%9Fim%20Vadisi!5e0!3m2!1str!2str!4v1640451643627!5m2!1str!2str"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->

    <!-- Start Contact Info Area -->
    <div class="contact-info-area pb-100">
        <div class="container">
            <div class="contact-info-inner">
                <h2>{{__('home.contact_explain')}}</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-contact-info-box">
                            <div class="icon bg1">
                                <i class="ri-customer-service-2-line"></i>
                            </div>
                            <h3><a href="tel:{{__('home.company_phone')}}">{{__('home.company_phone')}}<br/><br/><br/></a></h3>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-contact-info-box">
                            <div class="icon">
                                <i class="ri-earth-line"></i>
                            </div>
                            <h3><a href="mailto:{{__('home.company_mail')}}">{{__('home.company_mail')}}<br/><br/><br/></a></h3>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-contact-info-box">
                            <div class="icon bg2">
                                <i class="ri-map-pin-line"></i>
                            </div>
                            <h3>{!! __('home.company_address') !!}</h3>
                        </div>
                    </div>
                </div>
                <div class="lines">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Info Area -->

    @include('home.sections.try-ownerclick')
@endsection
