<div class="card">
    <div class="card-header card-header-info card-header-icon">
    <div class="card-icon">
        <i class="material-icons">file_copy</i>
    </div>
{{--    <h4 class="card-title">{{__('dashboard.files')}}</h4>--}}
</div>
<div class="card-body ">
    <h4>{{__('dashboard.folders')}}</h4>
    <div class="row file-folders-button-area">
        <div class="col-sm-2 border px-xl-1 px-xxl-3 py-2 m-1 rounded-3 cursor-pointer file-folders-button {{(request()->get('type_id')=='last10')?'active':''}}" data-type_id="last10" ><div class="float-left  px-2"><i class="fa fa-folder" aria-hidden="true"></i></div><div class="float-left px-1 pl-xl-1 pl-xxl-3">{{__('dashboard.last_10')}}</div></div>

    @foreach($folders as $folder)
{{--        {{$folder->getType(false,true)}}--}}
    <div class="col-sm-2 border px-xl-1 px-xxl-3  py-2 m-1 rounded-3 cursor-pointer file-folders-button {{(request()->get('type_id')==$folder['id'])?'active':''}}" data-type_id="{{$folder['id']}}" ><div class="float-left  px-2"><i class="fa fa-folder" aria-hidden="true"></i></div><div class="float-left  px-1 pl-xl-1 pl-xxl-3">{{$folder['names']}}</div></div>
    @endforeach
    </div>
    <h4>{{__('dashboard.files')}}</h4>
    <div class="tab-pane" id="files">
                <div class="file-loading">
                    <input id="input-pd" name="input-pd[]" type="file" multiple  data-unit_id="{{$unit_id}}"  data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                </div>
    </div>
</div>
</div>
