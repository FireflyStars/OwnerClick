@if(isset($tenant) AND $tenant)
<div class="card card-stats">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">person</i>
        </div>
        <p class="card-category">{{__('dashboard.tenant')}}</p>
        <h3 class="card-title wrap-text" title="{{$tenant->name}}">{{$tenant->name}}</h3>
    </div>
    <div class="card-footer">
        <div class="stats">
            <i class="material-icons">phone</i> {{$tenant->authorized_person_phone}}
        </div>
    </div>
</div>
@endif
