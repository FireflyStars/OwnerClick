
@foreach($notifications as $notification)
    <?php $prep = new \App\Models\Notification($notification); ?>
    @if($prep->message)
        <div data-notification-id="{{$notification->id}}" data-target="{{$prep->target}}" data-href="{{$prep->url}}" class="{{(!$notification->read_at)?'unreadNotificationBorder':''}} dropdown-item d-block cursor-pointer d-flex p-3 border-bottom {{(!$notification->read_at)?'':'text-gray'}}" href="#">
            <div class="justify-content-between pr-2">
                <div class="{{(!$notification->read_at)?$prep->color .' text-white':$prep->color.' bg-gray text-black-50'}} m-auto notification-circle-mini "><span
                        class="material-icons">{{$prep->icon}}</span></div>
            </div>
            <div class=" w-100">
                <div class="d-inline-flex justify-content-between align-items-end  w-100">
                    <div class=" font-weight-bold">{{$prep->title }}</div>
                    <div class="text-gray font-small pl-3">{{\Carbon\Carbon::createFromFormat(\Carbon\Carbon::DEFAULT_TO_STRING_FORMAT,$notification->created_at)->diffForHumans()}} </div>
                </div>
                <div class=" text-wrap">{!! $prep->message !!}</div>
            </div>
        </div>
    @endif
@endforeach

