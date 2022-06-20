<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.show_person')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.person')}} ID</b></td>
                <td>#{{$person->id}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.person_type')}}</b></td>
                <td>{!!  $person->getType(true)!!}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.person')}}</b></td>
                <td>{{$person->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.address')}}</b></td>
                <td>{{$person->address}}</td>
            </tr>
            <tr>
                @if($person->type_id == \App\Models\Person::PERSONS_TYPE_NATURAL_PERSON)
                    <td><b>{{__('dashboard.identification_number')}}</b></td>
                @else
                    <td><b>Vergi Numarası</b></td>
                @endif
                <td>{{$person->identification_number}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.authorized_person')}}</b></td>
                <td>{{$person->authorized_person}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.authorized_person_contact_number')}}</b></td>
                <td>{{$person->authorized_person_phone}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.person_status')}}</b></td>
                <td>{!! $person->getStatus(true) !!}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$person->creator->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$person->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$person->updated_at}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.file')}}</b></td>
                <td>
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($person->id)?0:1}}"
                               data-onlyread="0" data-person_id="{{$person->id}}"
                               data-type_id="{{\App\Models\File::FILE_TYPE_PERSON}}" data-list="{{route('files.list')}}"
                               data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>

                </td>
            </tr>
        </table>

    </div>
    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
    </div>
</div>


