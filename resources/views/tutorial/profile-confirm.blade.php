<div class="modal-content card-wizard">
    <div class="modal-body p-0 m-0">
        <div class="wizard-container" id="wizardProfile">
            <div id="bar" class="progress bg-white">
                <div class="progress-bar " role="progressbar" aria-valuenow="0" aria-valuemin="0"
                     aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <div class="h-100">

                <div class="">
                    <ul class="nav nav-pills">
                        <li class="nav-item col-3">
                            <a class="nav-link" href="#welcome_confirm_profile" data-toggle="tab" role="tab">
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a class="nav-link" href="#geographic" data-toggle="tab" role="tab">
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a class="nav-link" href="#personFormTab" data-toggle="tab" role="tab">
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a class="nav-link" href="#success" data-toggle="tab" role="tab">
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane" id="welcome_confirm_profile">
                            <div class="row text-center py-5">
                                @if(\Illuminate\Support\Facades\Auth::user()->avatar != null)
                                    <div class="profile-circle m-auto"
                                         style="background: url('{{\Illuminate\Support\Facades\Auth::user()->avatar}}')"></div>
                                @else
                                    <img src="/img/logor.png" style="width: 200px" class="m-auto" width="150"/>
                                @endif
                                <h2>{{__('dashboard.welcome')}}</h2>
                                <span class="description">{{__('dashboard.welcome_description_1')}}</span>
                                <span class="description">{{__('dashboard.welcome_description_2')}}</span>
                            </div>
                        </div>
                        <div class="tab-pane" id="geographic">
                            <form id="geographicConfirm" method="POST"
                                  action="{{ route($formActionGeographic,$profile) }}" autocomplete="off" novalidate="novalidate">
                                @csrf
                                @method($formMethod)
                                <div class="row">
                                    <div class="col-md-4"><h6>{{__('dashboard.geographic_settings')}}</h6> {{__('dashboard.geographic_settings_description_1')}}
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="col-form-label">{{ __('dashboard.language') }}</label>
                                                {!! \App\Models\Form::select('language',$language, $profile,$errors) !!}
                                            </div>
                                            <div class="col-md-5">
                                                <label class="col-form-label">{{ __('dashboard.location') }}</label>
                                                {!! \App\Models\Form::selectAjax('location','/api/countries?withFlag=true', $profile,$errors) !!}
                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-form-label">{{__('dashboard.money_currency')}}</label>
                                                {!! \App\Models\Form::select('currency',$currencies ,$profile,$errors) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.timezone')}}</label>
                                                {!! \App\Models\Form::select('timezone',$timezones ,$profile,$errors) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.date_format')}}</label>
                                                {!! \App\Models\Form::select('date_format',$dateFormats ,$profile,$errors) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.time_format')}}</label>
                                                {!! \App\Models\Form::select('time_format',$timeFormats ,$profile,$errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="personFormTab">
                            <form id="personConfirm" method="POST" action="{{ route($formActionPerson,$profile) }}"
                                  autocomplete="off"
                                  novalidate="novalidate">
                                @csrf
                                @method($formMethod)
                                <div class="row">
                                    <div class="col-md-4"><h6>{{__('dashboard.profile_information')}}</h6> {{__('dashboard.profile_information_description_1')}}
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.type')}}</label>
                                                {!! \App\Models\Form::select('type_id',\App\Models\Person::getTypes(),$person,$errors,false,true) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.name')}}</label>
                                                {!! \App\Models\Form::input('name',$person,$errors,true)  !!}
                                            </div>
                                        </div>
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <label class="col-form-label">{{__('dashboard.address')}}</label>--}}
{{--                                                {!! \App\Models\Form::textArea('address',$person,$errors,true) !!}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <label class="col-form-label">{{__('dashboard.identification_number')}}</label>--}}
{{--                                                {!! \App\Models\Form::input('identification_number',$person,$errors,true) !!}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.authorized_person')}}</label>
                                                {!! \App\Models\Form::input('authorized_person',$person,$errors,true) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-form-label">{{__('dashboard.authorized_phone')}}</label>
                                                {!! \App\Models\Form::input('authorized_person_phone',$person,$errors,true)  !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="success">
                            <div class="row py-5">
                                <div class="col-md-12 text-center">
                                    <img src="/img/confeti.png">
                                    <h2>{{__('dashboard.congratulations')}}</h2>
                                    <span class="description">{{__('dashboard.congratulations_description1')}} <br/>{{__('dashboard.congratulations_description2')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="modal-footer py-0 py-sm-2">
        <div class="mr-auto">
            <button type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                   name="previous"
                    value="{{__('dashboard.back')}}">{{__('dashboard.back')}}</button>
        </div>
        <div class="ml-auto">
            <button type="button" class="btn btn-next btn-fill btn-info btn-wd" name="next"
                    value="{{__('dashboard.next')}}">{{__('dashboard.next')}}</button>
            <button type="submit" class="btn btn-complete btn-fill btn-info btn-wd" name="next"
                    value="{{__('dashboard.finish')}}">{{__('dashboard.finish')}}</button>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    var editor;
    function refreshAnimation(wizard, index) {
        $total = wizard.find('.nav li').length;
        $li_width = 100 / $total;

        total_steps = wizard.find('.nav li').length;
        move_distance = wizard.width() / total_steps;
        index_temp = index;
        vertical_level = 0;

        mobile_device = $(document).width() < 600 && $total > 3;

        if (mobile_device) {
            move_distance = wizard.width() / 2;
            index_temp = index % 2;
            $li_width = 50;
        }

        wizard.find('.nav li').css('width', $li_width + '%');

        step_width = move_distance;
        move_distance = move_distance * index_temp;

        $current = index + 1;

        if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
            move_distance -= 8;
        } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
            move_distance += 8;
        }

        if (mobile_device) {
            vertical_level = parseInt(index / 2);
            vertical_level = vertical_level * 38;
        }
    }


    $('.card-wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function (tab, navigation, index) {
            console.log('TEst');
            var valid = true;
            if (index === 2) {
                $('#geographicConfirm').submit()
                valid = $('#geographicConfirm').valid();
                console.log('DURUM',valid)
            }
            if (index === 3) {
                $('#personConfirm').submit()
                valid = $('#personConfirm').valid();
            }
            console.log('ASD',valid)
            if (!valid) {
                document.querySelector('.card-wizard form input:invalid')
                console.log('valid değil')
                return false;
            }

            return true;
        },

        onInit: function (tab, navigation, index) {
            //check number of tabs and fill the entire row
            console.log('init',tab, navigation, index);
            var $total = navigation.find('li').length;
            var wizard = navigation.closest('.card-wizard');

            $first_li = navigation.find('li:first-child a').html();
            $('#contractError .error').hide();

            refreshAnimation(wizard, index);

            //Tarayıcıdan alınan bilgilere göre timezone tarih ve saat formatları ayarlanır
            $('[name="timezone"]').val(Intl.DateTimeFormat().resolvedOptions().timeZone)
            // $('[name="time_format"]').val(Intl.DateTimeFormat().resolvedOptions().timeZone)

            // Get user locale
            var locale = window.navigator.userLanguage || window.navigator.language;
            // Set locale to moment
            moment.locale(locale);

            // Get locale data
            var localeData = moment.localeData();
            var format = localeData.longDateFormat('L');

            if (format === 'MM/DD/YYYY') {
                $('[name="date_format"]').val('m/d/Y').trigger('change')
            } else {
                $('[name="date_format"]').val('d/m/Y').trigger('change')
            }

            if (Intl.DateTimeFormat(locale, {hour: 'numeric'}).resolvedOptions().hour12 === false) {
                $('[name="time_format"]').val(1).trigger('change')
            } else {
                $('[name="time_format"]').val(2).trigger('change')
            }
        },

        onTabClick: function (tab, navigation, index) {
            return this.onNext(tab, navigation, index)
        },

        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;


            $('#wizardProfile .progress-bar').css({width: $percent + '%'});
            var wizard = navigation.closest('.card-wizard');

            if ($current === 1) {
                $(wizard).find('.btn-previous').hide();
            } else {
                $(wizard).find('.btn-previous').show();
            }

            // If it's the last tab then hide the last button and show the finish instead
            if ($current >= $total) {


                $(wizard).find('.btn-next').hide();
                $(wizard).find('.btn-complete').show();
            } else {
                $(wizard).find('.btn-next').show();
                $(wizard).find('.btn-finish').hide();
                $(wizard).find('.btn-complete').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();


            refreshAnimation(wizard, index);
        }
    });

    $(document).ready(function () {
        modalInit();
        $('.btn-complete').on('click', function () {
            $('#confirmProfileModal').modal('hide')
            document.location.reload();
        })
    })

    function modalInit() {
        $(document).on('changed.bs.select', '#type_id', function () {
            if ($(this).val() === "{{App\Models\Person::PERSONS_TYPE_NATURAL_PERSON}}") {
                $(document).find('[name="authorized_person"]').parent().parent().parent().hide()
                $(document).find('[name="authorized_person"]').prop('required', false)
            } else {
                $(document).find('[name="authorized_person"]').parent().parent().parent().show()
                $(document).find('[name="authorized_person"]').prop('required', true)
            }
        })
        setFormValidation('#personConfirm');
        setFormValidation('#geographicConfirm');
        $('#type_id').trigger('changed.bs.select')
    }
</script>
