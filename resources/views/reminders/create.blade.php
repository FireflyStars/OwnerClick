<div class="modal-content">
    <form id="reminderForm" method="POST" action="{{ route($formAction,$reminder) }}" autocomplete="off"
          novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_reminder')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_reminder')}}</h4>
            @endif
            <div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @if($formMethod != 'post')
                    <button type="button" class="close btn-delete-confirm "
                            href="{{route('reminders.destroy', $reminder) }}"
                            data-href="{{route('reminders.destroy', $reminder) }}"
                            data-redirect-run-command="window.calendarItem.refetchEvents()"
                            data-modal-id="#calendarEvent"
                            data-text="{{\Carbon\Carbon::createFromFormat(\Carbon\Carbon::DEFAULT_TO_STRING_FORMAT,$reminder->send_at)->format(auth()->user()->date_format)}} tarihli {{$reminder->title}} ">
                        <i class="material-icons">delete</i>
                    </button>
                @endif
            </div>
        </div>
        <div class="modal-body ">
            <div class="row">
                <div class="col-sm-4">
                    <h6>{{__('dashboard.reminder')}}</h6>
                    <span>Kendinize ve ekibinize hatırlatıcı ekleyebilirsiniz.</span>
                </div>
                <div class="col-sm-8">
                    @if($formMethod == 'post')
                        <input type="hidden" name="unit_id" value="{{\Illuminate\Support\Facades\Request::input('unit_id')}}">
                    @else
                        <input type="hidden" name="unit_id" value="{{$reminder->unit_id}}">
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <label class=" col-form-label">{{__('dashboard.title')}}</label>
                            {!! \App\Models\Form::input('title',$reminder,$errors)  !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class=" col-form-label">{{__('dashboard.comment')}}</label>
                            {!! \App\Models\Form::textArea('note',$reminder,$errors)  !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label class=" col-form-label">{{__('dashboard.reminder_date')}}</label>
                            {!! \App\Models\Form::inputDate('reminder_date',$reminder,$errors)  !!}
                        </div>
                        <div class="col-sm-6">
                            <label class=" col-form-label">{{__('dashboard.reminder_time')}}</label>
                            {!! \App\Models\Form::inputTime('reminder_time',$reminder,$errors)  !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button id="" type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}</button>
        </div>
    </form>
</div>


<script>
    function modalInit() {
        $(document).ready(function () {
            setFormValidation('#reminderForm');
            $('.datetimepicker').datetimepicker({
                format: moment.localeData()._longDateFormat.L,
                useCurrent: true,
                icons: {
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
            $('.timepicker').datetimepicker({
                format: moment.localeData()._longDateFormat.LT,
                icons: {
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        })
        $('.datetimepicker').trigger('dp.change')
        $('.timepicker').trigger('dp.change')


    }


    modalInit()
</script>
