@extends('layouts.app', ['activePage' => 'payment-accounts', 'titlePage' => '{{__('dashboard.bank_accounts')}}'])

@section('content')
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('cards.card-permissions')
                </div>
            </div>
        </div>
    </div>
@endsection

{{--    @foreach($payments as $payment)--}}
{{--        @if(!$dashboard OR ($dashboard AND $payment->amountOfDept < $payment['amount']))--}}
{{--            <div class="d-flex justify-content-between align-items-center py-2 border-bottom ">--}}
{{--                <div class="d-grid flex-grow-1 pl-2 @if(isset($unit_id)) col-6 @else col-8 @endif col-sm-6 ">--}}
{{--                    @if(!isset($unit_id) AND isset($payment->contract->unit))--}}
{{--                        <div class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
{{--                             data-target="#ajax-content" data-redirect="true"--}}
{{--                             data-href="{{ route('units.show', $payment->contract->unit) }}">--}}
{{--                            <div class="unit-span"><span--}}
{{--                                    class="unit-icon">{!! $payment->contract->unit->property->getType(false,true) !!}</span>--}}
{{--                                <span class="property-name">{{$payment->contract->unit->property->name}}</span>/<span--}}
{{--                                    class="unit-name">{{$payment->contract->unit->name}}</span></div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    --}}{{--                @if(!$dashboard)--}}
{{--                    --}}{{--                    <div class="d-none d-sm-table-cell">{{$payment['id']}}</div>--}}
{{--                    --}}{{--                @endif--}}
{{--                    <div--}}
{{--                        class="@if(isset($unit_id)) font-weight-bold @else text-gray font-small @endif">{!! \App\Models\Payment::getPaymentTypes()[$payment['payment_type_id']]['name']!!}</div>--}}
{{--                    @if(isset($unit_id))--}}
{{--                        <div class="text-gray font-small">{{$payment['comment']}}</div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                @if(!$dashboard AND !isset($unit_id))--}}
{{--                    <div class="d-none d-sm-block">{{$payment['comment']}}</div>--}}
{{--                @endif--}}
{{--                @if(!$dashboard AND !\hisorange\BrowserDetect\Parser::isMobile())--}}
{{--                    @if($payment->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE )--}}
{{--                        <div--}}
{{--                            class="flex-grow-1  @if(isset($unit_id)) col-3 @else col-2 @endif col-sm-2">{!! $payment->getStatus(true) !!}</div>--}}
{{--                    @else--}}
{{--                        <div--}}
{{--                            class="flex-grow-1  @if(isset($unit_id)) col-3 @else col-2 @endif col-sm-2">{!! $payment->getStatusForAmount($payment['amount'],$payment->amountOfDept,$payment->due_date,true) !!}</div>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--                <div--}}
{{--                    class="d-none  d-sm-table-cell flex-grow-1  @if(isset($unit_id)) col-3 @else col-2 @endif col-sm-2">{{$payment['due_date']}}</div>--}}
{{--                <div class="d-flex d-grid flex-column-reverse  text-right flex-grow-1">--}}
{{--                    <div class="d-table-cell d-sm-none text-gray font-small">{{$payment['due_date']}}</div>--}}
{{--                    {!! $payment->getAmaountWithStatusColor($payment['amount'],$payment->amountOfDept,$payment->due_date,$payment['currency']) !!}--}}
{{--                    --}}{{--                    <div><span class="price">{{$payment->amountOfDept}}</span><span class="price">/</span><span--}}
{{--                    --}}{{--                            class="price">{{$payment['amount']}}</span><span--}}
{{--                    --}}{{--                            class="price-currency">{{$payment['currency']}}</span></div>--}}

{{--                </div>--}}
{{--                <div class="text-right">--}}
{{--                    <div class="dropdown float-right">--}}
{{--                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"--}}
{{--                           id="navbarContractActionMenu{{$payment->id}}"--}}
{{--                           data-toggle="dropdown" aria-haspopup="true"--}}
{{--                           aria-expanded="true">--}}
{{--                            <i class="material-icons">more_vert</i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu"--}}
{{--                             aria-labelledby="navbarContractActionMenu{{$payment->id}}">--}}
{{--                            @if($payment->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE)--}}
{{--                                <a class="dropdown-item"--}}
{{--                                   href="{{route('payments.active', $payment) }}"--}}
{{--                                   data-href="{{route('payments.active', $payment) }}"--}}
{{--                                   data-toggle="ajax"--}}
{{--                                   data-push-history="false"--}}
{{--                                   @if($dashboard)--}}
{{--                                   data-redirect-target="#overdue_payments"--}}
{{--                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
{{--                                   @else--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   @endif--}}
{{--                                   data-text="{{$payment->due_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                    <i class="material-icons">history</i>{{__('dashboard.activate')}}--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a rel="tooltip" href="{{ route('payments.create') }}"--}}
{{--                                   data-toggle="modal"--}}
{{--                                   data-target="#ajaxModal" data-redirect="true"--}}
{{--                                   data-href="{{ route('payments.create', $payment) }}?unit_id={{$unit_id}}&ref_payment_id={{$payment->id}}&status_id={{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"--}}
{{--                                   @if($dashboard)--}}
{{--                                   data-redirect-target="#overdue_payments"--}}
{{--                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
{{--                                   @else--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   @endif--}}
{{--                                   class="dropdown-item"> <i class="material-icons">check</i>--}}
{{--                                    {{__('dashboard.report_payment')}}</a>--}}
{{--                                <a rel="tooltip" href="{{ route('payments.show',$payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   data-toggle="modal"--}}
{{--                                   data-target="#ajaxModal" data-redirect="true"--}}
{{--                                   data-href="{{ route('payments.show', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   @if($dashboard)--}}
{{--                                   data-redirect-target="#overdue_payments"--}}
{{--                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
{{--                                   @else--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   @endif--}}
{{--                                   class="dropdown-item"> <i class="material-icons">visibility</i>--}}
{{--                                    {{__('dashboard.payment')}} {{__('dashboard.details')}}ı</a>--}}
{{--                                <a rel="tooltip" class="dropdown-item "--}}
{{--                                   href="{{ route('payments.edit', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"--}}
{{--                                   data-redirect="true"--}}
{{--                                   data-href="{{ route('payments.edit', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   @if($dashboard)--}}
{{--                                   data-redirect-target="#overdue_payments"--}}
{{--                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
{{--                                   @else--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   @endif--}}
{{--                                   data-original-title="" title="">--}}
{{--                                    <i class="material-icons">edit</i>{{__('dashboard.edit_payment')}}--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item btn-cancel-confirm"--}}
{{--                                   data-href="{{route('payments.passive', $payment) }}"--}}
{{--                                   data-redirect="true"--}}
{{--                                   @if($dashboard)--}}
{{--                                   data-redirect-target="#overdue_payments"--}}
{{--                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
{{--                                   @else--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   @endif--}}
{{--                                   data-text="{{$payment->due_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                    <i class="material-icons">money_off</i>{{__('dashboard.deactivate')}}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                            <a class="dropdown-item btn-delete-confirm"--}}
{{--                               data-href="{{route('payments.destroy', $payment) }}"--}}
{{--                               data-redirect="true"--}}
{{--                               @if($dashboard)--}}
{{--                               data-redirect-target="#overdue_payments"--}}
{{--                               data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
{{--                               @else--}}
{{--                               data-redirect-target="#propertyDetailContent"--}}
{{--                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                               @endif--}}
{{--                               data-text="{{$payment->payment_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                <i class="material-icons">close</i>{{__('dashboard.delete_payment')}}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endforeach--}}


{{--    <table class="table table-hover">--}}
{{--        <thead class="text-info">--}}
{{--        <tr>--}}
{{--            @if(!isset($unit_id) AND isset($payments[0]->contract->unit))--}}
{{--                <th>{{__('dashboard.unit')}}</th>--}}
{{--            @endif--}}
{{--                @if(!$dashboard)--}}
{{--                <th class="d-none d-sm-table-cell">ID</th>--}}
{{--            @endif--}}
{{--            <th>Tür</th>--}}
{{--            <th>{{__('dashboard.amount_paid')}}</th>--}}
{{--            <th>{{__('dashboard.due_date')}}</th>--}}
{{--            @if(!$dashboard)--}}
{{--                <th>{{__('dashboard.status')}}</th>--}}
{{--            @endif--}}
{{--            <th class="text-right">{{__('dashboard.actions')}}</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($payments as $payment)--}}
{{--            @if(!$dashboard OR ($dashboard AND $payment->amountOfDept < $payment['amount']))--}}
{{--            <tr>--}}
{{--                @if(!isset($unit_id) AND isset($payment->contract->unit))--}}
{{--                    <td class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
{{--                        data-target="#ajax-content" data-redirect="true"--}}
{{--                        data-href="{{ route('units.show', $payment->contract->unit) }}"><div class="unit-span"><span class="unit-icon">{!! $payment->contract->unit->property->getType(false,true) !!}</span> <span class="property-name">{{$payment->contract->unit->property->name}}</span>/<span class="unit-name">{{$payment->contract->unit->name}}</span></div></td>--}}
{{--                @endif--}}

{{--            @if(!$dashboard)--}}
{{--                    <td class="d-none d-sm-table-cell">{{$payment['id']}}</td>--}}
{{--                @endif--}}
{{--                <td>--}}
{{--                    <b>{!! \App\Models\Payment::getPaymentTypes()[$payment['payment_type_id']]['name']!!}</b>--}}
{{--                    @if(!$dashboard)--}}
{{--                        <div class="d-none d-sm-block">{{$payment['comment']}}</div>--}}
{{--                    @endif--}}
{{--                    <div class="d-inline-block d-sm-none">{{$payment['due_date']}}</div>--}}
{{--                </td>--}}
{{--                    <td><span class="price">{{$payment->amountOfDept}}</span><span class="price">/</span><span class="price">{{$payment['amount']}}</span> <span class="price-currency">{{$payment['currency']}}</span></td>--}}
{{--                <td class="d-none d-sm-table-cell">{{$payment['due_date']}}</td>--}}
{{--                @if(!$dashboard)--}}
{{--                    @if($payment->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE )--}}
{{--                        <td>{!! $payment->getStatus(true) !!}</td>--}}
{{--                    @else--}}
{{--                        <td>{!! $payment->getStatusForAmount($payment['amount'],$payment['amountOfDept'],$payment->due_date,true) !!}</td>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--                <td class="text-right">--}}
{{--                    <div class="dropdown float-right">--}}
{{--                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"--}}
{{--                           id="navbarContractActionMenu{{$payment->id}}"--}}
{{--                           data-toggle="dropdown" aria-haspopup="true"--}}
{{--                           aria-expanded="true">--}}
{{--                            <i class="material-icons">more_vert</i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu"--}}
{{--                             aria-labelledby="navbarContractActionMenu{{$payment->id}}">--}}
{{--                            @if($payment->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE)--}}
{{--                                <a class="dropdown-item"--}}
{{--                                   href="{{route('payments.active', $payment) }}"--}}
{{--                                   data-href="{{route('payments.active', $payment) }}"--}}
{{--                                   data-toggle="ajax"--}}
{{--                                   data-push-history="false"--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   data-text="{{$payment->due_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                    <i class="material-icons">history</i>{{__('dashboard.activate')}}--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a rel="tooltip" href="{{ route('payments.create') }}"--}}
{{--                                   data-toggle="modal"--}}
{{--                                   data-target="#ajaxModal" data-redirect="true"--}}
{{--                                   data-href="{{ route('payments.create', $payment) }}?unit_id={{$unit_id}}&ref_payment_id={{$payment->id}}&status_id={{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   class="dropdown-item"> <i class="material-icons">check</i>--}}
{{--                                    {{__('dashboard.report_payment')}}</a>--}}
{{--                                <a rel="tooltip" href="{{ route('payments.show',$payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   data-toggle="modal"--}}
{{--                                   data-target="#ajaxModal" data-redirect="true"--}}
{{--                                   data-href="{{ route('payments.show', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   class="dropdown-item"> <i class="material-icons">visibility</i>--}}
{{--                                    {{__('dashboard.payment')}} {{__('dashboard.details')}}ı</a>--}}
{{--                                <a rel="tooltip" class="dropdown-item "--}}
{{--                                   href="{{ route('payments.edit', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"--}}
{{--                                   data-redirect="true"--}}
{{--                                   data-href="{{ route('payments.edit', $payment) }}?unit_id={{$unit_id}}"--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   data-original-title="" title="">--}}
{{--                                    <i class="material-icons">edit</i>{{__('dashboard.edit_payment')}}--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item btn-cancel-confirm"--}}
{{--                                   data-href="{{route('payments.passive', $payment) }}"--}}
{{--                                   data-redirect="true"--}}
{{--                                   data-redirect-target="#propertyDetailContent"--}}
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                                   data-text="{{$payment->due_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                    <i class="material-icons">money_off</i>{{__('dashboard.deactivate')}}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                            <a class="dropdown-item btn-delete-confirm"--}}
{{--                               data-href="{{route('payments.destroy', $payment) }}"--}}
{{--                               data-redirect="true"--}}
{{--                               data-redirect-target="#propertyDetailContent"--}}
{{--                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
{{--                               data-text="{{$payment->payment_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">--}}
{{--                                <i class="material-icons">close</i>{{__('dashboard.delete_payment')}}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
