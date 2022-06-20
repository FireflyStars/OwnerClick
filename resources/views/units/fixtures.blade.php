<div class="card">
    <div class="card-header card-header-info card-header-icon">
    <div class="card-icon">
        <i class="material-icons">event_seat</i>
    </div>
    <h4 class="card-title">{{__('dashboard.fixtures')}}</h4>
</div>
<div class="card-body card-menu">
    <div class="tab-pane" id="fixture">
        @if($fixtures)
        <div class="text-right">
            <a href="{{ route('fixtures.create') }}" data-toggle="modal" data-backdrop="static"
               data-target="#ajaxModal" data-redirect="true"
               data-href="{{ route('fixtures.create') }}?unit_id={{$unit_id}}"
               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/fixtures"
               class="btn  btn-info mobile-fixed-circle-button"> <i
                    class="material-icons">add</i>
                <span class="d-none d-sm-inline-block">{{__('dashboard.new_fixture')}}</span></a>
        </div>
        @endif
        @if(!$fixtures)
            <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                <i class="fas fa-chair fa-6x"></i>
                <h3>{{__('dashboard.create_your_first_fixture')}}</h3>
                <span class="description">{{__('dashboard.create_your_first_fixture_description')}}</span>
                <div class=" m-3">
                    <a href="{{ route('fixtures.create') }}" data-toggle="modal" data-backdrop="static"
                       data-target="#ajaxModal" data-redirect="true"
                       data-href="{{ route('fixtures.create') }}?unit_id={{$unit_id}}"
                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/fixtures"
                       class="btn  btn-info"> <i
                            class="material-icons">add</i>
                        <span >{{__('dashboard.new_fixture')}}</span></a>
                </div>
            </div>
        @else
            <table class="table table-hover">
                <thead class="text-info">
                <tr>
                    <th>ID</th>
                    <th>{{__('dashboard.how_many')}}</th>
                    <th>{{__('dashboard.fixture')}}</th>
                    <th>{{__('dashboard.created_date')}}</th>
                    <th>{{__('dashboard.status')}}</th>
                    <th class="text-right">İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fixtures as $fixture)
                    <tr>
                        <td>{{$fixture->id}}</td>
                        <td>{{$fixture->count}}</td>
                        <td><b>{{$fixture->name}}</b><br/>{{$fixture->comment}}</td>
                        <td>{{$fixture->created_at}}</td>
                        <td>{!! $fixture->getStats(true)!!}</td>
                        <td class="text-right">
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
                                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/fixtures"
                                       data-original-title="" title="">
                                        <i class="material-icons">edit</i>  {{__('dashboard.edit_fixture')}}
                                    </a>
                                    <a class="dropdown-item btn-delete-confirm"
                                       data-href="{{route('fixtures.destroy', $fixture) }}"
                                       data-redirect="true"
                                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/fixtures"
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
        @endif
    </div>
</div>
</div>
