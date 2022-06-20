@extends('layouts.app', ['activePage' => 'persons', 'titlePage' => __('dashboard.persons')])

@section('content')
    <?php
    /**
     * @var \App\Models\Property $persons
     */
    ?>
    <div class="content ">
        <div class="container-fluid">
            {{--            <div class="row flex-nowrap overflow-auto">--}}
            {{--                <div class="col-10 col-lg-4 col-md-6 col-sm-6">--}}
            {{--                    <div class="card card-stats">--}}
            {{--                        <div class="card-header card-header-info card-header-icon">--}}
            {{--                            <div class="card-icon">--}}
            {{--                                <i class="material-icons">store</i>--}}
            {{--                            </div>--}}
            {{--                            <p class="card-category">{{__('dashboard.person')}} Sayısı</p>--}}
            {{--                            <h3 class="card-title">{{count($persons)}}</h3>--}}
            {{--                        </div>--}}
            {{--                        <div class="card-footer">--}}
            {{--                            <div class="stats">--}}
            {{--                                <i class="material-icons">date_range</i> Aktif {{__('dashboard.person')}} : {{$activePersons}}--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-10 offset-1 offset-sm-0 col-lg-4 col-md-6 col-sm-6">--}}
            {{--                    <div class="card card-stats">--}}
            {{--                        <div class="card-header  card-header-icon">--}}
            {{--                            <div class="card-icon">--}}
            {{--                                <i class="material-icons">assignment</i>--}}
            {{--                            </div>--}}
            {{--                            <p class="card-category">Kurumsal {{__('dashboard.person')}}</p>--}}
            {{--                            <h3 class="card-title">2</h3>--}}
            {{--                        </div>--}}
            {{--                        <div class="card-footer">--}}
            {{--                            <div class="stats">--}}
            {{--                                <i class="material-icons">local_offer</i> Şahıs {{__('dashboard.person')}} : 4--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">{{__('dashboard.persons')}}</h4>
                        </div>
                        <div class="card-body card-menu">
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
                            @if(count($persons) > 1)
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a href="{{ route('persons.create') }}" data-toggle="modal"
                                           data-target="#ajaxModal" data-redirect="true"
                                           data-redirect-target="#ajax-content"
                                           data-redirect-href="{{route('persons.index')}}"
                                           data-href="{{ route('persons.create') }}"
                                           class="btn  btn-info mobile-fixed-circle-button"> <i
                                                class="material-icons">add</i>
                                            <span class="d-none d-sm-block"> {{__('dashboard.add_person')}}</span></a></div>

                                </div>
                            @endif
                            @if(count($persons) == 1)
                                <div
                                    class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                                    <i class="fas fa-address-book fa-6x"></i>
                                    <h3>{{__('dashboard.create_your_first_person')}}</h3>
                                    <span class="description">{{__('dashboard.create_your_first_person_description')}}</span>
                                    <div class=" m-3">
                                        <a href="{{ route('persons.create') }}" data-toggle="modal"
                                           data-target="#ajaxModal" data-redirect="true"
                                           data-redirect-target="#ajax-content"
                                           data-redirect-href="{{route('persons.index')}}"
                                           data-href="{{ route('persons.create') }}"
                                           class="btn  btn-info"> <i
                                                class="material-icons">add</i>
                                            {{__('dashboard.add_person')}}</a>
                                    </div>
                                </div>
                            @else
                                <div class="table-reponse-temp">
                                    <table class="table dataTable" style="width:100%">
                                        <thead class=" text-info">
                                        <th>ID</th>
                                        <th>{{__('dashboard.type')}}</th>
                                        <th>{{__('dashboard.person_name')}}</th>
                                        <th>{{__('dashboard.authorized')}}</th>
                                        <th>{{__('dashboard.authorized_phone')}}</th>
                                        <th>{{__('dashboard.status')}}</th>
                                        <th>{{__('dashboard.units')}}</th>
                                        <th class="text-right">{{__('dashboard.actions')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($persons as $person)
                                            <tr>
                                                <td class="d-none d-sm-table-cell">
                                                    {{$person['id']}}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {!! $person->getType(true) !!}
                                                </td>
                                                <td>
                                                    {{ $person->name }} {!! \App\Models\Person::yoursBadge($person->user_id,true) !!}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {{$person['authorized_person']}}
                                                </td>
                                                <td>
                                                    {{$person['authorized_person_phone']}}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {!! $person->getStatus(true) !!}
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    @foreach(\App\Models\ContractPersons::query()->join('contracts','contract_id','=','contracts.id')->where('person_id',$person->id)->get('unit_id')->unique('unit_id')->toArray() as $units)
                                                        <a href="{{ route('units.show', $units['unit_id']) }}"
                                                           data-href="{{ route('units.show', $units['unit_id']) }}"
                                                           data-toggle="ajax"
                                                           data-target="#ajax-content" data-redirect="true"> <span
                                                                class="badge badge-warning ">#{{$units['unit_id']}}</span></a>
                                                    @endforeach
                                                </td>
                                                <td class="td-actions text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-just-icon btn-link btn-secondary text-dark"
                                                           href="#pablo"
                                                           id="navbarContractActionMenu{{$person->id}}"
                                                           data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="true">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu"
                                                             aria-labelledby="navbarContractActionMenu{{$person->id}}">

                                                            <a rel="tooltip" class="dropdown-item"
                                                               href="{{ route('persons.show', $person) }}"
                                                               data-toggle="modal" data-backdrop="static"
                                                               data-target="#ajaxModal"
                                                               data-redirect="true"
                                                               data-href="{{ route('persons.show', $person) }}"
                                                               data-original-title="" title="">
                                                                <i class="material-icons">visibility</i>{{__('dashboard.show_person')}}
                                                            </a>
                                                            <a rel="tooltip" class="dropdown-item"
                                                               href="{{ route('persons.edit', $person) }}"
                                                               data-toggle="modal" data-backdrop="static"
                                                               data-target="#ajaxModal"
                                                               data-redirect="true"
                                                               data-href="{{ route('persons.edit', $person) }}"
                                                               data-redirect-target="#ajax-content"
                                                               data-redirect-href="/persons"
                                                               data-original-title="" title="">
                                                                <i class="material-icons">edit</i>{{__('dashboard.edit_person')}}
                                                            </a>

                                                            @if($person->id !== \Illuminate\Support\Facades\Auth::id())
                                                                <a class="dropdown-item btn-delete-confirm"
                                                                   data-href="{{route('persons.destroy', $person) }}"
                                                                   data-redirect="true"
                                                                   data-redirect-target="#ajax-content"
                                                                   data-redirect-href="/persons"
                                                                   data-text="{{$person->name}}">
                                                                    <i class="material-icons">close</i>{{__('dashboard.delete_person')}}
                                                                </a>
                                                            @endif
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
@endsection
