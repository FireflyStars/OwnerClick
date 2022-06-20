@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    @if($unit->contract !== null AND $unit->contract->isExpired())
        <script>
            Swal.fire({
                title: "{{__('dashboard.contract_expired')}}",
                text: "{{__('dashboard.contract_expired_message')}}",
                toast: true,
                timer: 400000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                showCloseButton: true,
                showCancelButton: true,
                customClass: {
                    confirmButton: 'normalButton',
                    cancelButton: 'defaultButton'
                },
                confirmButtonText: '<div data-contract-id="{{$unit->contract->id}}" class="cancelContract "><i class="fa pr-1 fa-times"></i>{{__('dashboard.terminate_contract')}}</div>',
                cancelButtonText: '<div href="{{route("contract.get-renewal",$unit->contract->id)}}" data-toggle="modal" data-backdrop="static" data-target="#ajaxModal" data-redirect="true" data-href="{{route("contract.get-renewal",$unit->contract->id)}}" data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit->id}}/details" ><i class="fa pr-1 fa-sync"></i> {{__("dashboard.renew_contract")}}</div>',
                position: 'top-right'
            })
        </script>
    @endif
    {{--    @if(\hisorange\BrowserDetect\Parser::isMobile() AND isset($unit))--}}
    {{--        <div class="chartRow"--}}
    {{--             style="margin-left: -5px !important; margin-right: -5px !important;    margin-top: -15px !important;">--}}
    {{--            @include('cards.card-yearlyPayment-chart')--}}
    {{--        </div>--}}
    {{--    @endif--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row flex-nowrap overflow-auto noSwipe">

                @if($unit->contract !== null)
                @else
                    <div class="col-md-12">
                        <div class="alert alert-info alert-with-icon" data-notify="container">
                            <i class="material-icons" data-notify="icon">assignment</i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span
                                data-notify="message">{!! __('dashboard.no_active_contracts_click_to_create_new_contract')!!}</span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8">

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
                                    <div class="col-10 offset-1  col-lg-4 col-md-6 col-sm-6 datasource " id="amountOfDept-info"
                                         data-source="{{route('units.dashboard.amountof-dept-info',$unit)}}"></div>
                                @endif
                                <div class="col-10 offset-1 offset-sm-0 col-lg-4 col-md-6 col-sm-6">
                                    @include('cards.card-expiryDay-info')
                                </div>
                            @endif
                            @endmobile
                        @endif
                    </div>

                    <div class="row  flex-nowrap overflow-auto noSwipe chartRow">
                        <div class=" col-lg-8  col-12 col-md-12 ">
                            @if(isset($unit))
                                @include('cards.card-lastPayments-expiryPayments-notes-tab',['unit'=>$unit])
                            @endif
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
