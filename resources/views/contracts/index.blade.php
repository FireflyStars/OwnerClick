{{--@extends('layouts.app', ['activePage' => 'contracts', 'titlePage' => '{{__('dashboard.contracts')}}'])--}}

{{--@section('content')--}}
    <?php
    /**
     * @var \App\Models\Property $contracts
     */
    ?>
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-0">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">{{__('dashboard.contracts')}}</h4>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
{{--                            <div class="row">--}}
{{--                                <div class="col-12 text-right">--}}
{{--                                    <a href="{{ route('contracts.create') }}" data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal" data-href="{{ route('contracts.create') }}" class="btn  btn-info"> <i--}}
{{--                                            class="material-icons">add</i>--}}
{{--                                        Sözleşme Ekle</a>--}}
{{--                                    <a href="#dashboard-1" data-toggle="modal"--}}
{{--                                       data-target="#contractWizardModal" data-redirect="true"--}}
{{--                                       data-href="{{route('wizard.contracts')}}"--}}
{{--                                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/assignments"--}}
{{--                                       class="btn  btn-info mobile-fixed-circle-button"> <i--}}
{{--                                            class="material-icons">add</i>--}}
{{--                                        <span class="d-none d-sm-inline-block">{{__('dashboard.create_contract')}}</span></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                                @if(count($contracts) == 0)
                                    <hr/>
                                    <div class="text-center h4">{{__('dashboard.no_contract')}}</div>
                                @else
                            <div class="table-reponse-temp">
                                <table class="table dataTable" style="width:100%">
                                    <thead class=" text-info">
                                    <th>ID</th>
                                    <th>{{__('dashboard.property')}}- {{__('dashboard.contract_template')}}</th>
                                    <th>{{__('dashboard.start_date')}}</th>
                                    <th>{{__('dashboard.rent_fee')}}</th>
                                    <th>{{__('dashboard.deposit')}}</th>
                                    <th>{{__('dashboard.status')}}</th>
                                    <th class="text-right">
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($contracts as $contract)
                                        <tr>
                                            <td>
                                                {{$contract['id']}}
                                            </td>
                                            <td class="cursor-pointer" href="#properties" data-toggle="ajax"
                                                data-target="#ajax-content" data-redirect="true"
                                                data-href="{{ route('units.show', $contract->unit) }}"><div class="unit-span"> <span class="unit-icon"><i class="fa fa-{!! $contract->unit->getTypeIcon() !!}"></i></span> <span class="property-name">{{$contract->unit->property->name}}</span>/<span class="unit-name">{{$contract->unit->name}}</span></div>
                                            <span class=" text-gray font-small ">{{$contract->unit->property->address}}</span>
                                            </td>
                                            <td>
                                                {{$contract['start_date']}}
                                            </td>
                                            <td>
                                                {{$contract['rental_price']}} {{$contract['rental_currency']}}
                                            </td>
                                            <td>
                                                {{$contract['deposit_price']}} {{$contract['deposit_currency']}}
                                            </td>
                                            <td>
                                                {!! $contract->getStatus(true) !!}
                                            </td>
                                            <td class="td-actions text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                                       id="navbarContractActionMenu{{$contract->id}}"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="true">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="navbarContractActionMenu{{$contract->id}}">
                                                        @if($contract->file_id != null)
                                                            <a rel="tooltip" class="dropdown-item"
                                                               href="{{route('files.download',$contract->contractFile->hash)  }}"
                                                               data-original-title="" title="">
                                                                <i class="material-icons">cloud_download</i>{{__('dashboard.download_contract')}}

                                                            </a>
                                                        @endif
                                                        <a rel="tooltip" class="dropdown-item"
                                                           href="{{ route('contracts.show', $contract) }}"
                                                           data-toggle="modal"
                                                           data-target="#ajaxModal"
                                                           data-redirect="true"
                                                           data-href="{{ route('contracts.show', $contract) }}"
                                                           data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>{{__('dashboard.contract_information')}}

                                                        </a>
                                                        {{--                                            <a rel="tooltip" class="dropdown-item"--}}
                                                        {{--                                               href="{{ route('contracts.edit', $contract) }}"--}}
                                                        {{--                                               data-toggle="modal"--}}
                                                        {{--                                               data-target="#ajaxModal"--}}
                                                        {{--                                               data-redirect="true"--}}
                                                        {{--                                               data-href="{{ route('contracts.edit', $contract) }}"--}}
                                                        {{--                                               data-original-title="" title="">--}}
                                                        {{--                                                <i class="material-icons">edit</i>Düzenle--}}

                                                        {{--                                            </a>--}}
                                                        <a class="dropdown-item btn-delete-confirm"
                                                           data-href="{{route('contracts.destroy', $contract) }}"
                                                           data-redirect="true"
                                                           data-text="{{$contract->template->name}}/{{$contract->id}}"
                                                           data-redirect-target="#ajax-content" data-redirect-href="/contracts">
                                                            <i class="material-icons">close</i>{{__('dashboard.delete_contract')}}

                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--@endsection--}}
