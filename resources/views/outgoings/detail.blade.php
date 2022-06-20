<td class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.viewing_payment_information')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body ">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.payment')}} ID</b></td>
                <td>#{{$outgoing->id}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.outgoing_type')}}</b></td>
                <td>{{\App\Models\Payment::getPaymentTypes()[$outgoing->payment_type_id]['name']}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.amount')}}</b></td>
                <td>{{$outgoing->amount}}{{$outgoing->currency}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.outgoing_date')}}</b></td>
                <td>{{$outgoing->payment_date}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.title')}}</b></td>
                <td>{{$outgoing->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.comment')}}</b></td>
                <td>{{$outgoing->comment}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.contract')}}</b></td>
                <td>{{@$outgoing->contract->template->name}} {{@$outgoing->contract->start_date}}-{{@$outgoing->contract->end_date}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$outgoing->creator->name}}</td>
            </tr>

            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$outgoing->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$outgoing->updated_at}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$outgoing->updated_at}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.file')}}</b></td>
                <td>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($outgoing->id)?0:1}}" data-onlyread="1" data-outgoing_id="{{$outgoing->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_OUTGOING}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>
                </td>
            </tr>
        </table>

    </div>

    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
    </div>
