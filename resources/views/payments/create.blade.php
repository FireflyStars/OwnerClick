<div class="modal-content">
    <form id="createPayment" method="POST" action="{{ route($formAction,$payment) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                    <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.payment_notification')}}</h4>
            @else
                    <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_payment_notice')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            @if(app('request')->input('status_id') == \App\Models\PaymentDept::PAYMENT_STATUS_PAID)
                <input type="hidden" name="status_id" id="status_id"
                       value="{{\App\Models\PaymentDept::PAYMENT_STATUS_PAID}}"/>
            @endif
            @if(app('request')->input('ref_payment_id') != null)
                <input type="hidden" name="ref_payment_id" id="ref_payment_id"
                       value="{{app('request')->input('ref_payment_id')}}"/>
            @endif

            <div class="row">
                <div class="col-sm-4">
                    <label class="col-form-label">{{__('dashboard.payment_method')}}</label>
                    {!! \App\Models\Form::select('payment_method_id',\App\Models\Payment::getPaymentMethod(),$payment,$errors)  !!}
                </div>
                <div class="col-sm-4">
                    <label class="col-form-label">{{__('dashboard.payment_account')}}</label>
                    {!! \App\Models\Form::select('payment_account_id',App\Models\PaymentAccount::query()->where('creator_id',\Illuminate\Support\Facades\Auth::user()->id)->get(['id','account_name as name'])->toArray(),$payment,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label class="col-form-label">{{__('dashboard.amount')}}</label>
                    {!! \App\Models\Form::inputNumber('amount',$payment,$errors)  !!}
                </div>

                    <div class="col-sm-4">
                        <label class="col-form-label">{{__('dashboard.payment_date')}}</label>
                        {!! \App\Models\Form::inputDate('payment_date',$payment,$errors)  !!}
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label class="col-form-label">{{__('dashboard.comment')}}</label>
                    {!! \App\Models\Form::textArea('comment',$payment,$errors,false)  !!}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label class="col-form-label">{{__('dashboard.file')}}</label>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple
                               data-create="{{($payment->id == null OR (app('request')->input('ref_payment_id') != null  AND $payment->ref_payment_id == null))?true:false}}"
                               data-payment_id="{{((app('request')->input('ref_payment_id') == null  AND $payment->ref_payment_id == null) OR ($payment->id != null AND $payment->ref_payment_id != null) )?$payment->id:$payment->ref_payment_id}}"
                               data-type_id="{{\App\Models\File::FILE_TYPE_PAYMENT}}"
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
                if( $(document).find('[name="payment_account_id"] option').length > 0){
                    $(document).find('[name="payment_account_id"]').val($(document).find('[name="payment_account_id"] option:first').val())
                    $(document).find('[name="payment_account_id"]').selectpicker('refresh');
                }
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
