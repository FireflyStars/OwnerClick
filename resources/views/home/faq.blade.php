@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'faqs', 'title' => __('home.faqs')])

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h2>{{__('home.faqs')}}</h2>
            <ul>
                <li><a href="/">{{__('home')}}</a></li>
                <li>{{__('home.faqs')}}</li>
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
<div class="faq-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="faq-accordion accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">{{__('faqs.q1')}}</button>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion" style="">
                            <div class="accordion-body">
                                <p>{{__('faqs.a1')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">{{__('faqs.q2')}}</button>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion" style="">
                            <div class="accordion-body">
                                <p>{{__('faqs.a2')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">{{__('faqs.q3')}}</button>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>{{__('faqs.a3')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">{{__('faqs.q4')}}</button>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>{{__('faqs.a4')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">{{__('faqs.q5')}}</button>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>{{__('faqs.a5')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Features Area -->
@include('home.sections.try-ownerclick')
@endsection
