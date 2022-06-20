<div class="card">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">format_paint</i>
        </div>
        <h4 class="card-title">{{__('dashboard.payments')}}</h4>
    </div>
    <div class="card-body card-menu">
        <div class="tab-pane" id="payment">
            @if($paymentDepts)
            <div class="text-right ">
                <a href="{{ route('payment-depts.create') }}" data-toggle="modal" data-backdrop="static"
                   data-target="#ajaxModal" data-redirect="true"
                   data-href="{{ route('payment-depts.create') }}?unit_id={{$unit_id}}"
                   data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/payment-depts"
                   class="btn  btn-info mobile-fixed-circle-button"> <i
                        class="material-icons">add</i>
                    <span class="d-none d-sm-inline-block">{{__('dashboard.add_credit')}}</span></a>
            </div>
            @endif
         @include('tables.payments',['dashboard'=>false])
        </div>
    </div>
</div>
