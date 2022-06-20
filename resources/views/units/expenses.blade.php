<div class="card">
    <div class="card-header card-header-info card-header-icon">
    <div class="card-icon">
        <i class="material-icons">format_paint</i>
    </div>
    <h4 class="card-title">{{__('dashboard.outgoings')}}</h4>
</div>
<div class="card-body card-menu">
    <div class="tab-pane" id="expenses">
        @if($outgoings)
        <div class="text-right">
            <a href="{{ route('outgoings.create') }}" data-toggle="modal" data-backdrop="static"
               data-target="#ajaxModal" data-redirect="true"
               data-href="{{ route('outgoings.create') }}?unit_id={{$unit_id}}"
               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/expenses"
               class="btn  btn-info mobile-fixed-circle-button"> <i
                    class="material-icons">add</i>
                <span class="d-none d-sm-inline-block">{{__('dashboard.new_outgoing')}}</span></a>
        </div>
        @endif
        @if(!$outgoings)
            <div class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
                <i class="fas fa-cash-register fa-6x"></i>
                <h3>{{__('dashboard.create_your_first_outgoing')}}</h3>
                <span class="description">{{__('dashboard.create_your_first_outgoing_description')}}</span>
                <div class=" m-3">
                    <a href="{{ route('outgoings.create') }}" data-toggle="modal" data-backdrop="static"
                       data-target="#ajaxModal" data-redirect="true"
                       data-href="{{ route('outgoings.create') }}?unit_id={{$unit_id}}"
                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/expenses"
                       class="btn  btn-info"> <i
                            class="material-icons">add</i>
                        <span >{{__('dashboard.new_outgoing')}}</span></a>
                </div>
            </div>
        @else
            <table class="table table-hover">
                <thead class="text-info">
                <tr>
                    <th>ID</th>
                    <th>{{__('dashboard.type')}}</th>
                    <th>{{__('dashboard.amount')}}</th>
                    <th>{{__('dashboard.outgoing_date')}}</th>
                    <th class="text-right">{{__('dashboard.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($outgoings as $payment)
                    <tr>
                        <td>{{$payment['id']}}</td>
                        <td>
                            <b>{!! \App\Models\Outgoing::getPropertyTypes()[$payment['payment_type_id']]['name']!!}</b><br/>{{$payment['name']}}
                        </td>
                        <td>{{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($payment['amount'],$payment['currency'])}}</td>
                        <td>{{$payment['outgoing_date']}}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                                   id="navbarContractActionMenu{{$payment->id}}"
                                   data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="true">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <div class="dropdown-menu"
                                     aria-labelledby="navbarContractActionMenu{{$payment->id}}">
                                    <a rel="tooltip" class="dropdown-item"
                                       href="{{ route('outgoings.show', $payment) }}"
                                       data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                       data-redirect="true"
                                       data-href="{{ route('outgoings.show', $payment) }}"
                                       data-original-title="" title="">
                                        <i class="material-icons">visibility</i> {{__('dashboard.show_outgoing')}}
                                    </a>
                                    <a rel="tooltip" class="dropdown-item"
                                       href="{{ route('outgoings.edit', $payment) }}?unit_id={{$unit_id}}"
                                       data-toggle="modal"  data-backdrop="static" data-target="#ajaxModal"
                                       data-redirect="true"
                                       data-href="{{ route('outgoings.edit', $payment) }}?unit_id={{$unit_id}}"
                                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/expenses"
                                       data-original-title="" title="">
                                        <i class="material-icons">edit</i>{{__('dashboard.edit_outgoing')}}
                                    </a>
                                    <a class="dropdown-item btn-delete-confirm"
                                       data-href="{{route('outgoings.destroy', $payment) }}"
                                       data-redirect="true"
                                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/expenses"
                                       data-text="{{$payment->outgoing_date}} tarihli {{$payment->amount}}{{$payment->currency}} ödeme">
                                        <i class="material-icons">close</i>{{__('dashboard.delete_outgoing')}}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
    </div>
</div>
