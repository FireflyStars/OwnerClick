<form id="search-box" class=" pl-3">
    <div class="input-group no-border">
        <span class="fa fa-search form-control-feedback"></span>
            <input type="search"  value="" class="form-control" placeholder="{{__('dashboard.search')}}...">
        {{--        <button type="submit" class="btn btn-white btn-round btn-just-icon">--}}
{{--            <i class="material-icons">search</i>--}}

{{--        </button>--}}
        <div class=" pt-3 w-100 " style="display: none" id="search-box-result">
            <div class="card card-property my-2 my-sm-3">
                <div class="card-header pb-0">
                    <div class="">
                        <div class="align-top d-inline-block p-1"><i class="fa fa-search"></i>
                        </div>
                        <div class="d-inline-block">
                            <h4 class="card-title font-weight-bold">{{__('dashboard.search_results')}} </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="">
                        <table class="table table-hover dataTable" style="width:100%">
                            <tbody>
                            {{--                            <tr>--}}
                            {{--                                <td class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
                            {{--                                    data-target="#ajax-content" data-redirect="true"--}}
                            {{--                                    data-href="{{ route('units.show', $unit) }}">--}}
                            {{--                                    {{$unit->id}}--}}
                            {{--                                </td>--}}
                            {{--                                <td class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
                            {{--                                    data-target="#ajax-content" data-redirect="true"--}}
                            {{--                                    data-href="{{ route('units.show', $unit) }}">--}}
                            {{--                                    {!! $property->getType(false,true) !!}--}}
                            {{--                                </td>--}}
                            {{--                                <td class="cursor-pointer" href="#properties" data-toggle="ajax"--}}
                            {{--                                    data-target="#ajax-content" data-redirect="true"--}}
                            {{--                                    data-href="{{ route('units.show', $unit) }}">--}}
                            {{--                                    {{$property->name}} / {{$unit->name}}--}}
                            {{--                                </td>--}}
                            {{--                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

@push('js')

    <script>
        $('#search-box-result').hide();
        $('#search-box input[type=search]').on('input', function () {
            $('#search-box-result .card-body tbody').html(loading)
            clearTimeout(this.delay);
            $('#search-box-result').show();
            this.delay = setTimeout(function () {
                $.getJSON('/search?q=' + $(this).val(), function (data) {
                    $('#search-box-result tbody').html('');

                    let units = JSON.parse(data.units);
                    units.forEach(function (item) {
                        $('#search-box-result tbody').append(resultTrItem(item['id'],item['icon'], "<b>" + item['cityName'] + " / " + item['propertyName'] + " / " + "</b>" + item['unitName']+'<br/><span class="text-gray">'+item['address']+'</span>', item['href'],'ajax','#ajax-content'))
                    })

                    let persons = JSON.parse(data.persons);
                    persons.forEach(function (item) {
                        $('#search-box-result tbody').append(resultTrItem(item['id'],item['icon'],  item['name'] + '<br/><span class="text-gray">'+item['address']+'</span>', item['href'],'modal','#ajaxModal'))
                    })
                    if(units.length ===0 && persons.length ===0){
                        $('#search-box-result tbody').html("<span><b>"+data.search_key+ "</b> {{__('dashboard.expression_not_found')}}</span>");

                    }


                })
                /* call ajax request here */
            }.bind(this), 800);
        });

        $(document).on('click', function (e) {
            if ($(e.target).closest("#search-box-result").length === 0) {
                $("#search-box-result").hide();
            }
        });


        console.log('a');

        function resultTrItem(id,icon, name, routeHref,toggle,target) {
            return '<tr><td class="icon-td cursor-pointer"  data-toggle="'+toggle+'" data-target="'+target+'" data-redirect="true" data-href="'+routeHref+'"><i class="fa fa-' + icon + '"></i></td><td class="cursor-pointer"  data-toggle="'+toggle+'" data-target="'+target+'" data-redirect="true" data-href="' + routeHref + '">' + name + '</td></tr>';
        }

    </script>
@endpush()

