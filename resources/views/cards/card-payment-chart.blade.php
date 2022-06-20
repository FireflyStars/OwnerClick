<div class="card mt-0 ">
    @if(!\hisorange\BrowserDetect\Parser::isMobile())
        <div class="card-header">
        <h4 class="card-title">{{__('dashboard.payments')}}</h4>
    </div>
    @endif
    <div class="card-body">
        <div id="paymentChart"  style="height: 80vh"></div>
    </div>
    {{--                        <div class="card-footer">--}}
        {{--                            <div class="stats">--}}
            {{--                                <i class="material-icons">date_range</i> Son 30 Gün--}}
            {{--                            </div>--}}
        {{--                        </div>--}}
</div>

