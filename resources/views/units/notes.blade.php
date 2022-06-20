<div class="card">
    <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
            <i class="material-icons">note</i>
        </div>
        <h4 class="card-title">{{__('dashboard.nots')}}</h4>
    </div>
    <div class="card-body card-menu">
        <div class="tab-pane" id="notes">
            @if($notes)
                <div class="text-right">
                    <a href="{{ route('notes.create') }}" data-toggle="modal" data-backdrop="static"
                       data-target="#ajaxModal" data-redirect="true"
                       data-href="{{ route('notes.create') }}?unit_id={{$unit_id}}"
                       data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/notes"
                       class="btn  btn-info mobile-fixed-circle-button"> <i
                            class="material-icons">add</i>
                        <span class="d-none d-sm-inline-block">{{__('dashboard.new_note')}}</span></a>
                </div>
            @endif
            @include('tables.notes',['dashboard'=>false])
        </div>
    </div>
</div>
