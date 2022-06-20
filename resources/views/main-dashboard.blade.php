@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-9">
                    <div class="row  flex-nowrap overflow-auto noSwipe chartRow">
                        <div class="col-lg-4  col-12 col-md-12">
                            <div id="summaryInfo" class="card card-info mt-0 summaryInfo datasource"
                                 data-source="{{route('home.summary-info',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d')])}}">
                                {{--                            @include('cards.card-summary-info')--}}
                            </div>
                            {{--                        @include('cards.card-monthlyPayment-chart')--}}
                        </div>
                        <div class=" col-lg-8 col-12 col-md-12 ">
                            @include('cards.card-yearlyPayment-chart')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 datasource" id="nearExpires"
                             data-source="{{route('home.near-expires')}}">
                        </div>
                        <div class="col-lg-8 col-md-12" >
                            @include('cards.card-lastPayments-expiryPayments-notes-tab')
                        </div>
                    </div>


                </div>
                <div class="col-lg-3">
                    {{--                        <div class="col-lg-3 col-12 col-md-12 datasource" id="donutCharts" data-source="{{route('home.payment-donut-chart')}}">--}}
                    {{--                        </div>--}}
                    <div class="datasource" id="events-info"
                         data-source="{{route('home.events-info')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function modalInit() {
            window.dashboard.initialize({{$unit_id}})
        }

        if (document.readyState === 'complete') {
            modalInit();
        }
    </script>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            window.dashboard.initialize({{$unit_id}})
        })
    </script>
@endpush
