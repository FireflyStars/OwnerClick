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
                    <label class="text-dark">{{__('dashboard.due_date')}}:</label>
                    <span class="font-size-14px">{{$paymentDept->due_date}}</span>
                </div>
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.created_date')}}:</label>
                <span class="font-size-14px">{{$paymentDept->created_at->format(auth()->user()->date_format)}}</span>
            </div>
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.updated_date')}}:</label>
                <span class="font-size-14px">{{$paymentDept->updated_at->format(auth()->user()->date_format)}}</span>
            </div>
            <div class="col-sm-4 col-auto">
                <label class="text-dark">{{__('dashboard.payment')}} ID:</label>
                <span class="font-size-14px">#{{$paymentDept->id}}</span>
            </div>
            @if($paymentDept->payment_type_id != null)
                <div class="col-sm-4 col-auto">
                    <label class="text-dark">{{__('dashboard.payment_type')}}:</label>
                    <span
                        class="font-size-14px">{{\App\Models\Payment::getPaymentTypes()[$paymentDept->payment_type_id]['name']}}</span>
                </div>
            @endif
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.creator')}}:</label>
                <span class="font-size-14px">{{$paymentDept->creator->name}}</span>
            </div>
            <div class="col-sm-4 col-auto">
                <label class="text-dark">{{__('dashboard.payment_method')}}:</label>
                <span class="font-size-14px">{{\App\Models\Payment::getPaymentMethod()[$paymentDept->payment_method_id]['name']}}</span>
            </div>
          @if($paymentDept->payment_account_id !== null)
            <div class="col-sm-4 col-auto">
                <label class="text-dark">{{__('dashboard.payment_account')}}:</label>
                <span class="font-size-14px">{{$paymentDept->account->account_name}}</span>
            </div>
                @endif
            <div class="col-md-4">
                <label class="text-dark">{{__('dashboard.amount')}}:</label>
                <span class="font-size-14px">{{$paymentDept->amount}}{{$paymentDept->currency}}</span>
            </div>

            @if($paymentDept->contract != null)
                <div class="col-md-12">
                    <label class="text-dark">{{__('dashboard.contract')}}:</label>
                    <span
                        class="font-size-14px">{{$paymentDept->contract->template->name}} {{$paymentDept->contract->start_date}}-{{$paymentDept->contract->end_date}}</span>
                </div>
            @endif
            <div class="col-md-12">
                <label class="text-dark">{{__('dashboard.comment')}}:</label>
                <span class="font-size-14px">{{$paymentDept->comment}}</span>
            </div>
        </div>
        @if(count($payments) >0)
            <br/>
            <h6>{{__('dashboard.payments')}}</h6>
            @include('tables.paymentsAmount',['dashboard'=>false,'refPayments'=>$payments])
        @endif

    </div>
    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info ">{{__('dashboard.close')}}</button>
    </div>
</div>


