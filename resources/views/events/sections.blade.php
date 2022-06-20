@foreach($events as $event)
    <?php $eventMessage = $event->type::get($event->data); ?>
    @if($eventMessage->message)
        <div class="d-block {{$eventMessage->url?'cursor-pointer':''}}  d-flex" href="#">
            <div class="align-items-center pr-2 d-flex event-item">
                <div class="m-auto events-circle-mini {{$eventMessage->color}}">
                    <i class="fa fa-{{$eventMessage->icon}}"></i></div>
            </div>
            <div class=" w-100 my-2  py-1 ">
                @if($eventMessage->url)
                <a href="{{$eventMessage->url}}" data-href="{{$eventMessage->url}}" data-toggle="modal"
                   data-backdrop="static" data-target="#ajaxModal">
                    @endif
                    <div class="">
                        <div class="d-inline-flex justify-content-between align-items-end  w-100">
                            <div class="unit-span">{!! $eventMessage->title !!}</div>
                            <div class="text-gray font-small pl-3"
                                 title="{{\Carbon\Carbon::createFromFormat(\Carbon\Carbon::DEFAULT_TO_STRING_FORMAT,$event->created_at)->format(auth()->user()->date_format)}}">{{\Carbon\Carbon::createFromFormat(\Carbon\Carbon::DEFAULT_TO_STRING_FORMAT,$event->created_at)->diffForHumans(null,true,true)}}</div>
                        </div>
                        <div class="event-message text-gray">{!! $eventMessage->message !!}</div>
                    </div>
                    @if($eventMessage->url)
                </a>
                @endif
            </div>
        </div>
    @endif
@endforeach
