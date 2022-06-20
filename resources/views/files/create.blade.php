<div class="modal-content">
    <form id="createfileTemplate" method="POST" action="{{ route($formAction,$file) }}"
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
                <label class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('type_id',\App\Models\File::getTypes(),$file,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.comment')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::textArea('comment',$file,$errors)  !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.piece_unit')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::input('count',$file,$errors)  !!}
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Request::input('unit_id'))
            <input type="hidden" name="unit_id" value="{{\Illuminate\Support\Facades\Request::input('unit_id')}}" />
            @else:
            <div class="row">
                <label class="col-sm-4 col-form-label">{{__('dashboard.property')}}</label>
                <div class="col-sm-8">
                    {!! \App\Models\Form::select('unit_id',App\Models\Property::all(['id','name'])->toArray(),$file,$errors)  !!}
                </div>
            </div>

            @endif
        </div>
        <div class="modal-footer py-0 py-sm-2 ">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}

            </button>
        </div>
    </form>
</div>

