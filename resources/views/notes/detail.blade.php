<td class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.showing_note')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body ">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.note')}} ID</b></td>
                <td>#{{$note->id}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$note->creator->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.property')}}</b></td>
                <td>{{$note->unit->property->name}} / {{$note->unit->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.title')}}</b></td>
                <td>{{$note->title}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.note')}}</b></td>
                <td>{{$note->note}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$note->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$note->updated_at}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.file')}}</b></td>
                <td>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($note->id)?0:1}}" data-onlyread="0" data-note_id="{{$note->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_NOTES}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>

                </td>
            </tr>
        </table>

    </div>
    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
    </div>

