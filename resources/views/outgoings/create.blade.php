<div class="modal-content">
    <form id="createOutgoing" method="POST" action="{{ route($formAction,$outgoing) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_outgoing')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_outgoing')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            @if($formMethod == 'post')
                <input type="hidden" name="unit_id"
                       value="{{\Illuminate\Support\Facades\Request::input('unit_id')}}">
            @else
                <input type="hidden" name="unit_id" value="{{$outgoing->unit_id}}">
            @endif
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.contract')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::select('contract_id',array_merge([['id'=> '','name' => 'Hiçbiri']],$contracts),$outgoing,$errors,false,false)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.payment_type')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::select('payment_type_id',\App\Models\Outgoing::getPropertyTypes(),$outgoing,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.amount')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::inputNumber('amount',$outgoing,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.money_currency')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::select('currency',\App\Models\Country::currencies() ,$outgoing,$errors) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.outgoing_date')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::inputDate('outgoing_date',$outgoing,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.title')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('name',$outgoing,$errors,false)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.comment')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::textArea('comment',$outgoing,$errors)  !!}
                </div>
            </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label">{{__('dashboard.file')}}</label>
                    <div class="col-sm-9">
                        <div class="file-loading">
                            <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($outgoing->id)?0:1}}" data-outgoing_id="{{$outgoing->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_OUTGOING}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
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
       setFormValidation('#createOutgoing');


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
