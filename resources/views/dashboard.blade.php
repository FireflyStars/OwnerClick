@if(!$unit_id)
    @mobile
    @include('main-dashboard-mobile')
@else
    @include('main-dashboard')
    @endmobile
    @else
        @mobile
        @include('unit-dashboard-mobile')
        @else
            @include('unit-dashboard')
            @endmobile
        @endif
