@extends('layouts.app', ['activePage' => 'calendar', 'titlePage' => __('dashboard.calendar')])

@section('content')
    <?php
    /**
     * @var \App\Models\Fixture $fixtures
     */
    ?>
    <div class="content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-0">
                        @desktop
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">today</i>
                            </div>
                            <h4 class="card-title">{{__('dashboard.calendar')}}</h4>
                        </div>
                        @enddesktop
                        <div class="card-body" style="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <a id="createEventButton" href="{{ route('reminders.create',['unit_id'=>$unit_id]) }}" data-toggle="modal"
                                           data-backdrop="static"
                                           data-target="#ajaxModal"
                                           data-href="{{ route('reminders.create',['unit_id'=>$unit_id]) }}"
                                           class="d-none"> <i
                                                class="material-icons">add</i>
                                            <span class="d-none d-sm-inline-block">{{__('dashboard.add_note')}}</span>
                                        </a>
                                    </div>
                                    @if($unit_id)
                                        <div id='calendar' data-url="{{route('calendar.events',['unit_id'=>$unit_id])}}"
                                             style="height: 80vh"></div>
                                    @else
                                        <div id='calendar' data-url="{{route('calendar.events')}}"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            reloadCalendar.call(document.getElementById('calendar'));
        })
    </script>
@endpush
