@extends('layouts.app', ['activePage' => 'properties', 'titlePage' => __('dashboard.property_management_screen')])

@section('content')
    <div class="content ">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-3 col-md-12 header-tab">
                    <div id="unitMenu" class="card card-profile mt-2 mb-2 mt-sm-3">
                        <div class="card-header card-header-info d-none d-sm-block">
                            <h4 class="card-title">{{$unit->property->name}} / {{$unit->name}}</h4>
                            <p class="card-category">{{$unit->property->address}}</p>
                        </div>

                        <div id="menuDiv" @mobile @else class="card-body px-xl-2 px-xxl-3" @endmobile>
                            <ul id="mainTab" class="nav flex-nowrap flex-sm-wrap  nav-pills nav-pills-icons"
                                role="tablist">
                                <!--
                                    color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                -->

                                {{--                                <li class="nav-item col-4 px-0 ">--}}
                                {{--                                    <a class="nav-link" data-active-tab="#contractTab" href="#schedule-1">--}}
                                {{--                                        <i class="material-icons">assignment</i>--}}
                                {{--                                        Sözleşme--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.dashboard' OR \Illuminate\Support\Facades\Route::currentRouteName() == 'units.show')?'active':''}}"
                                       href="/units/{{$unit->id}}/dashboard" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.dashboard',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">dashboard</i>
                                        <span>{{__('dashboard.dashboard')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.details')?'active':''}}"
                                       href="/units/{{$unit->id}}/details" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.details',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">book</i>
                                        <span>{{__('dashboard.details')}}</span>
                                    </a>
                                </li>
                                {{--                                <li class="nav-item col-auto col-sm-12 col-xxl-4 ">
                                                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2" href="#dashboard-1">
                                                                        <i class="material-icons pr-1 pr-sm-3 float-left">alarm</i>
                                                                        {{__('dashboard.reminder')}}
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item col-auto col-sm-12 col-xxl-4 ">
                                                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2" href="#schedule-1">
                                                                        <i class="material-icons pr-1 pr-sm-3 float-left">file_copy</i>
                                                                        {{__('dashboard.files')}}
                                                                    </a>
                                                                </li>--}}
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.assignments')?'active':''}}"
                                       href="/units/{{$unit->id}}/assignments" data-toggle="ajax"
                                       data-push-history="true" data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.assignments',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">assignment</i>
                                        <span>{{__('dashboard.contracts')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.payment-depts')?'active':''}}"
                                       href="/units/{{$unit->id}}/payment-depts" data-toggle="ajax"
                                       data-push-history="true" data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.payment-depts',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">attach_money</i>
                                        <span>{{__('dashboard.payments')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.tenants')?'active':''}}"
                                       href="/units/{{$unit->id}}/tenants" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.tenants',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">person</i>
                                        <span>{{__('dashboard.tenant_guarantor')}}</span>


                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.fixtures')?'active':''}}"
                                       href="/units/{{$unit->id}}/fixtures" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.fixtures',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">event_seat</i>
                                        <span>{{__('dashboard.fixtures')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.expenses')?'active':''}}"
                                       href="/units/{{$unit->id}}/expenses" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.expenses',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">format_paint</i>
                                        <span>{{__('dashboard.outgoings')}}</span>


                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.notes')?'active':''}}"
                                       href="/units/{{$unit->id}}/notes" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.notes',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">note</i>
                                        <span>{{__('dashboard.nots')}}</span>


                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.files')?'active':''}}"
                                       href="/units/{{$unit->id}}/files" data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.files',[$unit->id,'type_id'=>'last10'])}}"
                                       href="#dashboard-1">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">file_copy</i>
                                        <span>{{__('dashboard.files')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.calendar')?'active':''}}"
                                       href="{{route('units.calendar',['unit_id'=>$unit->id])}}" data-toggle="ajax"
                                       data-push-history="true" data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.calendar',['unit_id'=>$unit->id])}}"
                                       href="#dashboard-1">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">today</i>
                                        <span>{{__('dashboard.calendar')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2 ">
                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'units.owners')?'active':''}}"
                                       data-toggle="ajax" data-push-history="true"
                                       data-target="#propertyDetailContent"
                                       data-redirect="true"
                                       data-href="{{route('units.owners',$unit->id)}}"
                                       href="{{route('units.owners',$unit->id)}}">
                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">person</i>
                                        {{__('dashboard.owners')}}
                                    </a>
                                </li>
                                {{--                                <li class="nav-item col-auto col-sm-12 col-xxl-4 px-1 px-sm-0 pt-2 ">--}}
                                {{--                                    <a class="nav-link text-center text-sm-left px-2 px-sm-1 py-2 px-sm-4 py-sm-2 {{(\Illuminate\Support\Facades\Route::currentRouteName() == 'permissions.index')?'active':''}}"--}}
                                {{--                                       data-toggle="ajax" data-push-history="true"--}}
                                {{--                                       data-target="#propertyDetailContent"--}}
                                {{--                                       data-redirect="true"--}}
                                {{--                                       data-href="{{route('permissions.index',$unit->id)}}" href="{{route('permissions.index',$unit->id)}}">--}}
                                {{--                                        <i class="material-icons pr-1 pr-sm-3 float-left m-xl-0 d-lg-block d-xl-block text-lg-center">verified_user</i>--}}
                                {{--                                        Yetkiler--}}
                                {{--                                    </a>--}}
                                {{--                                </li>--}}

                            </ul>
                            <ul id="contractTab" class="nav nav-pills nav-pills-icons" style="display: none"
                                role="tablist">
                                <!--
                                    color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                                -->
                                @if($unit->contract === null)
                                    <li class="nav-item col-4 ">
                                        <a class="nav-link" data-toggle="modal" data-backdrop="static"
                                           data-target="#createContractModal"
                                           data-redirect="true"
                                           data-href="{{route('contracts.create')}}" href="#dashboard-1">
                                            <i class="material-icons">add</i>
                                            {{__('dashboard.create_contract')}}
                                        </a>
                                    </li>
                                    <li class="nav-item col-4 ">
                                        <a class="nav-link" data-toggle="modal" data-backdrop="static"
                                           data-target="#contractWizardModal"
                                           data-redirect="true"
                                           data-href="{{route('wizard.contracts',$unit->id)}}"
                                           href="#dashboard-1">
                                            <i class="material-icons">add</i>
                                            {{__('dashboard.contract_wizard')}}
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item col-4 ">
                                        <a class="nav-link" href="#schedule-1">
                                            <i class="material-icons">add</i>
                                            {{__('dashboard.show_contract')}}
                                        </a>
                                    </li>
                                    <li class="nav-item col-4 ">
                                        <a class="nav-link" href="#dashboard-1">
                                            <i class="material-icons">autorenew</i>
                                            {{__('dashboard.renew_contract')}}
                                        </a>
                                    </li>
                                    {{--                                    <li class="nav-item col-4 ">--}}
                                    {{--                                        <a class="nav-link" id="cancelContract"--}}
                                    {{--                                           data-contract-id="{{$unit->property->contract->id}}" href="#dashboard-1">--}}
                                    {{--                                            <i class="material-icons">cancel</i>--}}
                                    {{--                                            Sözleşme Sonlandır--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                @endif

                            </ul>
                        </div>
                    </div>


                    {{--                    <div class="card d-none d-sm-flex">--}}
                    {{--                        <div class="card-header card-header-info">--}}
                    {{--                            <h4 class="card-title">Harita</h4>--}}
                    {{--                            <p class="card-category">Bu gayrimenkule ait {{__('dashboard.detail')}} bilgiler</p>--}}
                    {{--                        </div>--}}

                    {{--                        <div class="card-body table-responsive">--}}
                    {{--                            <a href="geo:37.786971,-122.399677;u=35"> <img style="width: 100%;" class="img"--}}
                    {{--                                                                           src="https://maps.googleapis.com/maps/api/staticmap?size=300x200&markers=icon%3Ahttp%3A%2F%2Fwww.google.com%2Fmapfiles%2Farrow.png%7C41.39479%2C2.148768&center={{urlencode(($unit->property->city)?$unit->property->city->name:__('dashboard.undefined') ." ". $unit->property->region ." ". $unit->property->address)}}&zoom=18&key=AIzaSyCF83pgZddXnerlPQHxWh6dhersl_wDI1Y">--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
                <div id="propertyDetailSwipeArea" class="col-lg-9 col-md-12 pt-5 pt-sm-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="propertyDetailContent">
                                {{--                                <div class="card-header card-header-tabs card-header-info">--}}
                                {{--                                    <div class="nav-tabs-navigation">--}}
                                {{--                                        <div class="nav-tabs-wrapper">--}}
                                {{--                                            <ul class="nav nav-tabs" data-tabs="tabs">--}}
                                {{--                                                --}}{{--                                                <li class="nav-item">--}}
                                {{--                                                --}}{{--                                                    <a class="nav-link  active show" href="#profile" data-toggle="tab"--}}
                                {{--                                                --}}{{--                                                       data-value="#profile">--}}
                                {{--                                                --}}{{--                                                        <i class="material-icons">my_location</i> {{__('dashboard.address_information')}}--}}
                                {{--                                                --}}{{--                                                        --}}
                                {{--                                                --}}{{--                                                        --}}
                                {{--                                                --}}{{--                                                    </a>--}}
                                {{--                                                --}}{{--                                                </li>--}}

                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link active px-xl-2" href="#settings" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">assignment</i>--}}
                                {{--                                                        {{__('dashboard.contracts')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link px-xl-2" href="#payment" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">attach_money</i>--}}
                                {{--                                                        {{__('dashboard.payments')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link px-xl-2" href="#person" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">person</i>--}}
                                {{--                                                        {{__('dashboard.tenants')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link px-xl-2" href="#fixture" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">event_seat</i>--}}
                                {{--                                                        {{__('dashboard.fixtures')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link px-xl-2" href="#expenses" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">format_paint</i>--}}
                                {{--                                                        {{__('dashboard.outgoings')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link px-xl-2" href="#notes" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">note</i>--}}
                                {{--                                                        {{__('dashboard.nots')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                                <li class="nav-item">--}}
                                {{--                                                    <a class="nav-link pl-xl-2 pr-xl-0" href="#files" data-toggle="tab">--}}
                                {{--                                                        <i class="material-icons m-xl-0 d-lg-block d-xl-inline text-lg-center">file_copy</i>--}}
                                {{--                                                        {{__('dashboard.files')}}--}}
                                {{--                                                        --}}
                                {{--                                                        --}}
                                {{--                                                    </a>--}}
                                {{--                                                </li>--}}
                                {{--                                            </ul>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons"></i>
                                    </div>
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">

                                        {{--                                        <div class="tab-pane active" id="settings">--}}
                                        {{--                                            <div class="text-right">--}}
                                        {{--                                                @if($unit->property->contract === null)--}}
                                        {{--                                                    <a href="#dashboard-1" data-toggle="modal"--}}
                                        {{--                                                       data-target="#contractWizardModal" data-redirect="true"--}}
                                        {{--                                                       data-href="/contracts/wizards/units/{{$unit->id}}"--}}
                                        {{--                                                       class="btn  btn-info"> <i--}}
                                        {{--                                                            class="material-icons">add</i>--}}
                                        {{--                                                        {{__('dashboard.create_contract')}}</a>--}}
                                        {{--                                                @else--}}
                                        {{--                                                    <a class="btn  btn-info" href="#schedule-1">--}}
                                        {{--                                                        <i class="material-icons">add</i>--}}
                                        {{--                                                        Görüntüle--}}
                                        {{--                                                    </a>--}}
                                        {{--                                                    <a class="btn  btn-info" href="#dashboard-1">--}}
                                        {{--                                                        <i class="material-icons">autorenew</i>--}}
                                        {{--                                                        Uzat--}}
                                        {{--                                                    </a>--}}
                                        {{--                                                    <a class="btn  btn-info" id="cancelContract"--}}
                                        {{--                                                       data-contract-id="{{$unit->property->contract->id}}"--}}
                                        {{--                                                       href="#dashboard-1">--}}
                                        {{--                                                        <i class="material-icons">cancel</i>--}}
                                        {{--                                                        Sonlandır--}}
                                        {{--                                                    </a>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                        {{--                                            @if(!$contracts)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4">Bu gayrimenkule ait sözleşme--}}
                                        {{--                                                    bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <div class="table-reponse-temp">--}}
                                        {{--                                                    <table class="table table-hover">--}}
                                        {{--                                                        <thead class="text-info">--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <th>ID</th>--}}
                                        {{--                                                            <th>{{__('dashboard.contract_type')}}</th>--}}
                                        {{--                                                            <th>{{__('dashboard.contract_date')}}</th>--}}
                                        {{--                                                            <th>{{__('dashboard.end_date')}}</th>--}}
                                        {{--                                                            <th>{{__('dashboard.status')}}</th>--}}
                                        {{--                                                            <th class="text-right">{{__('dashboard.actions')}}</th>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                        </thead>--}}
                                        {{--                                                        <tbody>--}}
                                        {{--                                                        @foreach($contracts as $contract)--}}
                                        {{--                                                            <tr>--}}
                                        {{--                                                                <td>{{$contract->id}}</td>--}}
                                        {{--                                                                    <td><b>{{$contract->template->name}}</b></td>--}}
                                        {{--                                                                <td>{{$contract->start_date}}</td>--}}
                                        {{--                                                                <td>{{$contract->end_date}}</td>--}}
                                        {{--                                                                <td>{!! $contract->getStatus(true) !!}</td>--}}
                                        {{--                                                                <td class="text-right">--}}
                                        {{--                                                                    <div class="dropdown">--}}
                                        {{--                                                                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"--}}
                                        {{--                                                                           id="navbarContractActionMenu{{$contract->id}}"--}}
                                        {{--                                                                           data-toggle="dropdown" aria-haspopup="true"--}}
                                        {{--                                                                           aria-expanded="true">--}}
                                        {{--                                                                            <i class="material-icons">more_vert</i>--}}
                                        {{--                                                                            <p class="d-lg-none d-md-block">--}}
                                        {{--                                                                                Account--}}
                                        {{--                                                                            </p></a>--}}
                                        {{--                                                                        <div class="dropdown-menu"--}}
                                        {{--                                                                             aria-labelledby="navbarContractActionMenu{{$contract->id}}">--}}
                                        {{--                                                                            @if($contract->file_id != null)--}}
                                        {{--                                                                                <a rel="tooltip" class="dropdown-item"--}}
                                        {{--                                                                                   href="{{route('files.download',$contract->contractFile->hash)  }}"--}}
                                        {{--                                                                                   data-original-title="" title="">--}}
                                        {{--                                                                                    <i class="material-icons">cloud_download</i>Sözleşmeyi--}}
                                        {{--                                                                                    İndir--}}

                                        {{--                                                                                </a>--}}
                                        {{--                                                                            @endif--}}
                                        {{--                                                                            <a rel="tooltip" class="dropdown-item"--}}
                                        {{--                                                                               href="{{ route('contracts.show', $contract) }}"--}}
                                        {{--                                                                               data-toggle="modal"--}}
                                        {{--                                                                               data-target="#ajaxModal"--}}
                                        {{--                                                                               data-redirect="true"--}}
                                        {{--                                                                               data-href="{{ route('contracts.show', $contract) }}"--}}
                                        {{--                                                                               data-original-title="" title="">--}}
                                        {{--                                                                                <i class="material-icons">visibility</i>Sözleşme--}}
                                        {{--                                                                                Bilgileri--}}

                                        {{--                                                                            </a>--}}
                                        {{--                                                                            <a rel="tooltip" class="dropdown-item"--}}
                                        {{--                                                                               href="{{ route('contracts.edit', $contract) }}"--}}
                                        {{--                                                                               data-toggle="modal"--}}
                                        {{--                                                                               data-target="#ajaxModal"--}}
                                        {{--                                                                               data-redirect="true"--}}
                                        {{--                                                                               data-href="{{ route('contracts.edit', $contract) }}"--}}
                                        {{--                                                                               data-original-title="" title="">--}}
                                        {{--                                                                                <i class="material-icons">edit</i>Düzenle--}}

                                        {{--                                                                            </a>--}}
                                        {{--                                                                            <a class="dropdown-item btn-delete-confirm"--}}
                                        {{--                                                                               data-href="{{route('contracts.destroy', $contract) }}"--}}
                                        {{--                                                                               data-redirect="true"--}}
                                        {{--                                                                               data-text="{{$contract->template->name}}/{{$contract->id}}">--}}
                                        {{--                                                                                <i class="material-icons">close</i>Sözleşmeyi--}}
                                        {{--                                                                                Sil--}}

                                        {{--                                                                            </a>--}}
                                        {{--                                                                        </div>--}}
                                        {{--                                                                    </div>--}}
                                        {{--                                                                </td>--}}
                                        {{--                                                            </tr>--}}
                                        {{--                                                        @endforeach--}}
                                        {{--                                                        </tbody>--}}
                                        {{--                                                    </table>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="tab-pane" id="payment">--}}
                                        {{--                                            <div class="text-right">--}}
                                        {{--                                                <a href="{{ route('payments.create') }}" data-toggle="modal"--}}
                                        {{--                                                   data-target="#ajaxModal" data-redirect="true"--}}
                                        {{--                                                   data-href="{{ route('payments.create') }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                   class="btn  btn-info"> <i--}}
                                        {{--                                                        class="material-icons">add</i>--}}
                                        {{--                                                    {{__('dashboard.new')}} {{__('dashboard.payment')}}</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            @if(!$payments)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4"> Bu gayrimenkule ait ödeme--}}
                                        {{--                                                    bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <table class="table table-hover">--}}
                                        {{--                                                    <thead class="text-info">--}}
                                        {{--                                                    <tr>--}}
                                        {{--                                                        <th>ID</th>--}}
                                        {{--                                                        <th>Tür</th>--}}
                                        {{--                                                        <th>Ödenen/Toplam {{__('dashboard.amount')}}</th>--}}
                                        {{--                                                        <th>{{__('dashboard.due_date')}}</th>--}}
                                        {{--                                                        <th>{{__('dashboard.status')}}</th>--}}
                                        {{--                                                        <th class="text-right">{{__('dashboard.actions')}}</th>--}}
                                        {{--                                                    </tr>--}}
                                        {{--                                                    </thead>--}}
                                        {{--                                                    <tbody>--}}
                                        {{--                                                    @foreach($payments as $payment)--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <td>{{$payment['id']}}</td>--}}
                                        {{--                                                            <td>--}}
                                        {{--                                                                <b>{!! \App\Models\Payment::getPropertyTypes()[$payment['payment_type_id']]['name']!!}</b>--}}
                                        {{--                                                                <br/>{{$payment['comment']}}--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                            <td>{{$payment['amountOfDept']}}--}}
                                        {{--                                                                /{{$payment['amount']}}{{$payment['currency']}}</td>--}}
                                        {{--                                                            <td>{{$payment['due_date']}}</td>--}}
                                        {{--                                                            <td>{!! $payment->getStatusForAmount($payment['amount'],$payment['amountOfDept'],true) !!}</td>--}}
                                        {{--                                                            <td >--}}
                                        {{--                                                                @if($payment->status_id === \App\Models\PaymentDept::PAYMENT_STATUS_WAITING_PAYMENT)--}}
                                        {{--                                                                    <a href="{{ route('payments.create') }}"--}}
                                        {{--                                                                       data-toggle="modal"--}}
                                        {{--                                                                       data-target="#ajaxModal" data-redirect="true"--}}
                                        {{--                                                                       data-href="{{ route('payments.create', $payment) }}?unit_id={{$unit->id}}&ref_payment_id={{$payment->id}}&status_id={{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"--}}
                                        {{--                                                                       class="btn btn-sm  btn-outline-success"> <i--}}
                                        {{--                                                                            class="material-icons">check</i>--}}
                                        {{--                                                                        {{__('dashboard.report_payment')}}</a>--}}
                                        {{--                                                                @else--}}
                                        {{--                                                                    <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                       href="{{ route('payments.show', $payment) }}"--}}
                                        {{--                                                                       data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                       data-redirect="true"--}}
                                        {{--                                                                       data-href="{{ route('payments.show', $payment) }}"--}}
                                        {{--                                                                       data-original-title="" title="">--}}
                                        {{--                                                                        <i class="material-icons">visibility</i>--}}

                                        {{--                                                                    </a>--}}
                                        {{--                                                                    <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                       href="{{ route('payments.edit', $payment) }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                                       data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                       data-redirect="true"--}}
                                        {{--                                                                       data-href="{{ route('payments.edit', $payment) }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                                       data-original-title="" title="">--}}
                                        {{--                                                                        <i class="material-icons">edit</i>--}}

                                        {{--                                                                    </a>--}}
                                        {{--                                                                    <a class="btn btn-danger px-1 btn-link btn-delete-confirm"--}}
                                        {{--                                                                       data-href="{{route('payments.destroy', $payment) }}"--}}
                                        {{--                                                                       data-redirect="true"--}}
                                        {{--                                                                       data-text="{{$payment->payment_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
                                        {{--                                                                        <i class="material-icons">close</i>--}}

                                        {{--                                                                    </a>--}}
                                        {{--                                                                @endif--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    </tbody>--}}
                                        {{--                                                </table>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="tab-pane" id="person">--}}
                                        {{--                                            @if(!$tenants)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4">Bu gayrimenkule ait kiracı--}}
                                        {{--                                                    bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <table class="table table-hover">--}}
                                        {{--                                                    <thead class="text-info">--}}
                                        {{--                                                    <tr>--}}
                                        {{--                                                        <th>ID</th>--}}
                                        {{--                                                        <th>{{__('dashboard.person_type')}}</th>--}}
                                        {{--                                                        <th>Kiracı Adı</th>--}}
                                        {{--                                                        <th>{{__('dashboard.authorized_person')}}</th>--}}
                                        {{--                                                        <th>{{__('dashboard.contact')}}</th>--}}
                                        {{--                                                        <th>{{__('dashboard.status')}}</th>--}}
                                        {{--                                                    </tr>--}}
                                        {{--                                                    </thead>--}}
                                        {{--                                                    <tbody>--}}
                                        {{--                                                    @foreach($tenants as $tenant)--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <td>{{$tenant->id}}</td>--}}
                                        {{--                                                            <td>{!! $tenant->getType(true) !!}</td>--}}
                                        {{--                                                            <td>{{$tenant->name}}</td>--}}
                                        {{--                                                            <td>{{$tenant->authorized_person}}</td>--}}
                                        {{--                                                            <td>{{$tenant->authorized_person_phone}}</td>--}}
                                        {{--                                                            <td>{!! $tenant->getStatus(true)!!}</td>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    </tbody>--}}
                                        {{--                                                </table>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="tab-pane" id="fixture">--}}
                                        {{--                                            <div class="text-right">--}}
                                        {{--                                                <a href="{{ route('fixtures.create') }}" data-toggle="modal"--}}
                                        {{--                                                   data-target="#ajaxModal" data-redirect="true"--}}
                                        {{--                                                   data-href="{{ route('fixtures.create') }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                   class="btn  btn-info"> <i--}}
                                        {{--                                                        class="material-icons">add</i>--}}
                                        {{--                                                    {{__('dashboard.new')}} Demirbaş</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            @if(!$fixtures)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4"> Bu gayrimenkule ait demirbaş--}}
                                        {{--                                                    bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <table class="table table-hover">--}}
                                        {{--                                                    <thead class="text-info">--}}
                                        {{--                                                    <tr>--}}
                                        {{--                                                        <th>ID</th>--}}
                                        {{--                                                        <th>{{__('dashboard.how_many')}}</th>--}}
                                        {{--                                                        <th>Demirbaş</th>--}}
                                        {{--                                                        <th>{{__('dashboard.created_date')}}</th>--}}
                                        {{--                                                        <th>{{__('dashboard.status')}}</th>--}}
                                        {{--                                                        <th class="text-right">İşlem</th>--}}
                                        {{--                                                    </tr>--}}
                                        {{--                                                    </thead>--}}
                                        {{--                                                    <tbody>--}}
                                        {{--                                                    @foreach($fixtures as $fixture)--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <td>{{$fixture->id}}</td>--}}
                                        {{--                                                            <td>{{$fixture->count}}</td>--}}
                                        {{--                                                            <td><b>{{$fixture->name}}</b><br/>{{$fixture->comment}}</td>--}}
                                        {{--                                                            <td>{{$fixture->created_at}}</td>--}}
                                        {{--                                                            <td>{!! $fixture->getStats(true)!!}</td>--}}
                                        {{--                                                            <td class="text-right">--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('fixtures.show', $fixture) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('fixtures.show', $fixture) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">visibility</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('fixtures.edit', $fixture) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('fixtures.edit', $fixture) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">edit</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a class="btn btn-danger px-1 btn-link btn-delete-confirm"--}}
                                        {{--                                                                   data-href="{{route('fixtures.destroy', $fixture) }}"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-text="{{$fixture->name}}">--}}
                                        {{--                                                                    <i class="material-icons">close</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    </tbody>--}}
                                        {{--                                                </table>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="tab-pane" id="expenses">--}}
                                        {{--                                            <div class="text-right">--}}
                                        {{--                                                <a href="{{ route('outgoings.create') }}" data-toggle="modal"--}}
                                        {{--                                                   data-target="#ajaxModal" data-redirect="true"--}}
                                        {{--                                                   data-href="{{ route('outgoings.create') }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                   class="btn  btn-info"> <i--}}
                                        {{--                                                        class="material-icons">add</i>--}}
                                        {{--                                                    {{__('dashboard.new_outgoing')}}</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            @if(!$outgoings)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4"> Bu gayrimenkule ait gider--}}
                                        {{--                                                    bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <table class="table table-hover">--}}
                                        {{--                                                    <thead class="text-info">--}}
                                        {{--                                                    <tr>--}}
                                        {{--                                                        <th>ID</th>--}}
                                        {{--                                                        <th>Tür</th>--}}
                                        {{--                                                        <th>{{__('dashboard.amount')}}</th>--}}
                                        {{--                                                        <th>{{__('dashboard.outgoing_date')}}</th>--}}
                                        {{--                                                        <th class="text-right">{{__('dashboard.actions')}}</th>--}}
                                        {{--                                                    </tr>--}}
                                        {{--                                                    </thead>--}}
                                        {{--                                                    <tbody>--}}
                                        {{--                                                    @foreach($outgoings as $payment)--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <td>{{$payment['id']}}</td>--}}
                                        {{--                                                            <td>--}}
                                        {{--                                                                <b>{!! \App\Models\Outgoing::getPropertyTypes()[$payment['payment_type_id']]['name']!!}</b><br/>{{$payment['name']}}--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                            <td>{{$payment['amount']}}{{$payment['currency']}}</td>--}}
                                        {{--                                                            <td>{{$payment['outgoing_date']}}</td>--}}
                                        {{--                                                            <td class="text-right">--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('outgoings.show', $payment) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('outgoings.show', $payment) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">visibility</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('outgoings.edit', $payment) }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('outgoings.edit', $payment) }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">edit</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a class="btn btn-danger px-1 btn-link btn-delete-confirm"--}}
                                        {{--                                                                   data-href="{{route('outgoings.destroy', $payment) }}"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-text="{{$payment->payment_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
                                        {{--                                                                    <i class="material-icons">close</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    </tbody>--}}
                                        {{--                                                </table>--}}
                                        {{--                                            @endif--}}

                                        {{--                                        </div>--}}
                                        {{--                                        <div class="tab-pane" id="notes">--}}
                                        {{--                                            <div class="text-right">--}}
                                        {{--                                                <a href="{{ route('notes.create') }}" data-toggle="modal"--}}
                                        {{--                                                   data-target="#ajaxModal" data-redirect="true"--}}
                                        {{--                                                   data-href="{{ route('notes.create') }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                   class="btn  btn-info"> <i--}}
                                        {{--                                                        class="material-icons">add</i>--}}
                                        {{--                                                    {{__('dashboard.new')}} Not</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            @if(!$notes)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4"> Bu gayrimenkule ait not bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <table class="table dataTable" style="width:100%">--}}
                                        {{--                                                    <thead class="text-info">--}}
                                        {{--                                                    <tr>--}}
                                        {{--                                                        <th>Id</th>--}}
                                        {{--                                                        <th>Not</th>--}}
                                        {{--                                                        <th>{{__('dashboard.updated_date')}}</th>--}}
                                        {{--                                                        <th class="text-right">İşlem</th>--}}
                                        {{--                                                    </tr>--}}
                                        {{--                                                    </thead>--}}
                                        {{--                                                    <tbody>--}}
                                        {{--                                                    @foreach($notes as $note)--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <td class="font-weight-bold">{{$note->id}}</td>--}}
                                        {{--                                                            <td><b>{{$note->title}}</b><br/>{{$note->note}}</td>--}}
                                        {{--                                                            <td>{{$note->updated_at}}</td>--}}
                                        {{--                                                            <td class="text-right">--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('notes.show', $note) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('notes.show', $note) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">visibility</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('notes.edit', $note) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('notes.edit', $note) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">edit</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a class="btn btn-danger px-1 btn-link btn-delete-confirm"--}}
                                        {{--                                                                   data-href="{{route('notes.destroy', $note) }}"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-text="{{$note->title}}">--}}
                                        {{--                                                                    <i class="material-icons">close</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    </tbody>--}}
                                        {{--                                                </table>--}}
                                        {{--                                            @endif--}}

                                        {{--                                        </div>--}}
                                        {{--                                        <div class="tab-pane" id="files">--}}
                                        {{--                                            <div class="text-right">--}}
                                        {{--                                                <a href="{{ route('files.create') }}" data-toggle="modal"--}}
                                        {{--                                                   data-target="#ajaxModal" data-redirect="true"--}}
                                        {{--                                                   data-href="{{ route('files.create') }}?unit_id={{$unit->id}}"--}}
                                        {{--                                                   class="btn  btn-info"> <i--}}
                                        {{--                                                        class="material-icons">add</i>--}}
                                        {{--                                                    {{__('dashboard.add_file')}}</a>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            @if(!$files)--}}
                                        {{--                                                <hr/>--}}
                                        {{--                                                <div class="text-center h4"> Bu gayrimenkule ait dosya bulunmamaktadır.--}}
                                        {{--                                                </div>--}}
                                        {{--                                            @else--}}
                                        {{--                                                <table class="table dataTable" style="width:100%">--}}
                                        {{--                                                    <thead class="text-info">--}}
                                        {{--                                                    <tr>--}}
                                        {{--                                                        <th>Id</th>--}}
                                        {{--                                                        <th>{{__('dashboard.type')}}</th>--}}
                                        {{--                                                        <th>Yüklenme Tarihi</th>--}}
                                        {{--                                                        <th class="text-right">{{__('dashboard.actions')}}</th>--}}
                                        {{--                                                    </tr>--}}
                                        {{--                                                    </thead>--}}
                                        {{--                                                    <tbody>--}}
                                        {{--                                                    @foreach($files as $file)--}}
                                        {{--                                                        <tr>--}}
                                        {{--                                                            <td class="font-weight-bold">{{$file->id}}</td>--}}
                                        {{--                                                            <td><b>{{$file->title}}</b><br/>{{$file->note}}</td>--}}
                                        {{--                                                            <td>{{$file->updated_at}}</td>--}}
                                        {{--                                                            <td class="text-right">--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('files.show', $file) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('files.show', $file) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">visibility</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a rel="tooltip" class="btn  btn-link px-1"--}}
                                        {{--                                                                   href="{{ route('files.edit', $file) }}"--}}
                                        {{--                                                                   data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-href="{{ route('files.edit', $file) }}"--}}
                                        {{--                                                                   data-original-title="" title="">--}}
                                        {{--                                                                    <i class="material-icons">edit</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                                <a class="btn btn-danger px-1 btn-link btn-delete-confirm"--}}
                                        {{--                                                                   data-href="{{route('files.destroy', $file) }}"--}}
                                        {{--                                                                   data-redirect="true"--}}
                                        {{--                                                                   data-text="{{$file->title}}">--}}
                                        {{--                                                                    <i class="material-icons">close</i>--}}

                                        {{--                                                                </a>--}}
                                        {{--                                                            </td>--}}
                                        {{--                                                        </tr>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                    </tbody>--}}
                                        {{--                                                </table>--}}
                                        {{--                                            @endif--}}

                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Request::ajax())
        <script>
            $(document).ready(function () {
                $(document).find('#mainTab .active').click();
                $('#mobile-header #mobile-header-title').html($('#unitMenu h4').html());
                $('#mobile-header #mobile-header-logo').hide();

                @if(\App\Models\Unit::ownersCount($unit->id) == 0)
                if ($('#unitMenu .active').attr('href') == '{{route('units.owners',$unit->id)}}' ) {
                    if ($('#unitOwnerModal').length != 0) {
                        $('#unitOwnerModal').remove();
                    }
                }else{
                    if ($('#unitOwnerModal').length == 0) {
                        createModal('#unitOwnerModal')
                    }
                    getAjax(null, '#unitOwnerModal .modal-dialog', '{{route('units.owners',$unit->id)}}?modal=true', false, false, true)
                    $('#unitOwnerModal').modal({
                        show: false,
                        // backdrop: 'static'
                    }).modal('show')
                }
                @endif

            })
        </script>
    @endif
@endsection

@push('js')
    <script>


        $('[data-active-tab]').on('click', function (e) {
            $(this).parent().parent().hide()
            $($(this).attr('data-active-tab')).show()
        })


        $('#mainTab .nav-link').on('click', function (e) {
            $(document).scrollTop(0);
            $('#propertyDetailContent .card-header .card-title').text($(this).find('span').text())
            $('#propertyDetailContent .card-header .card-icon i').text($(this).find('i').text())



        })

        window.addEventListener('mousedown', function (event) {
            if ($(event.target).closest('#menuDiv,.modal,.swal-overlay').length === 0) {
                $('#menuDiv .nav').hide()
                $('#mainTab').show()
            }
        });

        //Todo aşağıdaki kısım açılacak mı mobilde mi kullanıclacak?
        // // Javascript to enable link to tab
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
        }

        //Todo aşağıdaki mobilde mi kullanıclacak?
        // Change hash for page-reload
        // $('.nav-tabs a').on('shown.bs.tab', function (e) {
        //      window.location.hash = e.target.hash;
        // })

        $('[data-toggle="card"]').on('click', function () {
            $('#propertyDetailContent').html();
        })

        $(document).ready(function () {
            $(document).find('#mainTab .active').click();
            $('#mobile-header #mobile-header-title').html($('#unitMenu h4').html());
            $('#mobile-header #mobile-header-logo').hide();
            window.reloadSwipeUnitDetail.call();


        })

        $(document).find('#mainTab .active').click();


    </script>
@endpush


