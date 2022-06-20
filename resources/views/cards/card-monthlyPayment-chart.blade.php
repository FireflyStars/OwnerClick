<div id="monthly_payment" class="card  mt-0">
  @if(!\hisorange\BrowserDetect\Parser::isMobile())
    <div class="card-header">
        <h4 class="card-title">{{__('dashboard.credits')}}</h4>
    </div>
    @endif
    <div class="card-body">
        <div id="overdue_debts" data-total="{{$totalPayment}}"
             data-current="{{$totalAmount}}"></div>
        {{--                            <div id="overdue_active_label"></div>--}}
    </div>
    {{--                        <div class="card-footer">--}}
        {{--                            <div class="stats">--}}
            {{--                                <i class="material-icons">date_range</i> Son 30 Gün--}}
            {{--                            </div>--}}
        {{--                        </div>--}}
</div>
