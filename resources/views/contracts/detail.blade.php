<div class="modal-content">
<div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.showing_contract')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body ">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.contract')}} ID</b></td>
                <td>#{{$contract->id}}</td>
            </tr>

            <tr>
                <td><b>{{__('dashboard.contract_template')}}</b></td>
                <td>{{ $contract->template->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.property_name')}}</b></td>
                <td>{{$contract->unit->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.rent_fee')}}</b></td>
                <td>{{$contract->rental_price}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.deposit_fee')}}</b></td>
                <td>{{$contract->deposit_price}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.payment_method')}}</b></td>
                <td>{{\App\Models\Payment::getPaymentMethod()[$contract->payment_method_id]['name']}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.payment_account')}}</b></td>
                <td>{{$contract->paymentAccount->account_name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.payment_period')}}</b></td>
                <td>{{\App\Models\Contract::getPaymentPeriods()[$contract->payment_period]['name']}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.contract_start_end_date')}}</b></td>
                <td>{{$contract->start_date}}-{{$contract->end_date}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.comment')}}</b></td>
                <td>{{$contract->notes}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$contract->creator->name}}</td>
            </tr>
                <tr>
                    <td><b>{{__('dashboard.owners')}}</b></td>
                    <td>
                        @foreach($contract->contractPerson as $contractPerson)
                        @if($contractPerson->type_id == \App\Models\ContractPersons::CONTRACT_PERSONS_TYPE_OWNER)
                            {{$contractPerson->person->name}}<br/>
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td><b>{{__('dashboard.tenants')}}</b></td>
                    <td>
                        @foreach($contract->contractPerson as $contractPerson)
                        @if($contractPerson->type_id == \App\Models\ContractPersons::CONTRACT_PERSONS_TYPE_TENANT)
                            {{$contractPerson->person->name}}<br/>
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td><b>{{__('dashboard.guarantors')}}</b></td>
                    <td>
                        @foreach($contract->contractPerson as $contractPerson)
                        @if($contractPerson->type_id == \App\Models\ContractPersons::CONTRACT_PERSONS_TYPE_GUARANTOR)
                            {{$contractPerson->person->name}}<br/>
                        @endif
                        @endforeach
                    </td>
                </tr>
            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$contract->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$contract->updated_at}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.status')}}</b></td>
                <td>{!! $contract->getStatus(true) !!}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.contract_file')}}</b></td>
                {{--                <td>{{ $contract->contractFile->hash}}</td>--}}
                <td>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="0" data-onlyread="1" data-contract_id="{{$contract->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_UNIT_CONTRACT}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
    </div>
</div>
