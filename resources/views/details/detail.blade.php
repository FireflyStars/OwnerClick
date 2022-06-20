<td class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.showing_detail')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body ">
        <table class="table">
            <tr>
                <td><b>{{__('dashboard.detail')}} ID</b></td>
                <td>#{{$detail->id}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.creator')}}</b></td>
                <td>{{$detail->creator->name}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.detail')}}</b></td>
                <td>{{$detail->detail}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.value')}}</b></td>
                <td>{{$detail->value}}</td>
            </tr>
            <tr>
                <td><b>{{__('dashboard.created_date')}}</b></td>
                <td>{{$detail->created_at}}</td>
            <tr>
                <td><b>{{__('dashboard.updated_date')}}</b></td>
                <td>{{$detail->updated_at}}</td>
            </tr>
        </table>

    </div>
    <div class="modal-footer py-0 py-sm-2">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-info">{{__('dashboard.close')}}</button>
    </div>

