<div class="modal-content font-size-14px">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.owner_screen')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body max-height-100vh">
        @include('unit-person.owner')
    </div>
    <div class="modal-footer py-0 py-sm-2 ">
        <button type="submit" class="btn btn-info" onclick="$('#editOwner').trigger('submit')">{{__('dashboard.update')}}</button>
    </div>
    {{--        <div class="modal-footer py-0 py-sm-2">--}}
    {{--            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('dashboard.close')}}</button>--}}
    {{--        </div>--}}
</div><!-- /.modal-content -->


