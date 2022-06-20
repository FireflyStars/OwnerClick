{{--@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => "Hesabı Onayla"])--}}
@extends('layouts.app', ['activePage' => 'home',  'activePage' => 'login','titlePage' => __('dashboard.verify_account')])

@section('content')
    <div class="content ">
        <div class="container-fluid">
            <div class="container" style="height: auto;">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <div class="card card-login card-hidden mb-3">
                            <div class="card-header card-header-info text-center">
                                <p class="card-title"><strong>{{__('dashboard.verify_e_mail_address')}}</strong></p>
                            </div>
                            <div class="card-body">
                                <p class="card-description text-center"></p>
                                <p>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{__('dashboard.send_new_verification_mail')}}
                                    </div>
                                @endif

                                {{__('dashboard.please_click_verification_link')}}
                                @if (Route::has('verification.resend'))
                                    {{__('dashboard.if_verification_mail_not_recived')}}
                                    <form  method="POST" data-toggle="ajaxForm" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <input class="btn btn-block btn-outline-secondary" type="submit" value="{{__('dashboard.send_email_again')}}" >
                                    </form>

                                    @endif
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
