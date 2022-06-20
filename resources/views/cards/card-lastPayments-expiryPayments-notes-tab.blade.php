<div id="lastPayments-expiryPayments-notes-tab" class="card @if(!isset($unit)) fullHeaderForMobile @endif">
    <div class="card-header px-2 card-header-tabs card-header-info">
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                        <a class="nav-link px-2 active" href="#overdue_payments" data-toggle="ajax" data-push-history="false" data-target="#active-notes" data-href="{{route('home.overdue-payments',$unit_id)}}">
                            {{__('dashboard.delayed_payments')}}

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-2 " href="#last_payments" data-toggle="ajax" data-push-history="false" data-target="#active-notes"  data-href="{{route('home.last-payments',$unit_id)}}">
                            {{__('dashboard.last_payments')}}

                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-2" href="#notes" data-toggle="ajax" data-push-history="false" data-target="#active-notes"  data-href="{{route('home.last-notes',$unit_id)}}">
                            {{__('dashboard.nots')}}

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
                        <div class="tab-pane active" id="active-notes" >

                        </div>
{{--            <div class="tab-pane active datasource" id="overdue_payments" data-source="{{route('home.overdue-payments',$unit_id)}}">--}}

{{--            </div>--}}
{{--            <div class="tab-pane  datasource" id="last_payments" data-source="{{route('home.last-payments',$unit_id)}}">--}}

{{--            </div>--}}

{{--            <div class="tab-pane datasource" id="notes" data-source="{{route('home.last-notes',$unit_id)}}">--}}

{{--            </div>--}}
        </div>
    </div>
</div>

<script>
    function modalInitTabs() {
        $('#lastPayments-expiryPayments-notes-tab .nav-link.active').trigger('click')
    }

    if (document.readyState === 'complete') {
        modalInitTabs();
    }


</script>
@push('js')
    <script>
        $(document).ready(function () {
            modalInitTabs();
        })
    </script>
@endpush
