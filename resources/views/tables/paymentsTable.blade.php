
    <?php
    $header = false;
    $paymentCount = 0;
    $delayPaymentCount = 0;
    ?>
    <table class="table" id="paymentsTable">
        <thead class="  border-bottom text-info title ">
        <tr>
            <th></th>
        <th class="w-50">
            {{__('dashboard.unit')}}/{{__('dashboard.payment_type')}}
        </th>
        @if(!$dashboard AND !\hisorange\BrowserDetect\Parser::isMobile())
            <th>
                {{__('dashboard.status')}}
            </th>
        @endif
        <th>
            {{__('dashboard.due_date')}}
        </th>
        <th class="text-right">
            {{__('dashboard.amount_paid')}}
        </th>
        <th class="px-4"></th>
        </tr>
        </thead>
        <tbody>
    @foreach($paymentDepts as $paymentDept)
        @if(!$dashboard OR ($dashboard AND $paymentDept->amountOfDept < $paymentDept['amount']))

            <tr class=" ">
                <td></td>
                <td class=" ">
                    @if(!isset($unit_id) AND isset($paymentDept->contract->unit))
                        <div class="cursor-pointer" href="#properties" data-toggle="ajax"
                             data-target="#ajax-content" data-redirect="true"
                             data-href="{{ route('units.show', $paymentDept->contract->unit) }}">
                            <div class="unit-span"><span
                                    class="unit-icon"><i class="fa fa-{!! $paymentDept->contract->unit->getTypeIcon() !!}"></i></span>
                                <span class="property-name">{{$paymentDept->contract->unit->property->name}}</span>/<span
                                    class="unit-name">{{$paymentDept->contract->unit->name}}</span></div>
                        </div>
                    @endif
                    {{--                @if(!$dashboard)--}}
                    {{--                    <div class="d-none d-sm-table-cell">{{$paymentDept['id']}}</div>--}}
                    {{--                @endif--}}
                    <div
                        class="@if(isset($unit_id)) font-weight-bold @else text-gray font-small @endif">{!! \App\Models\Payment::getPaymentTypes()[$paymentDept['payment_type_id']]['name']!!}</div>
                    @if(isset($unit_id))
                        <div class="text-gray font-small">{{$paymentDept['comment']}}</div>
                    @endif
                </td>
                @if(!$dashboard AND !isset($unit_id))
                    <td >{{$paymentDept['comment']}}</td>
                @endif
                @if(!$dashboard AND !\hisorange\BrowserDetect\Parser::isMobile())
                    @if($paymentDept->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE )
                        <td
                            >{!! $paymentDept->getStatus(true) !!}</td>
                    @else
                        <td
{{--                            class="  @if(isset($unit_id)) col-3 @else col-2 @endif col-sm-2">{!! $paymentDept->getStatusForAmount($paymentDept['amount'],$paymentDept->amountOfDept,$paymentDept->due_date,true) !!}</div>--}}
                           >{!! $paymentDept->getStatus(true) !!}</td>
                    @endif
                @endif
                <td
                   >{{$paymentDept['due_date']}}</td>
                <td class="  text-right ">
                    <div class="d-table-cell d-sm-none text-gray font-small">{{$paymentDept['due_date']}}</div>
                    {!! $paymentDept->getAmaountWithStatusColor($paymentDept['amount'],$paymentDept->amountOfDept,$paymentDept->due_date,$paymentDept['currency']) !!}
                    {{--                    <div><span class="price">{{$paymentDept->amountOfDept}}</span><span class="price">/</span><span--}}
                    {{--                            class="price">{{$paymentDept['amount']}}</span><span--}}
                    {{--                            class="price-currency">{{$paymentDept['currency']}}</span></div>--}}

                </td>
                <td class="text-right">
                    <div class="dropdown float-right">
                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                           id="navbarContractActionMenu{{$paymentDept->id}}"
                           data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="true">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <div class="dropdown-menu"
                             aria-labelledby="navbarContractActionMenu{{$paymentDept->id}}">
                            @if($paymentDept->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE)
                                <a class="dropdown-item"
                                   href="{{route('payments.active', $paymentDept) }}"
                                   data-href="{{route('payments.active', $paymentDept) }}"
                                   data-toggle="ajax"
                                   data-push-history="false"
                                   @if($dashboard)
                                   data-redirect-target="#overdue_payments"
                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"
                                   @else
                                   data-redirect-target="#propertyDetailContent"
                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"
                                   @endif
                                   data-text="{{$paymentDept->due_date}} tarihli {{$paymentDept->amount}}{{$paymentDept->currency}} ??deme">
                                    <i class="material-icons">history</i>{{__('dashboard.activate')}}
                                </a>
                            @else
                                <a rel="tooltip" href="{{ route('payments.create') }}"
                                   data-toggle="modal"
                                   data-target="#ajaxModal" data-redirect="true"
                                   data-href="{{ route('payments.create', $paymentDept) }}&ref_payment_id={{$paymentDept->id}}&status_id={{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"
                                   @if($dashboard)
                                   data-redirect-target="#overdue_payments"
                                   data-redirect-href="{{route('home.overdue-payments',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                                   @else
                                   data-redirect-target="#propertyDetailContent"
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
                                   @endif
                                   class="dropdown-item"> <i class="material-icons">check</i>
                                    {{__('dashboard.report_payment')}}</a>
                                <a rel="tooltip" href="{{ route('payment-depts.show',$paymentDept) }}"
                                   data-toggle="modal"
                                   data-target="#ajaxModal" data-redirect="true"
                                   data-href="{{ route('payment-depts.show', $paymentDept) }}"
                                   @if($dashboard)
                                   data-redirect-target="#overdue_payments"
                                   data-redirect-href="{{route('home.overdue-payments',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                                   @else
                                   data-redirect-target="#propertyDetailContent"
{{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
                                   @endif
                                   class="dropdown-item"> <i class="material-icons">visibility</i>
                                    {{__('dashboard.details_credit')}}</a>
                                <a rel="tooltip" class="dropdown-item "
                                   href="{{ route('payment-depts.edit', $paymentDept) }}?unit_id=@if(isset($unit_id)){{$unit_id}}@else{{$paymentDept->contract->unit_id}}@endif"
                                   data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"
                                   data-redirect="true"
                                   data-href="{{ route('payment-depts.edit', $paymentDept) }}?unit_id=@if(isset($unit_id)){{$unit_id}}@else{{$paymentDept->contract->unit_id}}@endif"
                                   @if($dashboard)
                                   data-redirect-target="#overdue_payments"
                                   data-redirect-href="{{route('home.overdue-payments',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                                   @else
                                   data-redirect-target="#propertyDetailContent"
                                   data-redirect-href="{{route('units.payment-depts',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                                   @endif
                                   data-original-title="" title="">
                                    <i class="material-icons">edit</i>{{__('dashboard.edit_credit')}}
                                </a>
                                <a class="dropdown-item btn-cancel-confirm"
                                   data-href="{{route('payments.passive', $paymentDept) }}"
                                   data-redirect="true"
                                   @if($dashboard)
                                   data-redirect-target="#overdue_payments"
                                   data-redirect-href="{{route('home.overdue-payments',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                                   {{--                                   data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
                                   @else
                                   data-redirect-target="#propertyDetailContent"
                                   data-redirect-href="{{route('units.payment-depts',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                                   @endif
                                   data-text="{{$paymentDept->due_date}} tarihli {{$paymentDept->amount}}{{$paymentDept->currency}} ??deme">
                                    <i class="material-icons">money_off</i>{{__('dashboard.deactivate')}}
                                </a>
                            @endif
                            <a class="dropdown-item btn-delete-confirm"
                               data-href="{{route('payment-depts.destroy', $paymentDept) }}"
                               data-redirect="true"
                               @if($dashboard)
                               data-redirect-target="#overdue_payments"
                               data-redirect-href="{{route('home.overdue-payments',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"

                               {{--                               data-redirect-href="{{route('home.overdue-payments',$unit_id)}}"--}}
                               @else
                               data-redirect-target="#propertyDetailContent"
                               data-redirect-href="{{route('units.payment-depts',(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id)}}"
                               @endif
                               data-text="{{$paymentDept->payment_date}} tarihli {{$paymentDept->amount}}{{$paymentDept->currency}} ??deme">
                                <i class="material-icons">close</i>{{__('dashboard.delete_credit_dept')}}
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php $paymentCount++; ?>
        @endif
    @endforeach
        </tbody>
               </table>
    @if($paymentCount == 0)
    <div
        class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
        <i class="fas fa-credit-card fa-6x"></i>
        @if($dashboard)
            <h3>{{__('dashboard.no_delayed_payment')}}</h3>
            <span class="description">{{__('dashboard.no_delayed_payment_description')}}</span>
        @else
            <h3>{{__('dashboard.create_your_first_payment')}}</h3>
            <span class="description">{{__('dashboard.create_your_first_payment_description')}}</span>
            <div class=" m-3">
                <a href="{{ route('payment-depts.create') }}" data-toggle="modal" data-backdrop="static"
                   data-target="#ajaxModal" data-redirect="true"
                   data-href="{{ route('payment-depts.create') }}"
                   data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{(isset($unit_id))?$unit_id:$paymentDept->contract->unit_id}}/payment-depts"
                   class="btn  btn-info "> <i
                        class="material-icons">add</i>
                    <span>{{__('dashboard.add_credit')}}</span></a>
            </div>
        @endif
    </div>
    @endif



    {{--    <table class="table table-hover">--}}
    {{--        <thead class="text-info">--}}
    {{--        <tr>--}}
    {{--            @if(!isset($unit_id) AND isset($paymentDepts[0]->contract->unit))--}}
    {{--                <th>{{__('dashboard.unit')}}</th>--}}
    {{--            @endif--}}
    {{--                @if(!$dashboard)--}}
    {{--                <th class="d-none d-sm-table-cell">ID</th>--}}
    {{--            @endif--}}
    {{--            <th>T??r</th>--}}
    {{--            <th>{{__('dashboard.amount_paid')}}</th>--}}
    {{--            <th>{{__('dashboard.due_date')}}</th>--}}
    {{--            @if(!$dashboard)--}}
    {{--                <th>{{__('dashboard.status')}}</th>--}}
    {{--            @endif--}}
    {{--            <th class="text-right">{{__('dashboard.actions')}}</th>--}}
    {{--        </tr>--}}
    {{--        </thead>--}}
    {{--        <tbody>--}}
    {{--        @foreach($paymentDepts as $paymentDept)--}}
    {{--            @if(!$dashboard OR ($dashboard AND $paymentDept->amountOfDept < $paymentDept['amount']))--}}
    {{--            <tr>--}}
    {{--                @if(!isset($unit_id) AND isset($paymentDept->contract->unit))--}}
    {{--                    <td class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
    {{--                        data-target="#ajax-content" data-redirect="true"--}}
    {{--                        data-href="{{ route('units.show', $paymentDept->contract->unit) }}"><div class="unit-span"><span class="unit-icon">{!! $paymentDept->contract->unit->property->getType(false,true) !!}</span> <span class="property-name">{{$paymentDept->contract->unit->property->name}}</span>/<span class="unit-name">{{$paymentDept->contract->unit->name}}</span></div></td>--}}
    {{--                @endif--}}

    {{--            @if(!$dashboard)--}}
    {{--                    <td class="d-none d-sm-table-cell">{{$paymentDept['id']}}</td>--}}
    {{--                @endif--}}
    {{--                <td>--}}
    {{--                    <b>{!! \App\Models\Payment::getPaymentTypes()[$paymentDept['payment_type_id']]['name']!!}</b>--}}
    {{--                    @if(!$dashboard)--}}
    {{--                        <div class="d-none d-sm-block">{{$paymentDept['comment']}}</div>--}}
    {{--                    @endif--}}
    {{--                    <div class="d-inline-block d-sm-none">{{$paymentDept['due_date']}}</div>--}}
    {{--                </td>--}}
    {{--                    <td><span class="price">{{$paymentDept->amountOfDept}}</span><span class="price">/</span><span class="price">{{$paymentDept['amount']}}</span> <span class="price-currency">{{$paymentDept['currency']}}</span></td>--}}
    {{--                <td class="d-none d-sm-table-cell">{{$paymentDept['due_date']}}</td>--}}
    {{--                @if(!$dashboard)--}}
    {{--                    @if($paymentDept->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE )--}}
    {{--                        <td>{!! $paymentDept->getStatus(true) !!}</td>--}}
    {{--                    @else--}}
    {{--                        <td>{!! $paymentDept->getStatusForAmount($paymentDept['amount'],$paymentDept['amountOfDept'],$paymentDept->due_date,true) !!}</td>--}}
    {{--                    @endif--}}
    {{--                @endif--}}
    {{--                <td class="text-right">--}}
    {{--                    <div class="dropdown float-right">--}}
    {{--                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"--}}
    {{--                           id="navbarContractActionMenu{{$paymentDept->id}}"--}}
    {{--                           data-toggle="dropdown" aria-haspopup="true"--}}
    {{--                           aria-expanded="true">--}}
    {{--                            <i class="material-icons">more_vert</i>--}}
    {{--                        </a>--}}
    {{--                        <div class="dropdown-menu"--}}
    {{--                             aria-labelledby="navbarContractActionMenu{{$paymentDept->id}}">--}}
    {{--                            @if($paymentDept->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE)--}}
    {{--                                <a class="dropdown-item"--}}
    {{--                                   href="{{route('payments.active', $paymentDept) }}"--}}
    {{--                                   data-href="{{route('payments.active', $paymentDept) }}"--}}
    {{--                                   data-toggle="ajax"--}}
    {{--                                   data-push-history="false"--}}
    {{--                                   data-redirect-target="#propertyDetailContent"--}}
    {{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
    {{--                                   data-text="{{$paymentDept->due_date}} tarihli {{$paymentDept->amount}}{{$paymentDept->currency}} ??deme">--}}
    {{--                                    <i class="material-icons">history</i>{{__('dashboard.activate')}}--}}
    {{--                                </a>--}}
    {{--                            @else--}}
    {{--                                <a rel="tooltip" href="{{ route('payments.create') }}"--}}
    {{--                                   data-toggle="modal"--}}
    {{--                                   data-target="#ajaxModal" data-redirect="true"--}}
    {{--                                   data-href="{{ route('payments.create', $paymentDept) }}&ref_payment_id={{$paymentDept->id}}&status_id={{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"--}}
    {{--                                   data-redirect-target="#propertyDetailContent"--}}
    {{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
    {{--                                   class="dropdown-item"> <i class="material-icons">check</i>--}}
    {{--                                    {{__('dashboard.report_payment')}}</a>--}}
    {{--                                <a rel="tooltip" href="{{ route('payments.show',$paymentDept) }}"--}}
    {{--                                   data-toggle="modal"--}}
    {{--                                   data-target="#ajaxModal" data-redirect="true"--}}
    {{--                                   data-href="{{ route('payments.show', $paymentDept) }}"--}}
    {{--                                   data-redirect-target="#propertyDetailContent"--}}
    {{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
    {{--                                   class="dropdown-item"> <i class="material-icons">visibility</i>--}}
    {{--                                    {{__('dashboard.payment')}} {{__('dashboard.details')}}??</a>--}}
    {{--                                <a rel="tooltip" class="dropdown-item "--}}
    {{--                                   href="{{ route('payment-depts.edit', $paymentDept) }}"--}}
    {{--                                   data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"--}}
    {{--                                   data-redirect="true"--}}
    {{--                                   data-href="{{ route('payments.edit', $paymentDept) }}"--}}
    {{--                                   data-redirect-target="#propertyDetailContent"--}}
    {{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
    {{--                                   data-original-title="" title="">--}}
    {{--                                    <i class="material-icons">edit</i>{{__('dashboard.edit_payment')}}--}}
    {{--                                </a>--}}
    {{--                                <a class="dropdown-item btn-cancel-confirm"--}}
    {{--                                   data-href="{{route('payments.passive', $paymentDept) }}"--}}
    {{--                                   data-redirect="true"--}}
    {{--                                   data-redirect-target="#propertyDetailContent"--}}
    {{--                                   data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
    {{--                                   data-text="{{$paymentDept->due_date}} tarihli {{$paymentDept->amount}}{{$paymentDept->currency}} ??deme">--}}
    {{--                                    <i class="material-icons">money_off</i>{{__('dashboard.deactivate')}}--}}
    {{--                                </a>--}}
    {{--                            @endif--}}
    {{--                            <a class="dropdown-item btn-delete-confirm"--}}
    {{--                               data-href="{{route('payments.destroy', $paymentDept) }}"--}}
    {{--                               data-redirect="true"--}}
    {{--                               data-redirect-target="#propertyDetailContent"--}}
    {{--                               data-redirect-href="/units/{{$unit_id}}/payment-depts"--}}
    {{--                               data-text="{{$paymentDept->payment_date}} tarihli {{$paymentDept->amount}}{{$paymentDept->currency}} ??deme">--}}
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
