<div class="modal-content">
    <form id="createPaymentAccount" method="POST" action="{{ route($formAction,$paymentAccount) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_payment_account')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_payment_account')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.record_name')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('account_name',$paymentAccount,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.owner_account')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('owner_name',$paymentAccount,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.iban')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('iban',$paymentAccount,$errors)  !!}
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
        setFormValidation('#createPaymentAccount');
    })
</script>
