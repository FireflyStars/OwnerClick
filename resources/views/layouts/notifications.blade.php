<li class="nav-item dropdown" id="notificationDropdown" data-href="{{route('push.notifications')}}" data-target="#navbarDropdownMenuLinkSection .notification-data">
    <a class="nav-link" href="{{route('push.notifications')}}" id="navbarDropdownMenuLink" data-toggle="dropdown"
       aria-haspopup="true"  aria-expanded="false">
        <i class="material-icons">notifications</i>
        <span class="notification" style="{{(count(auth()->user()->unreadNotifications)==0)?'display:none':''}}">{{count(auth()->user()->unreadNotifications)}}</span>
        <p class="d-lg-none d-md-block">
            {{ __('Some Actions') }}
        </p>
    </a>
    <div id="navbarDropdownMenuLinkSection" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
{{--        @foreach(auth()->user()->unreadNotifications as $notification)--}}
{{--            <?php $prep = new \App\Models\Notification($notification); ?>--}}
{{--            @if($prep->message)--}}
{{--                <div class="dropdown-item d-block cursor-pointer d-flex p-3 border-bottom" href="#">--}}
{{--                    <div class="justify-content-between pr-2"><div class="{{$prep->color}} m-auto notification-circle-mini text-white"><span class="material-icons">{{$prep->icon}}</span></div></div>--}}
{{--                    <div class=" w-100">--}}
{{--                        <div class="d-inline-flex justify-content-between align-items-end  w-100">--}}
{{--                            <div class="font-weight-bold">{{$prep->title}}</div>--}}
{{--                            <div class="text-gray font-small pl-3">{{$notification->created_at}}</div>--}}
{{--                        </div>--}}
{{--                        <div class="text-gray">{!! $prep->message !!}</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}
        <div class="notification-data">

        </div>
        <div id="no-notification-section" class="text-center d-none"><i class="fa fa-bell-slash fa-2x p-3 mt-3"></i><h5 class="mb-3">{{__('dashboard.no_notification')}}</h5></div>
        <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>
</li>
