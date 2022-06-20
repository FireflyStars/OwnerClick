@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')

    {{--    @if(\hisorange\BrowserDetect\Parser::isMobile() AND isset($unit))--}}
    {{--        <div class="chartRow"--}}
    {{--             style="margin-left: -5px !important; margin-right: -5px !important;    margin-top: -15px !important;">--}}
    {{--            @include('cards.card-yearlyPayment-chart')--}}
    {{--        </div>--}}
    {{--    @endif--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
            <div class="row  flex-nowrap overflow-auto noSwipe chartRow">
                    <div id="dashboard-header" class="swiper card-info summaryInfo ">
                        <div class="swiper-wrapper ">
                            <div class="swiper-slide">
                                <div id="summaryInfo" class="card  mt-0  datasource"
                                     data-source="{{route('home.summary-info',['start_date'=>\Carbon\Carbon::now()->startOfMonth()->format('Y/m/d'),'end_date'=>\Carbon\Carbon::now()->endOfMonth()->format('Y/m/d')])}}">
                                    {{--                            @include('cards.card-summary-info')--}}
                                </div>
                            </div>
                            <div class="swiper-slide">
                                @include('cards.card-yearlyPayment-chart')
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

            </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-12" id="main-lastPayments-expiryPayments-notes-tab">
                                @include('cards.card-lastPayments-expiryPayments-notes-tab')
                            </div>
{{--                            <div class="col-lg-4 col-md-6 col-sm-6 datasource" id="nearExpires"--}}
{{--                                 data-source="{{route('home.near-expires')}}">--}}
{{--                            </div>--}}
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
