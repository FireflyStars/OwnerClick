@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'request-demo', 'title' => __('request-demo.title')])

@section('content')
    <div class="container  px-2 px-sm-0" style="height: auto;">
        <div class="row align-items-start">
            <div class="d-lg-block col-md-8 ml-auto mr-auto mb-3 text-left">
                <h1><b>{{ __('request-demo.h1') }}</b></h1>
                <p>
                    {{ __('request-demo.first_paragrapht') }}

                </p>
                {{ __('request-demo.demo-account-explain') }}
                <ul>
                    <li>{{ __('request-demo.demo-account-explain-1') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-2') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-3') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-4') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-5') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-6') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-7') }}</li>
                    <li>{{ __('request-demo.demo-account-explain-8') }}</li>
                </ul>
                <br/>
                <br/>
                <h4><b>{{ __('request-demo.h4') }}</b></h4>
                <ul>
                    <li><b>{{__('owner')}} :</b> {{__('request-demo.owner_explain')}}</li>
                    <li><b>{{__('property_specialist')}}:</b> {{__('request-demo.property_specialist_explain')}}</li>
                    <li><b>{{__('tenant')}} : </b> {{__('request-demo.tenant_explain')}}</li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-8 ml-auto mr-auto">
                <form  method="post" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header text-center">
                            <h4 class="card-title"><strong>{{__('request-demo.request_demo_form')}}</strong></h4>
                        </div>
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <div class="alert h4 text-center text-success">
                                {{\Illuminate\Support\Facades\Session::get('success')}}
                            </div>
                        @else
                            <div class="card-body">
                                <p class="card-description text-center">{{__('request-demo.request_demo_form_fill')}}</p>
                                <!-- Success message -->

                                <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-address-book"></i></span></div>
                                        <input placeholder="{{__('fullname')}}" type="text" class="form-control" name="name" id="name" value="{{ old('name')}}">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div id="name-error" class="error text-danger pl-3" for="name"
                                             style="display: block;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif </div>

                                <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-envelope"></i></span></div>
                                        <input placeholder="{{__('email')}}" type="email" class="form-control" name="email" id="email"  value="{{ old('email')}}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                             style="display: block;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif </div>

                                <div class="bmd-form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-phone"></i></span></div>
                                        <input placeholder="{{__('phone')}}" type="text" class="form-control" name="phone" id="phone" value="{{ old('phone')}}">
                                    </div>
                                    @if ($errors->has('phone'))
                                        <div id="phone-error" class="error text-danger pl-3" for="phone"
                                             style="display: block;">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </div>
                                    @endif </div>

                                        <input type="hidden" class="form-control" name="subject" id="subject"  value="Demo Request">

                                <div class="bmd-form-group{{ $errors->has('message') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="fa fa-comment"></i></span></div>
                                        <textarea class="form-control" name="message" id="message" rows="4" placeholder="{{__('request-demo.request_demo_form_last')}}" >{{ old('message')}}</textarea>
                                    </div>
                                    @if ($errors->has('message'))
                                        <div id="message-error" class="error text-danger pl-3" for="message"
                                             style="display: block;">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </div>
                                    @endif</div>

                            </div>
                            <div class="card-footer justify-content-center">
                                <button type="submit" class="btn btn-info btn-link btn-lg">{{__('send')}}</button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
