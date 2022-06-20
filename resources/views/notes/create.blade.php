<div class="modal-content">
    <form id="createNote" method="POST" action="{{ route($formAction,$note) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
            <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_note')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_note')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.title')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('title',$note,$errors)  !!}
                    @if($formMethod == 'post')
                        <input type="hidden" name="unit_id"
                               value="{{\Illuminate\Support\Facades\Request::input('unit_id')}}">
                    @else
                        <input type="hidden" name="unit_id" value="{{$note->unit_id}}">
                    @endif
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.note')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::textArea('note',$note,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.file')}}</label>
                <div class="col-sm-9">
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($note->id)?0:1}}" data-note_id="{{$note->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_NOTES}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
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
        setFormValidation('#createNote');
    })
</script>
