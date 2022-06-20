@if(!$notes)
    <div
        class="text-center col-10 offset-1  col-md-6 offset-md-3 d-flex align-items-center justify-content-center flex-column py-3 my-5">
        <i class="fas fa-clipboard fa-6x"></i>
        <h3>{{__('dashboard.create_your_first_note')}}</h3>
        <span class="description">{{__('dashboard.create_your_first_note_description')}}</span>
        <div class=" m-3">
            <a href="{{ route('notes.create') }}" data-toggle="modal" data-backdrop="static"
               data-target="#ajaxModal" data-redirect="true"
               data-href="{{ route('notes.create') }}?unit_id={{$unit_id}}"
               data-redirect-target="#propertyDetailContent" data-redirect-href="/units/{{$unit_id}}/notes"
               class="btn  btn-info "> <i
                    class="material-icons">add</i>
                <span>{{__('dashboard.new_note')}}</span></a>
        </div>
    </div>
@else

    @foreach($notes as $note)
        <div class="d-flex justify-content-between align-items-center pt-2 ">
            {{--            @if(!$dashboard)--}}
            {{--                <div class="font-weight-bold">{{$note->id}}</div>--}}
            {{--            @else--}}
            <div class="d-grid flex-grow-1 pl-2 col-8 col-sm-6 ">
                <div class="cursor-pointer" href="#properties" data-toggle="ajax"
                     data-target="#ajax-content" data-redirect="true"
                     data-href="{{ route('units.show', $note->unit) }}">
                    @if(!isset($unit_id))
                        <div class="unit-span"><span
                                class="unit-icon"><i class="fa fa-{!! $note->unit->getTypeIcon() !!}"></i></span>
                            <span class="property-name">{{$note->unit->property->name}}</span>/<span
                                class="unit-name">{{$note->unit->name}}</span>

                        </div>
                    @endif
                    <div
                        class="@if(isset($unit_id)) font-weight-normal @else text-gray font-small @endif">{{$note->title}}</div>
                    @if(isset($unit_id))
                        <div class="d-block text-gray font-small text-left">
                            {{\Carbon\Carbon::parse($note->updated_at)->format(auth()->user()->date_format)}}
                        </div>
                    @endif

                </div>
            </div>
            {{--            @endif--}}

            @if(!isset($unit_id))
                <div class="d-flex justify-content-between">
                    {{--                    <div>--}}
                    {{--                        <b>{{$note->title}}</b> <span class="text-gray text-right"> <span> {{$note->unit->property->name}}/ {{$note->unit->name}}</span></span>--}}
                    {{--                    </div>--}}
                    {{--                        @if()--}}

                    <span
                        class="d-block text-gray font-small text-right">{{\Carbon\Carbon::parse($note->updated_at)->format(auth()->user()->date_format)}}</span>

                </div>
            @endif

            <div class="text-right">
                <div class="dropdown">
                    <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"
                       id="navbarContractActionMenu{{$note->id}}"
                       data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="true">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <div class="dropdown-menu"
                         aria-labelledby="navbarContractActionMenu{{$note->id}}">
                        <a rel="tooltip" class="dropdown-item"
                           href="{{ route('notes.show', $note) }}"
                           data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"
                           data-redirect="true"
                           data-href="{{ route('notes.show', $note) }}"
                           data-original-title="" title="">
                            <i class="material-icons">visibility</i>{{__('dashboard.show_note')}}
                        </a>
                        <a rel="tooltip" class="dropdown-item"
                           href="{{ route('notes.edit', $note) }}"
                           data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"
                           data-redirect="true"
                           data-href="{{ route('notes.edit', $note) }}"
                           @if($dashboard)
                           data-redirect-target="#active-notes"
                           data-redirect-href="{{route('home.last-notes',$unit_id)}}"
                           @else
                           data-redirect-target="#propertyDetailContent"
                           data-redirect-href="/units/{{$unit_id}}/notes"
                           @endif
                           data-original-title="" title="">
                            <i class="material-icons">edit</i>{{__('dashboard.edit_note')}}
                        </a>
                        <a class="dropdown-item btn-delete-confirm"
                           data-href="{{route('notes.destroy', $note) }}"
                           @if($dashboard)
                           data-redirect-target="#active-notes"
                           data-redirect-href="{{route('home.last-notes',$unit_id)}}"
                           @else
                           data-redirect-target="#propertyDetailContent"
                           data-redirect-href="/units/{{$unit_id}}/notes"
                           @endif;
                           data-redirect="true"
                           data-text="{{$note->title}}">
                            <i class="material-icons">close</i>{{__('dashboard.delete_note')}}
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <div class="border-bottom pl-2 pb-2 " style="    white-space: pre-wrap;
    word-break: break-all;">{{ \Illuminate\Support\Str::limit($note->note, 140, '') }}@if (strlen($note->note) > 140)<span class="dots">...</span><span class="more">{{ \Illuminate\Support\Str::substr($note->note, 140) }}</span><span class="text-info cursor-pointer showMoreText" id="myBtn">Read more</span>
            @endif
        </div>  @endforeach


{{--    <table class="table dataTable" style="width:100%">--}}
{{--        <thead class="text-info">--}}
{{--        <tr>--}}
{{--            @if(!$dashboard)--}}
{{--                <th>Id</th>--}}
{{--            @else--}}
{{--                <th>{{__('dashboard.unit')}}</th>--}}
{{--            @endif--}}
{{--            <th>Not</th>--}}
{{--            --}}{{--                    <th>{{__('dashboard.updated_date')}}</th>--}}
{{--            <th class="text-right">İşlem</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach($notes as $note)--}}
{{--            <tr>--}}
{{--                @if(!$dashboard)--}}
{{--                    <td class="font-weight-bold">{{$note->id}}</td>--}}
{{--                @else--}}
{{--                    <td class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
{{--                        data-target="#ajax-content" data-redirect="true"--}}
{{--                        data-href="{{ route('units.show', $note->unit) }}">--}}
{{--                        <div class="unit-span"><span--}}
{{--                                class="unit-icon">{!! $note->unit->property->getType(false,true) !!}</span> <span--}}
{{--                                class="property-name">{{$note->unit->property->name}}</span>/<span--}}
{{--                                class="unit-name">{{$note->unit->name}}</span></div>--}}
{{--                    </td>--}}
{{--                @endif--}}

{{--                <td>--}}
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        <div><b>{{$note->title}}</b> <span class="text-gray text-right"> <span> {{$note->unit->property->name}}/ {{$note->unit->name}}</span></span>--}}
{{--                        </div>--}}
{{--                        --}}{{--                        @if()--}}

{{--                        <span--}}
{{--                            class="d-block text-gray text-right">{{\Carbon\Carbon::parse($note->updated_at)->format(auth()->user()->date_format)}}</span>--}}

{{--                    </div>--}}
{{--                    {{ \Illuminate\Support\Str::limit($note->note, 60, '') }}--}}
{{--                    @if (strlen($note->note) > 60)--}}
{{--                        <span class="dots">...</span>--}}
{{--                        <span class="more">{{ substr($note->note, 60) }}</span> <span--}}
{{--                            class="text-info cursor-pointer showMoreText" id="myBtn">Read more</span>--}}
{{--                    @endif--}}
{{--                </td>--}}

{{--                <td class="text-right">--}}
{{--                    <div class="dropdown">--}}
{{--                        <a class="btn btn-just-icon btn-link btn-secondary text-dark" href="#pablo"--}}
{{--                           id="navbarContractActionMenu{{$note->id}}"--}}
{{--                           data-toggle="dropdown" aria-haspopup="true"--}}
{{--                           aria-expanded="true">--}}
{{--                            <i class="material-icons">more_vert</i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu"--}}
{{--                             aria-labelledby="navbarContractActionMenu{{$note->id}}">--}}
{{--                            <a rel="tooltip" class="dropdown-item"--}}
{{--                               href="{{ route('notes.show', $note) }}"--}}
{{--                               data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"--}}
{{--                               data-redirect="true"--}}
{{--                               data-href="{{ route('notes.show', $note) }}"--}}
{{--                               data-original-title="" title="">--}}
{{--                                <i class="material-icons">visibility</i>{{__('dashboard.showing_note')}}--}}
{{--                            </a>--}}
{{--                            <a rel="tooltip" class="dropdown-item"--}}
{{--                               href="{{ route('notes.edit', $note) }}"--}}
{{--                               data-toggle="modal" data-backdrop="static" data-target="#ajaxModal"--}}
{{--                               data-redirect="true"--}}
{{--                               data-href="{{ route('notes.edit', $note) }}"--}}
{{--                               data-redirect-target="#propertyDetailContent"--}}
{{--                               data-redirect-href="/units/{{$unit_id}}/notes"--}}
{{--                               data-original-title="" title="">--}}
{{--                                <i class="material-icons">edit</i>{{__('dashboard.editing_note')}}--}}
{{--                            </a>--}}
{{--                            <a class="dropdown-item btn-delete-confirm"--}}
{{--                               data-href="{{route('notes.destroy', $note) }}"--}}
{{--                               data-redirect-target="#propertyDetailContent"--}}
{{--                               data-redirect-href="/units/{{$unit_id}}/notes"--}}
{{--                               data-redirect="true"--}}
{{--                               data-text="{{$note->title}}">--}}
{{--                                <i class="material-icons">close</i>{{__('dashboard.delete_note')}}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
@endif
