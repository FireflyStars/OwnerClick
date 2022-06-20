<td class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.showing_fixture')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body ">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.note')}} ID</b></td>
                <td>#{{$fixture->id}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$fixture->creator->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.property')}}</b></td>
                <td>{{$fixture->unit->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.title')}}</b></td>
                <td>{{$fixture->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.note')}}</b></td>
                <td>{{$fixture->comment}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.how_many')}}</b></td>
                <td>{{$fixture->count}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.how_many')}}</b></td>
                <td>{!! $fixture->getStats(true) !!}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$fixture->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$fixture->updated_at}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.files')}}</b></td>
                <td>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="0" data-onlyread="1" data-fixture_id="{{$fixture->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_FIXTURE}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>
                </td>
            </tr>
        </table>
        <div class="modal-footer py-0 py-sm-2">
            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
        </div>
    </div>


