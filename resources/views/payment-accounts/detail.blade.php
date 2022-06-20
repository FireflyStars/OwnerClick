<td class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.viewing_payment_account')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.payment_account')}} ID</b></td>
                <td>#{{$paymentAccount->id}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.record_name')}}</b></td>
                <td>
                    {!! $paymentAccount->account_name  !!}
                </td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.owner_account')}}</b></td>
                <td>
                    {!! $paymentAccount->owner_name  !!}
                </td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.iban')}}</b></td>
                <td>
                    {!! $paymentAccount->iban  !!}
                </td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$paymentAccount->creator->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$paymentAccount->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$paymentAccount->updated_at}}</td>
            </tr>
        </table>
        <div class="modal-footer py-0 py-sm-2">
            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
        </div>
    </div>


