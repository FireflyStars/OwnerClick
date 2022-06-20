<div class="modal-content">
    <form id="createProperty" method="POST" action="{{ route($formAction,$contract) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_contract')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.contract_template')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('contract_template_id',App\Models\ContractTemplate::all(['id','name'])->toArray(),$contract,$errors) !!}
                    <a href="#contractTemplatesModal" data-toggle="modal"  data-backdrop="static" data-target="#contractTemplatesModal"
                       data-redirect="contract_template_id"
                       data-href="/contract-templates/create"><span
                            class="badge badge-pill badge-info">{{__('dashboard.new')}} Taslak</span></a>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.tenant')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('tenant_id',App\Models\Person::all(['id','name as name'])->toArray(),$contract,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.property')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('unit_id',App\Models\Property::all(['id','name'])->toArray(),$contract,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.payment_period')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('payment_period',\App\Models\Contract::getPaymentPeriods(),$contract,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.rent_fee')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::inputNumber('rental_price',$contract,$errors) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.deposit_fee')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::inputNumber('deposit_price',$contract,$errors) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.start_date')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::inputDate('start_date',$contract,$errors) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.end_date')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::inputDate('end_date',$contract,$errors) !!}
                </div>
            </div>
        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}

            </button>
        </div>

    </form>
</div>

<script>

    if (getParameterByName('unit_id') != null) {
        $('#unit_id').val(getParameterByName('unit_id')).trigger('change');
        $('#unit_id').attr('disabled', true).selectpicker('refresh')
    }
    $('#type_id').on('changed.bs.select', function () {
        console.log('girdi');
        if ($(this).val() === "{{App\Models\Person::PERSONS_TYPE_NATURAL_PERSON}}") {
            console.log('girdi1');
            $('[name="authorized_person"]').parent().parent().parent().hide()
            $('[name="authorized_person"]').prop('required', false)
        } else {
            console.log('girdi2', $(this).val());
            $('[name="authorized_person"]').parent().parent().parent().show()
            $('[name="authorized_person"]').prop('required', true)
        }
    })


    $(document).ready(function () {
        setFormValidation('#createProperty');
        $('#type_id').trigger('changed.bs.select')


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

        $('[name="start_date"]').on('dp.change', function (e) {
            let nextYear = $('[name="start_date"]').data('DateTimePicker').date().add(1,'year').format('{{\App\Models\DateTime::getJavascriptDateFormats()[auth()->user()->date_format]}}')
            $('[name="end_date"]').val(nextYear);
        })

        $('[name="start_date"]').trigger('dp.change')


    })
</script>
