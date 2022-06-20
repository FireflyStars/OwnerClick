@if($contract)
    <div class="card card-stats">
    <div class="card-header card-header-info  card-header-icon">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <p class="card-category">{{__('dashboard.days_remaining')}}</p>
        <h3 class="card-title">{{$contract->expiryDay()}}</h3>
    </div>
    <div class="card-footer">
        <div class="stats">
            <a href="{{ route('contract.get-renewal',$contract->id) }}" data-toggle="modal" data-backdrop="static"
               data-target="#ajaxModal" data-redirect="true"
               data-href="{{ route('contract.get-renewal',$contract->id) }}"
               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit->id}}/details"
               class="@if($contract->isExpired())  text-danger @else text-dark  @endif"><i class="material-icons float-left">sync</i>{{__('dashboard.renew_contract')}}</a>
        </div>
    </div>
</div>
@endif
