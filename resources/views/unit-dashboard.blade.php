@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    @if(isset($unit))
        @if($unit->contract !== null AND $unit->contract->isExpired())
<script>
    Swal.fire({
        title: "{{__('dashboard.contract_expired')}}",
        text: "{{__('dashboard.contract_expired_message')}}",
        toast: true,
        timer: 4000,
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
    @endif
    <div class="">
        <div class="">
            <div class="row flex-nowrap overflow-auto noSwipe">

                @if($unit->contract !== null)
                @else
                    <div class="col-md-12">
                        <div class="alert alert-info alert-with-icon" data-notify="container">
                            <i class="material-icons" data-notify="icon">assignment</i>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>

                            <span class="cursor-pointer" data-toggle="modal" data-backdrop="static"
                                  data-target="#contractWizardModal" data-redirect="true"
                                  data-href="/contracts/wizards/units/{{$unit_id}}"
                                  data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/assignments" data-notify="message">{!! __('dashboard.no_active_contracts_click_to_create_new_contract')!!}</span>
                        </div>
                    </div>
                @endif
            </div>
            @if($unit->contract !== null)
            <div class="row">
                @if($amountOfDept > 0)
                    <div class="col-lg-4 ">@include('cards.card-tenant-info')</div>
{{--                    <div class="col-lg-4 ">@include('cards.card-payment-info')</div>--}}
                    <div class="col-lg-4 datasource " id="amountOfDept-info" data-source="{{route('units.dashboard.amountof-dept-info',$unit)}}">
{{--                        @include('cards.card-amountOfDept-info')--}}
                    </div>
                    <div class="col-lg-4 ">@include('cards.card-expiryDay-info')</div>
                @else
                    <div class="col-lg-4 ">@include('cards.card-tenant-info')</div>
{{--                    <div class="col-lg-4 ">@include('cards.card-payment-info')</div>--}}
                    <div class="col-lg-4 datasource " id="payment-info" data-source="{{route('units.dashboard.payment-info',$unit)}}">
                        {{--                        @include('cards.card-amountOfDept-info')--}}
                    </div>
                    <div class="col-lg-4 ">@include('cards.card-expiryDay-info')</div>
                @endif

            </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="row  flex-nowrap overflow-auto noSwipe chartRow">
                        <div class=" col-lg-12 ">
                            @include('cards.card-yearlyPayment-chart',['unit'=>$unit])
                            @include('cards.card-lastPayments-expiryPayments-notes-tab',['unit'=>$unit])
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="datasource" id="events-info"
                         data-source="{{route('home.events-info',$unit_id)}}">
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
