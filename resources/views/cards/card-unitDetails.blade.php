<div class="card">
<div class="card-header card-header-info card-header-icon">
    <div class="card-icon">
        <i class="material-icons">format_paint</i>
    </div>
    <h4 class="card-title">{{__('dashboard.detail_information')}}</h4>
</div>
    <div class="card-body  @if(!$dashboard) card-menu @endif table-responsive">
        @if(!$dashboard)
        <div class="text-right">
            <a href="{{ route('details.create') }}" data-toggle="modal" data-backdrop="static"
               data-target="#ajaxModal" data-redirect="true"
               data-href="{{ route('details.create') }}?unit_id={{$unit->id}}"
               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit->id}}/details"
               class="btn  btn-info mobile-fixed-circle-button "> <i
                    class="material-icons">add</i>
                <span class="d-none d-sm-inline-block">{{__('dashboard.new')}} {{__('dashboard.detail')}}</span></a>
        </div>
        @endif
        <table class="table">
            <tr>
                <td class="font-weight-bold">{{__('dashboard.type')}}</td>
                <td><i class="fa fa-{!! $property->getTypeIcon() !!}"></i> {{$property->getTypeName()}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">{{__('dashboard.country')}}</td>
                <td>{{$property->country->name}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">{{__('dashboard.state')}}</td>
                <td>{{($property->state)?$property->state->name:__('dashboard.undefined')}}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">{{__('dashboard.city')}}</td>
                <td>{{($property->city)?$property->city->name : __('dashboard.undefined')}}</td>
            </tr>
{{--            <tr>--}}
{{--                <td class="font-weight-bold">Mahalle</td>--}}
{{--                <td>{{$property->region}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td class="font-weight-bold">Bina No</td>--}}
{{--                <td>{{$property->building_no}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td class="font-weight-bold">Posta Kodu</td>--}}
{{--                <td>{{$property->zip_code}}</td>--}}
{{--            </tr>--}}
            <tr>
                <td class="font-weight-bold">{{__('dashboard.address')}}</td>
                <td>{{$property->address}}</td>
            </tr>
        </table>
        <div class="tab-pane" id="messages">

            @if(!$details)

            @else
                <table class="table dataTable" style="width:100%">
                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td class="font-weight-bold">{{$detail->detail}}</td>
                            <td>{{$detail->value}}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                       id="navbarContractActionMenu{{$detail->id}}"
                                       data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="true">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <div class="dropdown-menu"
                                         aria-labelledby="navbarContractActionMenu{{$detail->id}}">
                                        <a rel="tooltip" class="dropdown-item"
                                           href="{{ route('details.show', $detail) }}"
                                           data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                           data-redirect="true"
                                           data-href="{{ route('details.show', $detail) }}"
                                           data-original-title="" title="">
                                            <i class="material-icons">visibility</i> {{__('dashboard.show_detail')}}

                                        </a>
                                        <a rel="tooltip" class="dropdown-item"
                                           href="{{ route('details.edit', $detail) }}"
                                           data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                           data-redirect="true"
                                           data-href="{{ route('details.edit', $detail) }}"
                                           data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit->id}}/details"
                                           data-original-title="" title="">
                                            <i class="material-icons">edit</i> {{__('dashboard.edit_detail')}}

                                        </a>
                                        <a class="dropdown-item btn-delete-confirm"
                                           data-href="{{route('details.destroy', $detail) }}"
                                           data-redirect="true"
                                           data-text="{{$detail->detail}}/{{$detail->value}}"
                                           data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit->id}}/details">
                                            <i class="material-icons">close</i> {{__('dashboard.delete_detail')}}

                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
