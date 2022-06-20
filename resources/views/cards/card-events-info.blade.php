<div class="card mt-0">
    @if(!\hisorange\BrowserDetect\Parser::isMobile())
        <div class="card-header">
            <h4 class="card-title">{{__('dashboard.events')}}</h4>
        </div>
    @endif
    <div id="events-section" class="card-body max-height-80vh" data-target="#events-section .event-data"
         data-href="{{route('push.events',$unitId)}}">
        @if(count($events) === 0)
            <div
                class="text-center col-12   d-flex align-items-center justify-content-center flex-column py-3 my-5">
                <i class="fas fa-history fa-6x"></i>
                <h3>{{__('dashboard.no_event')}}</h3>
                <span class="description">{{__('dashboard.no_event_description')}}</span>
            </div>
        @endif

        <div class="event-data">

        </div>
        <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                      from="0 50 50" to="360 50 50" repeatCount="indefinite"/>
                </path>
            </svg>
        </div>
    </div>
</div>
@if(\Illuminate\Support\Facades\Request::ajax())
    <script>
        $(document).ready(function (){
            window.listenerEvent()
        })
    </script>
@endif
@push('js')
    <script>
        window.listenerEvent()
    </script>
@endpush
