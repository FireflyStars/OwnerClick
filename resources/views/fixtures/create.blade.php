<div class="modal-content">
    <form id="createFixtureTemplate" method="POST" action="{{ route($formAction,$fixture) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_fixture')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.fixture_name')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::input('name',$fixture,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.comment')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::textArea('comment',$fixture,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.piece_unit')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::input('count',$fixture,$errors)  !!}
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Request::input('unit_id'))
            <input type="hidden" name="unit_id" value="{{\Illuminate\Support\Facades\Request::input('unit_id')}}" />
            @else
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.property')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('unit_id',App\Models\Unit::all(['id','name'])->toArray(),$fixture,$errors)  !!}
                </div>
            </div>
            @endif
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.status')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('status_id',\App\Models\Fixture::getStatus(),$fixture,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.file')}}</label>
                <div class="col-sm-8">
                    <div class="file-loading">
                        <input id="input-pd" name="input-pd[]" type="file" multiple data-create="{{($fixture->id)?0:1}}" data-fixture_id="{{$fixture->id}}" data-type_id="{{\App\Models\File::FILE_TYPE_FIXTURE}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer py-0 py-sm-2 ">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}

            </button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        setFormValidation('#createFixtureTemplate');
    })
</script>
