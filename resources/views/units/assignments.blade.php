<div class="card">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">{{__('dashboard.contracts')}}</h4>
    </div>
    <div class="card-body ">
        <div class="tab-pane" id="settings">
            <div class="text-right">
                @if($contracts AND $unit->contract === null)
                    <a href="#dashboard-1" data-toggle="modal" data-backdrop="static"
                       data-target="#contractWizardModal" data-redirect="true"
                       data-href="/contracts/wizards/units/{{$unit_id}}"
                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/assignments"
                       class="btn  btn-info mobile-fixed-circle-button"> <i
                            class="material-icons">add</i>
                        <span class="d-none d-sm-inline-block">{{__('dashboard.create_contract')}}</span></a>
                @endif
            </div>
            @if(!$contracts)
                <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                    <i class="fas fa-file-signature fa-6x"></i>
                    <h3>{{__('dashboard.create_your_first_contract')}}</h3>
                    <span class="description">{{__('dashboard.create_your_first_contract_description')}}</span>
                    <div class=" m-3">
                        <a href="#dashboard-1" data-toggle="modal" data-backdrop="static"
                           data-target="#contractWizardModal" data-redirect="true"
                           data-href="/contracts/wizards/units/{{$unit_id}}"
                           data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/assignments"
                           class="btn  btn-info"> <i
                                class="material-icons">add</i>
                            <span>{{__('dashboard.create_contract')}}</span></a>
                    </div>
                </div>
            @else
                <div class="table-reponse-temp">
                    <table class="table table-hover">
                        <thead class="text-info">
                        <tr>
                            <th>ID</th>
                            <th>{{__('dashboard.contract_type')}}</th>
                            <th>{{__('dashboard.contract_date')}}</th>
                            <th class="d-none d-sm-table-cell">{{__('dashboard.end_date')}}</th>
                            <th>{{__('dashboard.status')}}</th>
                            <th class="text-right">{{__('dashboard.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $contract)
                            <tr>
                                <td>{{$contract->id}}</td>
                                <td><b>{{$contract->template->name}}</b></td>
                                <td>{{$contract->start_date}}</td>
                                <td class="d-none d-sm-table-cell">{{$contract->end_date}}</td>
                                <td>{!! $contract->getStatus(true) !!}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                           id="navbarContractActionMenu{{$contract->id}}"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="true">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <div class="dropdown-menu"
                                             aria-labelledby="navbarContractActionMenu{{$contract->id}}">
                                            <a rel="tooltip" class="dropdown-item"
                                               href="{{ route('contracts.show', $contract) }}"
                                               data-toggle="modal"
                                               data-target="#ajaxModal"
                                               data-redirect="true"
                                               data-href="{{ route('contracts.show', $contract) }}"
                                               data-original-title="" title="">
                                                <i class="material-icons">visibility</i>{{__('dashboard.contract_information')}}
                                            </a>
                                            @if($contract->file_id != null AND isset($contract->contractFile->hash))
                                                <a rel="tooltip" class="dropdown-item"
                                                   href="{{route('files.download',$contract->contractFile->hash)  }}"
                                                   data-original-title="" title="">
                                                    <i class="material-icons">cloud_download</i>{{__('dashboard.download_contract')}}

                                                </a>
                                            @endif

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
                                               data-text="{{__('dashboard.remove_payment_with_contract',['templatename'=>$contract->template->name,'contractid' =>$contract->id])}}"
                                               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/assignments">
                                                <i class="material-icons">close</i>{{__('dashboard.delete_contract')}}

                                            </a>

                                                @if($contract->status_id === \App\Models\Contract::CONTRACT_STATUS_ACTIVE)
                                                    <a class="dropdown-item cancelContract @if($unit->contract->isExpired())  text-danger @endif"
                                                            data-contract-id="{{$contract->id}}" data-terminate-href="{{route('contract.terminate',$contract->id)}}"
                                                       data-redirect="false"
                                                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/assignments">
                                                        <i class="material-icons">cancel</i>
                                                        {{__('dashboard.terminate_contract')}}
                                                    </a>


                                            <a href="{{ route('contract.get-renewal',$contract->id) }}" data-toggle="modal" data-backdrop="static"
                                               data-target="#ajaxModal" data-redirect="true"
                                               data-href="{{ route('contract.get-renewal',$contract->id) }}"
                                               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit->id}}/details"
                                               rel="tooltip" class="dropdown-item   @if($unit->contract->isExpired())  text-danger @endif"><i class="material-icons ">sync</i>{{__('dashboard.renew_contract')}}</a>
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
