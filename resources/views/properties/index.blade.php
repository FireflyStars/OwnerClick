@extends('layouts.app', ['activePage' => 'properties', 'titlePage' => __('dashboard.properties')])

@section('content')
    <?php
    /**
     * @var \App\Models\Property[] $properties
     */
    ?>
    <div class="clearfix"></div>
    <div class="content ">
        <div class="container-fluid">
            {{--            <div class="row">--}}
            {{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
            {{--                    <div class="card card-stats">--}}
            {{--                        <div class="card-header card-header-info card-header-icon">--}}
            {{--                            <div class="card-icon">--}}
            {{--                                <i class="material-icons">store</i>--}}
            {{--                            </div>--}}
            {{--                            <p class="card-category">{{__('dashboard.property')}}Sayısı</p>--}}
            {{--                            <h3 class="card-title">{{count($properties)}}</h3>--}}
            {{--                        </div>--}}
            {{--                        <div class="card-footer">--}}
            {{--                            <div class="stats">--}}
            {{--                                <i class="material-icons">date_range</i> Boş {{__('dashboard.property')}}: {{$forRentCount}}--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
            {{--                    <div class="card card-stats">--}}
            {{--                        <div class="card-header  card-header-icon">--}}
            {{--                            <div class="card-icon">--}}
            {{--                                <i class="material-icons">assignment</i>--}}
            {{--                            </div>--}}
            {{--                            <p class="card-category">Sözleşmesi Biten</p>--}}
            {{--                            <h3 class="card-title">{{$expiredContracts}}</h3>--}}
            {{--                        </div>--}}
            {{--                        <div class="card-footer">--}}
            {{--                            <div class="stats">--}}
            {{--                                <i class="material-icons">local_offer</i> Gelecek Ay Bitecek {{__('dashboard.property')}}: {{$expiredContractsNextMonth}}--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            @if(count($properties) != 0) <div class="row ">
                <div class="col-12">
                    <div class="card-actions">
                        <a href="{{ route('properties.create') }}" data-toggle="modal" data-backdrop="static"
                           data-target="#propertiesModal"
                           data-redirect="reload" data-href="{{ route('properties.create') }}"
                           data-redirect-target="#ajax-content" data-redirect-href="{{route('properties.index')}}"
                           class="btn btn-info float-end mobile-fixed-circle-button">
                            <i class="material-icons">add</i><span class="d-none d-sm-inline-block">{{__('dashboard.add_property')}}</span></a>
                    </div>
{{--                    <h2>{{__('dashboard.properties')}}</h2>--}}
                </div>
            </div>
{{--            <hr/>--}}

            @endif
            <div class="row sortable" data-item-type="{{\App\Models\ItemOrder::ITEMORDER_ITEM_TYPE_PROPERTIES}}">
                @if(count($properties) == 0)
                    <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column pt-5 mt-5">
                        <i class="far fa-building fa-6x"></i>
                        <h3>{{__('dashboard.create_your_first_property')}}</h3>
                        <span class="description">{{__('dashboard.create_your_first_property_description')}}</span>
                        <div class="card-actions m-3">
                            <a href="{{ route('properties.create') }}" data-toggle="modal" data-backdrop="static"
                               data-target="#propertiesModal"
                               data-redirect="reload" data-href="{{ route('properties.create') }}"
                               data-redirect-target="#ajax-content" data-redirect-href="{{route('properties.index')}}"
                               class="btn btn-info float-end ">
                                <i class="material-icons">add</i>{{__('dashboard.add_property')}}</a>
                        </div>
                    </div>
                @else
                    @foreach($properties as $property)
                        <div class="col-md-6 col-lg-6 col-xl-4 col-xxl-3" data-item-id="{{$property->id}}">
                            <div class="card card-property my-2 my-sm-3">
                                <div class="card-header pb-0">
                                    {{--                            --}}
                                    <div class="dropdown float-end ">
                                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                           id="navbarContractActionMenu{{$property->id}}"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="true">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu"
                                             aria-labelledby="navbarContractActionMenu{{$property->id}}">
                                            <a rel="tooltip" class="dropdown-item"
                                               href="{{ route('properties.edit', $property) }}"
                                               data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"
                                               data-redirect="true" data-redirect-target="#ajax-content"
                                               data-redirect-href="{{route('properties.index')}}"
                                               data-href="{{ route('properties.edit', $property) }}"
                                               data-original-title="" title="">
                                                <i class="material-icons">edit</i> {{__('dashboard.edit_property')}}

                                            </a>
                                            <a class="dropdown-item btn-delete-confirm"
                                               href="{{route('properties.destroy', $property) }}"
                                               data-href="{{route('properties.destroy', $property) }}"
                                               data-redirect="true" data-redirect-target="#ajax-content"
                                               data-redirect-href="{{route('properties.index')}}"
                                               data-text="{{$property->name}}/{{$property->name}}">
                                                <i class="material-icons">close</i> {{__('dashboard.delete_property')}}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="property-list-item sortable-handle">
                                        <div class=" align-top d-inline-block p-1"><i class="fa fa-{!! $property->getTypeIcon() !!}" ></i>
                                        </div>
                                        <div class="d-inline-block property-list-name">
                                            <h4 class="card-title font-weight-bold">{{($city = \App\Models\City::query()->find($property['city_id'],'name'))? $city->name : __('dashboard.undefined')}}
                                                / {{$property->name}} </h4>
                                            <p class="text-gray"> {{$property['address']}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
<?php $units = $property->units()->with('orders')->get(['name','id','type_id'])->sortBy(function($item) { return  $item->orders?$item->orders->id:null; }) ?>
                                        @if(count($units) == 0)
                                            <div class="text-center col-12 d-flex align-items-center justify-content-center flex-column py-3">
                                                <i class="far fa-building fa-2x pb-3"></i>
                                                <h6>{{__('dashboard.add_unit_to_property')}}</h6>
                                                <span class="description">{{__('dashboard.add_unit_to_property_description')}}</span>
                                                <a href="{{ route('units.create') }}" data-toggle="modal"
                                                   data-target="#propertiesModal" data-redirect="true"
                                                   data-redirect-target="#ajax-content"
                                                   data-redirect-href="{{route('properties.index')}}"
                                                   data-href="{{ route('units.create',['property_id'=>$property->id]) }}"
                                                   class="btn btn-info my-3"> <i
                                                        class="material-icons">add</i>{{__('dashboard.add_new_unit')}}</a>
                                            </div>
                                        @else
                                    <div class="property-unit-list">
                                        <table class="table table-hover dataTable " style="width:100%">
                                            {{--                                    <thead class=" text-info">--}}
                                            {{--                                    <th>ID</th>--}}
                                            {{--                                    <th>{{__('dashboard.type')}}</th>--}}
                                            {{--                                    <th>İsim</th>--}}
                                            {{--                                    <th>{{__('dashboard.state')}}</th>--}}
                                            {{--                                    <th>{{__('dashboard.status')}}</th>--}}
                                            {{--                                    <th>Oda</th>--}}
                                            {{--                                    <th>{{__('dashboard.rent_fee')}}</th>--}}
                                            {{--                                    <th class="text-right">--}}
                                            {{--                                        İşlem--}}
                                            {{--                                    </th>--}}
                                            {{--                                    </thead>--}}
                                            <tbody class="sortable" data-item-type="{{\App\Models\ItemOrder::ITEMORDER_ITEM_TYPE_UNITS}}" data-parent-item-id="{{$property->id}}">
                                            @foreach($units as $unit)
                                                <tr class="sortable-handle" data-item-id="{{$unit->id}}">
{{--                                                    <td class="d-none d-sm-table-cell cursor-pointer " href="#properties" data-toggle="ajax"--}}
{{--                                                        data-target="#ajax-content" data-redirect="true"--}}
{{--                                                        data-href="{{ route('units.show', $unit) }}">--}}
{{--                                                        {{$unit->id}}--}}
{{--                                                    </td>--}}
                                                    <td class="cursor-pointer" href="#properties" data-toggle="ajax"
                                                        data-target="#ajax-content" data-redirect="true"
                                                        data-href="{{ route('units.show', $unit) }}">
                                                        @if(isset($unit->contract) AND  $unit->contract->isExpired())
                                                            <i class="fas fa-exclamation-circle text-danger" title="{{__('dashboard.contract_has_expired')}}"></i>
                                                        @else
                                                            <i class="fas fa-{!! $unit->getTypeIcon() !!}"/>
                                                        @endif
                                                    </td>
                                                    <td class="cursor-pointer w-100" href="#properties" data-toggle="ajax"
                                                        data-target="#ajax-content" data-redirect="true"
                                                        data-href="{{ route('units.show', $unit) }}">
                                                        {{$property->name}} / {{$unit->name}}
                                                    </td>
                                                    {{--                                            <td class="cursor-pointer" href="#properties" data-toggle="ajax"
                                                    data-target="#ajax-content" data-redirect="true"
                                                    data-href="{{ route('units.show', $unit) }}">--}}
                                                    {{--                                                {{\App\Models\State::query()->find($property['state_id'],'name')->name}}--}}
                                                    {{--                                            </td>--}}

                                                    <td class="cursor-pointer" href="#properties" data-toggle="ajax"
                                                        data-target="#ajax-content" data-redirect="true"
                                                        data-href="{{ route('units.show', $unit) }}">
                                                        @if(isset($unit->contract))
                                                            {!! \App\Models\Property::getStatus(true,\App\Models\Property::PROPERTY_STATUS_LOAD) !!}
                                                        @else
                                                            {!! \App\Models\Property::getStatus(true,\App\Models\Property::PROPERTY_STATUS_FOR_RENT) !!}
                                                        @endif
                                                    </td>
                                                    {{--                                            <td>--}}
                                                    {{--                                                {{$property['room']}}--}}
                                                    {{--                                            </td>--}}
                                                    {{--                                            <td>--}}
                                                    {{--                                                {{$property['rental_price']}}--}}
                                                    {{--                                            </td>--}}
                                                    <td class="td-actions text-right">
                                                        <div class="dropdown">

                                                            <a class="btn btn-just-icon btn-link btn-secondary text-dark"
                                                               href="#pablo"
                                                               id="navbarContractActionMenu{{$unit->id}}"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="true">
                                                                <i class="material-icons">more_vert</i>
                                                            </a>
                                                            <div class="dropdown-menu"
                                                                 aria-labelledby="navbarContractActionMenu{{$unit->id}}">
                                                                <a rel="tooltip" class="dropdown-item"
                                                                   href="{{ route('units.show', $unit) }}"
                                                                   data-href="{{ route('units.show', $unit) }}"
                                                                   data-original-title="" title="">
                                                                    <i class="material-icons">visibility</i> {{__('dashboard.show_unit')}}

                                                                </a>
                                                                <a rel="tooltip" class="dropdown-item"
                                                                   href="{{ route('units.edit', $unit) }}"
                                                                   data-toggle="modal" data-backdrop="static"
                                                                   data-target="#propertiesModal"
                                                                   data-redirect="true"
                                                                   data-redirect-target="#ajax-content"
                                                                   data-redirect-href="{{route('properties.index')}}"
                                                                   data-href="{{ route('units.edit', $unit) }}"
                                                                   data-original-title="" title="">
                                                                    <i class="material-icons">edit</i> {{__('dashboard.edit_unit')}}
                                                                </a>
                                                                <a class="dropdown-item btn-delete-confirm"
                                                                   href="{{route('units.destroy', $unit) }}"
                                                                   data-href="{{route('units.destroy', $unit) }}"
                                                                   data-redirect="true"
                                                                   data-redirect-target="#ajax-content"
                                                                   data-redirect-href="{{route('properties.index')}}"
                                                                   data-text="{{$property->name}}/{{$unit->name}}">
                                                                    <i class="material-icons">close</i> {{__('dashboard.delete_unit')}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('units.create') }}" data-toggle="modal"
                   data-target="#propertiesModal" data-redirect="true"
                   data-redirect-target="#ajax-content"
                   data-redirect-href="{{route('properties.index')}}"
                   data-href="{{ route('units.create',['property_id'=>$property->id]) }}"
                   class="text-dark"> <i
                        class="material-icons">add</i>{{__('dashboard.add_new_unit')}}</a>
            </div>
        </div>
                                        @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function (){
            $('.sortable').each(function () {
                reloadSortable.call(this);
            })          })
    </script>
@endpush
