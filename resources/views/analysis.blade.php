@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    @if(isset($unit))
        @if($unit->contract !== null AND $unit->contract->isExpired())
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                        <i class="material-icons" data-notify="icon">sync</i>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span data-notify="message">{!! __('dashboard.contract_expired_message',['linkstart1'=>'<a
                                data-contract-id="'.$unit->contract->id.'" class="cursor-pointer cancelContract font-weight-bold">','linkend1'=>'</a>','linkstart2'=>'<a
                                href="'.route('contract.get-renewal',$unit->contract->id).'" data-toggle="modal"
                                data-backdrop="static"
                                data-target="#ajaxModal" data-redirect="true"
                                data-href="'.route('contract.get-renewal',$unit->contract->id).'"
                                data-redirect-target="#propertyDetailContent"
                                data-redirect-href="/units/'.$unit->id.'/details"
                                class="font-weight-bold">','linkend2'=>'</a>']) !!}</span>
                    </div>
                </div>
            </div>
        @endif
    @endif
    {{--    @if(\hisorange\BrowserDetect\Parser::isMobile() AND isset($unit))--}}
    {{--        <div class="chartRow"--}}
    {{--             style="margin-left: -5px !important; margin-right: -5px !important;    margin-top: -15px !important;">--}}
    {{--            @include('cards.card-yearlyPayment-chart')--}}
    {{--        </div>--}}
    {{--    @endif--}}
    <div class="content">
        <div class="container-fluid">
            @if(isset($unit))
                <div class="row flex-nowrap overflow-auto noSwipe">

                    @if($unit->contract !== null)
                        @mobile @if(isset($unit))
                            <div class="col-10 col-lg-4 col-md-6 col-sm-6">
                                @include('cards.card-tenant-info')
                            </div>
                            <div class="col-10 offset-1  col-lg-4 col-md-6 col-sm-6">
                                @include('cards.card-payment-info')
                            </div>
                            @if($amountOfDept > 0)
                                <div class="col-10 offset-1 offset-sm-0 col-lg-4 col-md-6 col-sm-6">
                                    @include('cards.card-amountOfDept-info')
                                </div>
                            @endif
                            <div class="col-10 offset-1 offset-sm-0 col-lg-4 col-md-6 col-sm-6">
                                @include('cards.card-expiryDay-info')
                            </div>
                        @endif
                        @endmobile
                    @else
                        <div class="col-md-12">
                            <div class="alert alert-info alert-with-icon" data-notify="container">
                                <i class="material-icons" data-notify="icon">assignment</i>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span data-notify="message">{!! __('dashboard.no_active_contracts_click_to_create_new_contract')!!}</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            <div class="row  flex-nowrap overflow-auto noSwipe chartRow">

                    <div class=" @if(!isset($unit))col-lg-12 @else col-lg-12 @endif col-12 col-md-12 ">
                        @if(!isset($unit) OR (isset($unit) AND !\hisorange\BrowserDetect\Parser::isMobile()))

                            @include('cards.card-payment-chart')
                        @endif

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
