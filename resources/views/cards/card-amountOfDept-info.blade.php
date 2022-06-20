<div class="card card-stats">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">store</i>
        </div>
        <p class="card-category">{{__('dashboard.dept_amount')}}</p>
        <a href="{{route('payments.payments',['unit_id'=>$unit_id,'end_date'=>\Carbon\Carbon::now()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]])}}" data-toggle="modal" data-backdrop="static"
           data-target="#paymentTotal"
           data-href="{{route('payments.payments',['unit_id'=>$unit_id,'end_date'=>\Carbon\Carbon::now()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]])}}"
           class="text-white">
        <h3 class="card-title">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($amountOfDept,$currency)}}</h3>
        </a>
    </div>
    <div class="card-footer">
        <div class="stats d-flex align-items-md-center">
                <i class="fa fa-hand-holding-usd pr-1"></i> {{__('dashboard.deposit_fee')}} : {{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($unit->contract->deposit_price,$unit->contract->deposit_currency)}}
        </div>
    </div>
</div>
