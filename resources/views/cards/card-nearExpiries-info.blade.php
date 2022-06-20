<div class="card">
    <div class="card-header card-header-info">
        <h4 class="card-title">{{__('dashboard.contract_expiration')}}</h4>
        <p class="card-category">{{__('dashboard.departments_whose_contracts_are_approaching')}}</p>
    </div>
    <div class="card-body">
        @if(!$nearExpiry OR count($nearExpiry) == 0)
        <div
            class="text-center col-10 col-md-12 d-flex align-items-center justify-content-center flex-column py-3 my-3">
            <i class="fas fa-clipboard fa-6x"></i>
            <h3>{{__('dashboard.no_contract_yet')}}</h3>
            <span class="description">{{__('dashboard.no_contract_yet_description')}}</span>
        </div>
        @else
        <table class="table">
            <thead class="text-info">
            <tr>
                <th>{{__('dashboard.unit')}}</th>
                <th class="text-right">{{__('dashboard.end_date')}}</th>
            </tr>
            </thead>
            @foreach($nearExpiry as $item)
            <tr>
                <td class="cursor-pointer" href="#properties" data-toggle="ajax"
                    data-target="#ajax-content" data-redirect="true"
                    data-href="{{ route('units.show', $item->unit) }}"><div class="unit-span"> <span class="unit-icon"><i class="fa fa-{!! $item->unit->getTypeIcon() !!}"></i></span> <span class="property-name">{{$item->unit->property->name}}</span>/<span class="unit-name">{{$item->unit->name}}</span></div></td>
                <td class="text-right">
                    <?php $difDay = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::createFromFormat(auth()->user()->date_format, $item->end_date), false); ?>
                    @if($difDay < 60)
                    <span class="text-danger"> {{$difDay}} Gün</span>
                    @else
                    <span class="text-success"> {{$difDay}} Gün</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
            @endif
    </div>
    <div class="card-footer">
        <div class="stats">
            <i class="material-icons">date_range</i> Son 30 Gün
        </div>
    </div>
</div>
