@if($contract)
    <div class="card card-stats">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">attach_money</i>
        </div>
        <p class="card-category">{{__('dashboard.rent_fee')}}</p>
        <h3 class="card-title">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($contract->rental_price,$contract->rental_currency)}}</h3>
    </div>
    <div class="card-footer">
        <div class="stats">
{{--            <i class="material-icons">date_range</i> {{__('dashboard.payment_day')}}--}}
{{--            : {{ \App\Models\Contract::getPaymentPeriods()[$contract->payment_period]['name'] }}--}}
{{--            / Ayın {{ (\Carbon\Carbon::createFromFormat(\auth()->user()->date_format, $contract->start_date))->format('j') }}. Gün--}}
            <i class="fa fa-hand-holding-usd pr-1"></i> {{__('dashboard.deposit_fee')}} : {{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($contract->deposit_price,$contract->deposit_currency)}}
        </div>
    </div>
</div>
@endif
