<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.viewing_payment_information')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body ">
        <h6>{{__('dashboard.credit_information')}}</h6>
        <div class="row">
                <div class="col-md-4">
                    <label class="text-dark">{{__('dashboard.payment_date')}}:</label>
                    <span class="font-size-14px">{{$payment->payment_date}}</span>
                </div>
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.created_date')}}:</label>
                <span class="font-size-14px">{{$payment->created_at->format(auth()->user()->date_format)}}</span>
            </div>
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.updated_date')}}:</label>
                <span class="font-size-14px">{{$payment->updated_at->format(auth()->user()->date_format)}}</span>
            </div>
            <div class="col-sm-4 col-auto">
                <label class="text-dark">{{__('dashboard.payment')}} ID:</label>
                <span class="font-size-14px">#{{$payment->id}}</span>
            </div>
            @if($payment->payment_type_id != null)
                <div class="col-sm-4 col-auto">
                    <label class="text-dark">{{__('dashboard.payment_type')}}:</label>
                    <span
                        class="font-size-14px">{{\App\Models\Payment::getPaymentTypes()[$payment->payment_type_id]['name']}}</span>
                </div>
            @endif
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.creator')}}:</label>
                <span class="font-size-14px">{{$payment->creator->name}}</span>
            </div>
            <div class="col-sm-4 col-auto">
                <label class="text-dark">{{__('dashboard.payment_method')}}:</label>
                <span class="font-size-14px">{{\App\Models\Payment::getPaymentMethod()[$payment->payment_method_id]['name']}}</span>
            </div>
          @if($payment->payment_account_id !== null)
            <div class="col-sm-4 col-auto">
                <label class="text-dark">{{__('dashboard.payment_account')}}:</label>
                <span class="font-size-14px">{{$payment->account->account_name}}</span>
            </div>
                @endif
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.amount')}}:</label>
                <span class="font-size-14px">{{$payment->amount}}{{$payment->currency}}</span>
            </div>

            @if($payment->contract != null)
                <div class="col-md-12">
                    <label class="text-dark">{{__('dashboard.contract')}}:</label>
                    <span
                        class="font-size-14px">{{$payment->contract->template->name}} {{$payment->contract->start_date}}-{{$payment->contract->end_date}}</span>
                </div>
            @endif
            <div class="col-md-12">
                <label class="text-dark">{{__('dashboard.comment')}}:</label>
                <span class="font-size-14px">{{$payment->comment}}</span>
            </div>
        </div>

    </div>
    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info ">{{__('dashboard.close')}}</button>
    </div>
</div>



