@if(!$refPayments)
    <div
        class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
        <i class="fas fa-credit-card fa-6x"></i>
        @if($dashboard)
            <h3>{{__('dashboard.no_payment')}}</h3>
            <span class="description">{{__('dashboard.no_payment_description')}}</span>
        @else
        <h3>{{__('dashboard.create_your_first_payment')}}</h3>
        <span class="description">{{__('dashboard.create_your_first_payment_description')}}</span>
        <div class=" m-3">
            <a href="{{ route('payment-depts.create') }}" data-toggle="modal" data-backdrop="static"
               data-target="#ajaxModal" data-redirect="true"
               data-href="{{ route('payment-depts.create') }}?unit_id={{$unit_id}}"
               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/payment-depts"
               class="btn  btn-info "> <i
                    class="material-icons">add</i>
                <span>{{__('dashboard.add_credit')}}</span></a>
        </div>
            @endif
    </div>
@else
    <div class="d-none d-sm-flex justify-content-between align-items-center py-2 border-bottom text-info title border-bottom-blue ">
        <div class="d-grid flex-grow-1 pl-2 @if(isset($unit_id)) col-6 @else col-8 @endif col-sm-6">{{__('dashboard.unit')}}/{{__('dashboard.payment_account')}}
        </div>
        <div class="d-sm-table-cell flex-grow-1">{{__('dashboard.payment_date')}}</div>
        <div class="d-flex d-grid flex-column-reverse  text-right flex-grow-1">{{__('dashboard.amount')}}</div>
        <div class="px-4"></div>
    </div>
    @foreach($refPayments as $refPayment)
        <div class="d-flex justify-content-between align-items-center py-2 border-bottom ">
            <div class="d-grid flex-grow-1 pl-2 @if(isset($unit_id)) col-6 @else col-8 @endif col-sm-6">
            @if(isset($refPayment->contract->unit))
                    <div class="cursor-pointer" href="#properties" data-toggle="ajax"
                     data-target="#ajax-content" data-redirect="true"
                     data-href="{{ route('units.show', $refPayment->contract->unit) }}">
                    @if(!isset($unit_id))
                        <div class="unit-span"><span
                                class="unit-icon"><i class="fa fa-{!! $refPayment->contract->unit->getTypeIcon() !!}"></i></span>
                            <span class="property-name">{{$refPayment->contract->unit->property->name}}</span>/<span
                                class="unit-name">{{$refPayment->contract->unit->name}}</span></div>
                    @endif
                </div>
                @endif
                <div class="@if(isset($unit_id)) font-weight-normal @else text-gray font-small @endif">{{\App\Models\Payment::getPaymentMethod()[$refPayment->payment_method_id]['name']}}@if($refPayment->account) / {{$refPayment->account->account_name}}@endif</div>
            </div>
            <div class="d-none  d-sm-table-cell flex-grow-1">{{$refPayment->payment_date}}</div>
            <div class="d-flex d-grid flex-column-reverse  text-right flex-grow-1">
                <div class="d-table-cell d-sm-none text-gray font-small">{{$refPayment->payment_date}}</div>
                <div><span class="price">{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($refPayment->amount,$refPayment->currency)}}</span></div>
                {{--                    <td>{{$refPayment->account->account_name}}</td>--}}
            </div>
            <div class="text-right">
                <div class="dropdown float-right">
                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                       id="navbarContractActionMenu{{$refPayment->id}}"
                       data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="true">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <div class="dropdown-menu"
                         aria-labelledby="navbarContractActionMenu{{$refPayment->id}}">
                        @if($refPayment->active == \App\Models\PaymentDept::PAYMENT_ACTIVE_FALSE)

                        @else
                            <a rel="tooltip" href="{{ route('payments.show',$refPayment) }}"
                               data-toggle="modal"
                               data-target="#ajaxModal2" data-redirect="true"
                               data-href="{{ route('payments.show', $refPayment) }}"
                               @if($dashboard)
                               data-redirect-target="#last_payments"
                               data-redirect-href="{{route('home.last-payments',$unit_id)}}"
                               @else
                               data-redirect-target="#propertyDetailContent"
                               data-redirect-href="/units/{{\Illuminate\Support\Facades\Request::input('unit_id')}}/payments"
                               @endif
                               class="dropdown-item"> <i class="material-icons">visibility</i>
                                {{__('dashboard.payment_detail')}}</a>

                            <a rel="tooltip" class="dropdown-item "
                               href="{{ route('payments.edit', $refPayment) }}?unit_id={{\Illuminate\Support\Facades\Request::input('unit_id')}}"
                               data-toggle="modal" data-backdrop="static" data-target="#ajaxModal2"
                               data-redirect="true"
                               @if($dashboard)
                               data-redirect-target="#active-notes,#summaryInfo,#amountOfDept-info,#payment-info"
                               data-redirect-href="{{route('home.last-payments',$unit_id)}},{{route('home.summary-info',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d')])}},{{route('units.dashboard.amountof-dept-info',(isset($unit_id))?$unit_id:'')}},{{route('units.dashboard.payment-info',(isset($unit_id))?$unit_id:'')}}"
                               @else
                               data-redirect-target="#ajaxModal .modal-content,#propertyDetailContent"
                               data-redirect-href="{{ route('payment-depts.show', $refPayment->ref_payment_id) }},/units/{{\Illuminate\Support\Facades\Request::input('unit_id')}}/payment-depts"
                               @endif
                               data-href="{{ route('payments.edit', $refPayment) }}?unit_id={{\Illuminate\Support\Facades\Request::input('unit_id')}}"
                               data-original-title="" title="">
                                <i class="material-icons">edit</i>{{__('dashboard.edit_payment')}}
                            </a>
                        @endif
                        <a class="dropdown-item btn-delete-confirm"
                           data-href="{{route('payments.destroy', $refPayment) }}"
                           data-redirect="true"
                           @if($dashboard)
                           data-redirect-target="#active-notes,#summaryInfo,#amountOfDept-info,#payment-info"
                           data-redirect-href="{{route('home.last-payments',$unit_id)}},{{route('home.summary-info',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d')])}},{{route('units.dashboard.amountof-dept-info',(isset($unit_id))?$unit_id:'')}},{{route('units.dashboard.payment-info',(isset($unit_id))?$unit_id:'')}}"
                           @else
                           data-redirect-target="#ajaxModal .modal-content,#propertyDetailContent"
                           data-redirect-href="{{ route('payments.show', $refPayment->ref_payment_id) }},/units/{{\Illuminate\Support\Facades\Request::input('unit_id')}}/payments"
                           @endif
                           data-text="{{$refPayment->payment_date}} tarihli {{$refPayment->amount}}{{$refPayment->currency}} ödeme">
                            <i class="material-icons">close</i>{{__('dashboard.delete_payment')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
