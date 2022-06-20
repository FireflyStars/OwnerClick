
    {{--    @if(!\hisorange\BrowserDetect\Parser::isMobile())--}}
    {{--        <div class="card-header">--}}
    {{--            <h4 class="card-title">{{\Carbon\Carbon::now()->format('F')}} {{__('dashboard.received')}}</h4>--}}
    {{--        </div>--}}
    {{--    @endif--}}
    <div class="card-body">
        <div class="d-flex justify-content-center  py-1">
            <div class="tab-pane" id="welcome">
                <div class="row text-center">
                    @if(\Illuminate\Support\Facades\Auth::user()->avatar != null)
                        <div class="profile-circle-mini m-auto"
                             style="background: url('{{\Illuminate\Support\Facades\Auth::user()->avatar}}')"></div>
                    @else
                        <img src="/img/logor.png" style="width: 200px" class="m-auto" width="150"/>
                    @endif
                    <h4 class="mb-0 font-weight-normal">{{auth()->user()->name}}</h4>
                    <div class="d-none d-sm-block font-size-12px">{{auth()->user()->email}}</div>
                        <a href="{{route('payments.payments',['end_date'=>\Carbon\Carbon::now()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]])}}" data-toggle="modal" data-backdrop="static"
                           data-target="#paymentTotal"
                           data-href="{{route('payments.payments',['end_date'=>\Carbon\Carbon::now()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT]])}}"
                           class="text-white">
                        <div class="font-size-12px pt-2 pt-sm-4">{{__('dashboard.total_credit')}}</div>
                    <div id="totalCredit"
                        class="h3 font-weight-normal my-0">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($totalDept,\auth()->user()->currency)}}</div>
                        </a>
                </div>
            </div>
        </div>
        {{--        <div class="d-flex justify-content-center">--}}
        {{--         {{__('dashboard.total_credit')}}--}}
        {{--        </div>--}}
        {{--        <div class="d-flex justify-content-center">--}}
        {{--            {{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($totalPayment,\auth()->user()->currency)}}--}}
        {{--        </div>--}}
        <div class="d-flex justify-content-start border-bottom pb-1">
            <div class="font-size-12px">{{\Carbon\Carbon::now()->startOfMonth()->format('d')." - ".\Carbon\Carbon::now()->endOfMonth()->format('d')." ".\Carbon\Carbon::now()->monthName}}</div>
        </div>
        <div class="d-flex justify-content-between pt-2">
            <a href="{{route('payments.payments',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d')])}}" data-toggle="modal" data-backdrop="static"
               data-target="#paymentLast"
               data-href="{{route('payments.payments',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d')])}}"
               class="text-white">
            <div>
                <div class="font-size-12px mb-0">{{__('dashboard.credit')}}</div>
                <div
                    class="font-size-14px font-weight-bold">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($totalAmount,\auth()->user()->currency)}}</div>
            </div>
            </a>
            <div>
                <a href="{{route('payments.payments',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_FULL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_OVER_PAYMENT]])}}" data-toggle="modal" data-backdrop="static"
                   data-target="#paymentLast"
                   data-href="{{route('payments.payments',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_FULL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_OVER_PAYMENT]])}}"
                   class="text-white">    <div class="font-size-12px mb-0">{{__('dashboard.received')}}</div>
                <div
                    class="font-size-14px font-weight-bold">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($totalPayment,\auth()->user()->currency)}}</div>
                </a>
            </div>
            <div>
                <a href="{{route('payments.payments',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_WAITING_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_PENDING_PAYMENT]])}}" data-toggle="modal" data-backdrop="static"
                   data-target="#paymentLast"
                   data-href="{{route('payments.payments',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d'),'status_id'=>[\App\Models\PaymentDept::PAYMENT_STATUS_PARTIAL_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_DELAYED_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_WAITING_PAYMENT,\App\Models\PaymentDept::PAYMENT_STATUS_PENDING_PAYMENT]])}}"
                   class="text-white">    <div class="font-size-12px mb-0">{{__('dashboard.remainder')}}</div>
                <div
                    class="font-size-14px font-weight-bold">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($totalAmount-$totalPayment,\auth()->user()->currency)}}</div>
                </a>
            </div>
        </div>
    </div>

