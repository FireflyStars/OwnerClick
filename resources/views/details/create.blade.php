<div class="modal-content">
    <form id="createDetail" method="POST" action="{{ route($formAction,$detail) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_detail')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_detail')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.detail')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('detail',$detail,$errors)  !!}
                    @if($formMethod == 'post')
                        <input type="hidden" name="type_id" value="{{\App\Models\Detail::DETAIL_TYPE_PROPERTY}}">
                        <input type="hidden" name="unit_id"
                               value="{{\Illuminate\Support\Facades\Request::input('unit_id')}}">
                    @else
                        <input type="hidden" name="type_id" value="{{$detail->type_id}}">
                        <input type="hidden" name="unit_id" value="{{$detail->unit_id}}">
                    @endif
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.value')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('value',$detail,$errors)  !!}
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
        setFormValidation('#createDetail');
    })
</script>

