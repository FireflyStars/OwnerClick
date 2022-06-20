<div class="card">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">person</i>
        </div>
        <h4 class="card-title">{{__('dashboard.tenant_guarantor')}}</h4>
    </div>
    <div class="card-body">
        <div class="tab-pane" id="person">
            @if(!$contractPersons)
                <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                    <i class="fas fa-people-arrows fa-6x"></i>
                    <h3>{{__('dashboard.there_is_no_tenant_or_guarantor')}}</h3>
                    <span class="description">{{__('dashboard.there_is_no_tenant_or_guarantor_description')}}</span>

                </div>
            @else
                <table class="table table-hover">
                    <thead class="text-info">
                    <tr>
                        <th>ID</th>
                        <th>{{__('dashboard.person_type')}}</th>
                        <th>{{__('dashboard.name')}}</th>
                        <th>{{__('dashboard.authorized_person')}}</th>
                        <th>{{__('dashboard.authorized_phone')}}</th>
                        <th>{{__('dashboard.contact')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contractPersons as $contractPerson)
                        <tr>
                            <td>{{$contractPerson->person->id}}</td>
                            <td>{!! $contractPerson->getType(true) !!}</td>
                            <td>{{$contractPerson->person->name}}</td>
                            <td>{{$contractPerson->person->authorized_person}}</td>
                            <td>{{$contractPerson->person->authorized_person_phone}}</td>
                            <td>{!! \App\Models\Contract::status(true,$contractPerson->status_id)!!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
