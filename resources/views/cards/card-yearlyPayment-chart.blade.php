<div class="card mt-0 ">
    @if(!\hisorange\BrowserDetect\Parser::isMobile())
        <div class="card-header">
            <h4 class="card-title">{{__('dashboard.payments_dept_graph')}}</h4>
{{--            <div class="d-flex align-items-center">--}}
{{--                <h4 class="card-title mr-auto p-3">{{__('dashboard.payments_dept_graph')}}</h4>--}}
{{--                <div class="btn-group" role="group">--}}
{{--                    <input name="yearlyPayment" id="yearlyPaymentInput" class="daterangepicker" />--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    @endif
    <div class="card-body">
        <div id="yearlyPayment"
             data-source="{{(isset($unit))?route('units.dashboard.payments',$unit):route('home.payments')}}"><canvas id="yearlyPaymentCanvas" width="400" ></canvas></div>
    </div>
    {{--                        <div class="card-footer">--}}
    {{--                            <div class="stats">--}}
    {{--                                <i class="material-icons">date_range</i> Son 30 Gün--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
</div>

