<div class="modal-content">
    <form id="renewContract" method="POST" action="{{ route($formAction,$contract) }}" autocomplete="off"
          novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.renewal_contract')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body ">

                <div class="row">
                    <div class="col-sm-4">
                        <h6>{{__('dashboard.contract_extension')}}</h6>
                        <span>{{__('dashboard.contract_extension_description')}}</span>
                    </div>
                    <div class="col-sm-8">
                        <div id="unit-data" class="row">
                            <div class="col-sm-12">
                                {{__('dashboard.contract_extension_description2',['baslangictarihi'=>$contract->start_date,'bitistarihi'=>$contract->end_date])}}
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="col-form-label">{{__('dashboard.new')}} {{__('dashboard.end_date')}}</label>
                                {!! \App\Models\Form::inputDate('end_date',$newContract,$errors) !!}
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="col-form-label">{{__('dashboard.new_payment_period')}}</label>
                                {!! \App\Models\Form::select('payment_period',\App\Models\Contract::getPaymentPeriods(),$contract,$errors)  !!}
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="col-form-label">{{__('dashboard.rent_renew_radio')}}</label>
                                {!! \App\Models\Form::inputNumber('rental_price_radio',$contract,$errors) !!}
                            </div>
                            <div class="col-12 col-sm-6" data-old-price="{{$contract->rental_price}}">
                                <label class="col-form-label">{{__('dashboard.new_rent_fee')}} ({{__('dashboard.old')}} : {{\NumberFormatter::create(\auth()->user()->language,\NumberFormatter::CURRENCY)->formatCurrency($contract->rental_price,$contract->rental_currency)}})</label>
                                {!! \App\Models\Form::inputNumber('rental_price',$contract,$errors) !!}
                            </div>

                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}</button>
        </div>
    </form>
</div>


<script>

    $(document).ready(function () {
        $('.datetimepicker').datetimepicker({
            viewMode: 'years',
            format: '{{\App\Models\DateTime::getJavascriptDateFormats()[auth()->user()->date_format]}}',
            icons: {
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        $('[name="rental_price_radio"]').off().on('keyup keypress blur change',function (){
            $('[name="rental_price"]').val(($('[name="rental_price"]').parent().parent().attr('data-old-price')* (1 + $(this).val() / 100)).toFixed(2))
            console.log('calisti oran')

        })
        $('[name="rental_price"]').off().on('keyup keypress blur change',function (){
            $('[name="rental_price_radio"]').val((($(this).val()-$('[name="rental_price"]').parent().parent().attr('data-old-price')) / $('[name="rental_price"]').parent().parent().attr('data-old-price')).toFixed(2)*100)
            console.log('calisti kira')

        })
        $('[name="rental_price_radio"]').trigger('change')
    })
</script>
