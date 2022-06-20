@extends('layouts.app', ['activePage' => 'fixtures', 'titlePage' => __('dashboard.fixtures')])

@section('content')
    <?php
    /**
     * @var \App\Models\Fixture $fixtures
     */
    ?>
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <h4 class="card-title">{{__('dashboard.fixtures')}}</h4>
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
                                @if(count($fixtures) != 0)
                                <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('fixtures.create') }}" data-redirect-target="#ajax-content" data-redirect-href="/fixtures" data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal" data-redirect="true"  data-href="{{ route('fixtures.create') }}" class="btn  btn-info mobile-fixed-circle-button">
                                        <i class="material-icons ">add</i>
                                        <span class="d-none d-sm-block"> {{__('dashboard.create_fixture')}}</span></a>
                                </div>
                            </div>
                                @endif
                                @if(count($fixtures) == 0)
                                    <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                                        <i class="fas fa-chair fa-6x"></i>
                                        <h3>{{__('dashboard.create_your_first_fixture')}}</h3>
                                        <span class="description">{{__('dashboard.create_your_first_fixture_description')}}</span>
                                        <div class=" m-3">
                                            <a href="{{ route('fixtures.create') }}" data-redirect-target="#ajax-content" data-redirect-href="/fixtures" data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal" data-redirect="true"  data-href="{{ route('fixtures.create') }}" class="btn  btn-info"> <i
                                                    class="material-icons">add</i>
                                                {{__('dashboard.create_fixture')}}</a>
                                        </div>
                                    </div>
                                @else
                            <div class="table-reponse-temp">
                                <table class="table dataTable" style="width:100%">
                                    <thead class=" text-info">
                                    <th>ID</th>
                                    <th>{{__('dashboard.name')}}</th>
                                    <th>{{__('dashboard.how_many')}}</th>
                                    <th>{{__('dashboard.property')}}</th>
                                    <th>{{__('dashboard.status')}}</th>
                                    <th class="text-right">
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($fixtures as $fixture)
                                        <tr>
                                            <td>
                                                {{$fixture->id}}
                                            </td>
                                            <td>
                                                {{$fixture->name}}
                                            </td>
                                            <td>
                                                {{$fixture->count}}
                                            </td>
                                            <td>
                                                {{$fixture->unit->name}}
                                            </td>
                                            <td>
                                                {!! $fixture->getStats(true) !!}
                                            </td>
                                            <td class="td-actions text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                                       id="navbarContractActionMenu{{$fixture->id}}"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="true">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="navbarContractActionMenu{{$fixture->id}}">
                                                        <a rel="tooltip" class="dropdown-item"
                                                           href="{{ route('fixtures.show', $fixture) }}"
                                                           data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                                           data-redirect="true"
                                                           data-href="{{ route('fixtures.show', $fixture) }}"
                                                           data-original-title="" title="">
                                                            <i class="material-icons">visibility</i> {{__('dashboard.show_fixture')}}
                                                        </a>
                                                        <a rel="tooltip" class="dropdown-item"
                                                           href="{{ route('fixtures.edit', $fixture) }}"
                                                           data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                                           data-redirect="true"
                                                           data-href="{{ route('fixtures.edit', $fixture) }}"
                                                           data-redirect-target="#ajax-content" data-redirect-href="/fixtures"
                                                           data-original-title="" title="">
                                                            <i class="material-icons">edit</i>  {{__('dashboard.edit_fixture')}}
                                                        </a>
                                                        <a class="dropdown-item btn-delete-confirm"
                                                           data-href="{{route('fixtures.destroy', $fixture) }}"
                                                           data-redirect="true"
                                                           data-redirect-target="#ajax-content" data-redirect-href="/fixtures"
                                                           data-text="{{$fixture->name}}">
                                                            <i class="material-icons">close</i> {{__('dashboard.delete_fixture')}}
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
@endsection
