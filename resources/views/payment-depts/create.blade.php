<div class="modal-content">
    <form id="createPayment" method="POST" action="{{ route($formAction,$paymentDept) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                    <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_credit')}}</h4>
            @else
                    <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_credit_dept')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="col-form-label">{{__('dashboard.contract')}}</label>
                        {!! \App\Models\Form::select('contract_id',$contracts,$paymentDept,$errors)  !!}
                    </div>
                </div>
            <div class="row">
                    <div class="col-sm-4">
                        <label class="col-form-label">{{__('dashboard.payment_type')}}</label>
                        {!! \App\Models\Form::select('payment_type_id',\App\Models\Payment::getPaymentTypes(),$paymentDept,$errors)  !!}
                    </div>
                <div class="col-sm-4">
                    <label class="col-form-label">{{__('dashboard.payment_method')}}</label>
                    {!! \App\Models\Form::select('payment_method_id',\App\Models\Payment::getPaymentMethod(),$paymentDept,$errors)  !!}
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label">{{__('dashboard.payment_account')}}</label>
                    {!! \App\Models\Form::select('payment_account_id',App\Models\PaymentAccount::query()->where('creator_id',\Illuminate\Support\Facades\Auth::user()->id)->get(['id','account_name as name'])->toArray(),$paymentDept,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label class="col-form-label">{{__('dashboard.amount')}}</label>
                    {!! \App\Models\Form::inputNumber('amount',$paymentDept,$errors)  !!}
                </div>
                    <div class="col-sm-4">
                        <label class="col-form-label">{{__('dashboard.money_currency')}}</label>
                        {!! \App\Models\Form::select('currency',\App\Models\Country::currencies() ,$paymentDept,$errors) !!}
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label">{{__('dashboard.due_date')}}</label>
                        {!! \App\Models\Form::inputDate('due_date',$paymentDept,$errors)  !!}
                    </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label class="col-form-label">{{__('dashboard.comment')}}</label>
                    {!! \App\Models\Form::textArea('comment',$paymentDept,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label class="col-form-label">{{__('dashboard.file')}}</label>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple
                               data-create="{{($paymentDept->id == null)?true:false}}"
                               data-payment_id="{{((app('request')->input('ref_payment_id') == null  AND $paymentDept->ref_payment_id == null) OR ($paymentDept->id != null AND $paymentDept->ref_payment_id != null) )?$paymentDept->id:$paymentDept->ref_payment_id}}"
                               data-type_id="{{\App\Models\File::FILE_TYPE_PAYMENT_DEPT}}"
                               data-list="{{route('files.list')}}"
                               data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>

                </div>
            </div>

        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="submit" class="btn btn-info">{{__('dashboard.save')}}</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        setFormValidation('#createPayment');
        // $('#type_id').trigger('changed.bs.select')


        // $('[name="payment_day"]').val((new Date).getDate()).trigger('change')


        $(document).on('changed.bs.select', '#payment_method_id', function () {
            if ($(this).val() !== "{{\App\Models\Payment::PAYMENT_METHOD_BANK_TRANSFER}}") {
                $(document).find('[name="payment_account_id"]').parent().parent().parent().hide()
                $(document).find('[name="payment_account_id"]').prop('required', false)
                $(document).find('[name="payment_account_id"]').val(null)

            } else {
                $(document).find('[name="payment_account_id"]').parent().parent().parent().show()
                $(document).find('[name="payment_account_id"]').prop('required', true)
            }
        })
        $('#payment_method_id').trigger('change')

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
    })
</script>
