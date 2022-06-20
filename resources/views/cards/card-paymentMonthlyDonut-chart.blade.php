<div id="monthly_payment" class="card mt-0">
    @if(!\hisorange\BrowserDetect\Parser::isMobile())
    <div class="card-header">
        <h4 class="card-title">{{\Carbon\Carbon::now()->format('F')}} {{__('dashboard.received')}}</h4>
    </div>
    @endif
    <div class="card-body">
        <div id="monthlyPaymentDonut" data-total="{{$totalPayment}}"
             data-current="{{$totalAmount}}"></div>
    </div>
    {{--                        <div class="card-footer">--}}
    {{--                            <div class="stats">--}}
    {{--                                <i class="material-icons">date_range</i> Son 30 Gün--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
</div>
<script>
        window.dashboard.monthlyPaymentDonut()

    if (document.readyState === 'complete') {
        window.dashboard.monthlyPaymentDonut()
    }
</script>
