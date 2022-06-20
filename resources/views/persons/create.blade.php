<div class="modal-content">
    <form id="createProperty" method="POST" action="{{ route($formAction,$person) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_person')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_person')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.type')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::select('type_id',\App\Models\Person::getTypes(),$person,$errors,false,true) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.name')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('name',$person,$errors,true)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.address')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::textArea('address',$person,$errors,false) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.identification_number')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('identification_number',$person,$errors,false) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.authorized_person')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('authorized_person',$person,$errors,false) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.authorized_phone')}}</label>
                <div class="col-sm-9">
                    {!! \App\Models\Form::input('authorized_person_phone',$person,$errors,true)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3 col-form-label">{{__('dashboard.file')}}</label>
                <div class="col-sm-9">
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($person->id)?0:1}}" data-person_id="{{$person->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_PERSON}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="submit" class="btn btn-info">{{__('dashboard.save')}}</button>
        </div>
    </form>
</div>


<script type="text/javascript">
    function modalInit() {
        $(document).on('changed.bs.select','#type_id', function () {
            if ($(this).val() === "{{App\Models\Person::PERSONS_TYPE_NATURAL_PERSON}}") {
                $(document).find('[name="authorized_person"]').parent().parent().parent().hide()
                $(document).find('[name="authorized_person"]').prop('required', false)
                $(document).find('[name="identification_number"]').closest('.row').find('label').text('{{__('dashboard.identification_number')}}')
            } else {
                $(document).find('[name="authorized_person"]').parent().parent().parent().show()
                $(document).find('[name="authorized_person"]').prop('required', true)
                $(document).find('[name="identification_number"]').closest('.row').find('label').text('Vergi Numarası')
            }
        })
          setFormValidation('#createProperty');
          $('#type_id').trigger('changed.bs.select')

    }
    modalInit();
</script>
