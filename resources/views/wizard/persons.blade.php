<div class="modal-content card-wizard">
    <div class="modal-header">
        <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_contract')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body p-0 m-0">
        <div class="wizard-container" id="wizardProfile">
            <div id="bar" class="progress bg-white">
                <div class="progress-bar " role="progressbar" aria-valuenow="0" aria-valuemin="0"
                     aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <div class="h-100">
                <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                        <li class="nav-item col-4">
                            <a class="nav-link" href="#contract" data-toggle="tab" role="tab">
                                <i class="material-icons">book</i>
                                <span class="d-none d-md-block">{{__('dashboard.contract_type')}}</span>
                            </a>
                        </li>
                        <li class="nav-item col-4">
                            <a class="nav-link" href="#account" data-toggle="tab" role="tab">
                                <i class="material-icons">person</i>
                                <span class="d-none d-md-block">{{__('dashboard.tenant_guarantor')}}</span>
                            </a>
                        </li>
                        <li class="nav-item col-4">
                            <a class="nav-link" href="#contractDetail" data-toggle="tab" role="tab">
                                <i class="material-icons">assignment</i>
                                <span class="d-none d-md-block"> {{__('dashboard.contract')}}</span>
                            </a>
                        </li>
{{--                        <li class="nav-item col-3">--}}
{{--                            <a class="nav-link" href="#contractPreview" data-toggle="tab" role="tab">--}}
{{--                                <i class="material-icons">assignment_turned_in</i>--}}
{{--                                <span class="d-none d-md-block"> Önizleme</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <form id="createContract" method="POST" action="{{ route($formAction,$contract) }}" autocomplete="off"
                      novalidate="novalidate">
                    @csrf
                    @method($formMethod)
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane navigation-tab" id="contract">
{{--                                <div class="row">--}}


{{--                                    <label>--}}
{{--                                        <input type="radio" name="contract" hidden required value="newContract"/>--}}
                                        <input type="radio" name="contract" checked="checked"  hidden required value="uploadContract"/>
{{--                                    </label>--}}
{{--                                    <ul id="selectContractType" class="nav ">--}}
{{--                                        <li class="col-12 col-xl-6">--}}
{{--                                            <div class="nav-link disabled" data-toggle="tab" href="#newContract"--}}
{{--                                                 role="tablist">--}}
{{--                                                <div class="ribbon-wrapper-red">--}}
{{--                                                    <div class="ribbon-red">Yakında</div>--}}
{{--                                                </div>--}}
{{--                                                <div class="d-inline-block"><i class="material-icons">assignment</i>--}}
{{--                                                </div>--}}
{{--                                                <div class="nav-text-with-icon">--}}
{{--                                                    <h6>{{__('dashboard.new')}} Sözleşme Hazırla</h6>--}}
{{--                                                    <p>Eğer sözlemeniz mevcut değilse {{__('dashboard.new')}} sözleşme--}}
{{--                                                        oluşturabilirsiniz.</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="col-12 col-xl-6 pt-3 pt-sm-0">--}}
{{--                                            <div class="nav-link" data-toggle="tab" href="#uploadContract"--}}
{{--                                                 role="tablist">--}}
{{--                                                <div class="d-inline-block"><i class="material-icons">attach_file</i>--}}
{{--                                                </div>--}}
{{--                                                <div class="nav-text-with-icon">--}}
{{--                                                    <h6>Mevcut Sözleşmemi Yükle</h6>--}}
{{--                                                    <p>Sözleşmeniz mevcut ise sözleşmenizi sisteme--}}
{{--                                                        yükleyebilirsiniz.</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}

                                <div class="row tab-content tab-space tab-subcategories" >
                                    <div class="tab-pane col-12" id="newContract">
                                        <div class="row">
                                            <div class="col-sm-4"><h6>{{__('dashboard.contract_template')}}</h6>
                                                <p>{{__('dashboard.select_contract_template')}}</p></div>
                                            <div class="col-sm-8">
                                                <label class="col-form-label">{{__('dashboard.contract_template')}}</label>
                                                {!! \App\Models\Form::select('contract_template_id',App\Models\ContractTemplate::all(['id','name'])->toArray(),$contract,$errors) !!}
                                                <a href="#contractTemplatesModal" data-toggle="modal"
                                                   data-target="#contractTemplatesModal"
                                                   data-redirect="contract_template_id"
                                                   data-href="/contract-templates/create"><span
                                                        class="badge badge-pill badge-info">{{__('dashboard.new')}} Taslak</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane col-12 active" id="uploadContract">
                                        <div class="row">
                                            <div class="col-sm-4"><h6>{{__('dashboard.contract_file')}}</h6>
                                                <p>{{__('dashboard.if_you_already_have_a_contract')}}</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <label class="col-form-label">{{__('dashboard.contract_file')}}</label><br/>
{{--                                                <div class="file-loading">--}}
{{--                                                    <input type="file" name="contractTemplateFile" required>--}}
{{--                                                </div>--}}
                                                <div class="file-loading">
                                                    <input id="input-pd" name="input-pd[]" type="file" multiple data-create="true" data-unit_id="{{$contract->unit_id}}" data-type_id="{{\App\Models\File::FILE_TYPE_UNIT_CONTRACT}}" data-list="{{route('files.list')}}" data-upload="{{route('files.upload')}}" data-delete="{{route('files.delete')}}">
                                                </div>
{{--                                                <div id="kartik-file-errors"></div>--}}
{{--                                                <div class="fileinput fileinput-new text-center"--}}
{{--                                                     data-provides="fileinput">--}}
{{--                    <span class="btn btn-round btn-info btn-file">--}}
{{--                      <span class="fileinput-new">Sözleşme Ekle</span>--}}
{{--                      <span class="fileinput-exists">Değiştir</span>--}}
{{--                      <input type="file" name="contractTemplateFile" required>--}}
{{--                    </span>--}}
{{--                                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"--}}
{{--                                                       data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>--}}
{{--                                                </div>--}}
                                                <label id="contractTemplateFile-error" class="error d-block"
                                                       for="contractTemplateFile"></label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="contractError" class="row col-12 pt-3 "><label class="error"></label></div>
                            </div>
                            <div class="tab-pane navigation-tab" id="account">
                                <div class="personSelectArea">
                                    <div class="row">
                                        <div class="col-4">{!! __('dashboard.if_there_is_no_record_of_the_person_tenant_and_guarantor_search_section',['item'=>'<a
                                                href="#tasks-1"
                                                data-toggle="modal"  data-backdrop="static" data-target="#createPersonsModal"
                                                data-redirect="person_id[]"
                                                data-href="/persons/create">'.__('dashboard.persons').'</a>']) !!}

                                        </div>
                                        <div class="col-8">
                                            <div id="partners">
                                                @if(count($unitPerson) > 0)
                                                    @foreach ($unitPerson as $person)
                                                        <div id="partnerGroup" class="row tenantPerson">
                                                            <div class="col-sm-12">
                                                                <h6><span class="malik-sirasi">1</span>.{{__('dashboard.tenant')}}</h6>
                                                            </div>
                                                            <div class="col-8 col-sm-7">
                                                                <label class="col-form-label">{{__('dashboard.name')}}</label>
                                                                <a class="label-link text-info float-right"
                                                                   href="#tasks-1"
                                                                   data-toggle="modal"  data-backdrop="static" data-target="#createPersonsModal"
                                                                   data-redirect="person_id[]"
                                                                   data-href="{{ route('persons.create') }}">{{__('dashboard.new_person')}}</a>
                                                                <input type="hidden" name="id[]"
                                                                       value="{{old('id',$person->id)}}"/>
                                                                {!! \App\Models\Form::select('person_id[]',App\Models\Person::all(['id','name as name'])->toArray(),$person,$errors,false,true,'Lütfen seçiniz...')  !!}
                                                            </div>
                                                            <div class="col-3 col-sm-3">
                                                                <label class="col-form-label">{{__('dashboard.share_ratio')}}</label>
                                                                {!! \App\Models\Form::input('share[]',$person,$errors,true) !!}
                                                            </div>
                                                            <div class="col-1 col-sm-2 m-auto">
                                                                <button type="button"
                                                                        class="btn btn-just-icon btn-danger btn-sm btn-link deletePartner">
                                                                    <i
                                                                        class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div id="partnerGroup" class="row tenantPerson">
                                                        <input type="hidden" name="type_id[]"
                                                               value="{{\App\Models\ContractPersons::CONTRACT_PERSONS_TYPE_TENANT}}"/>
                                                        <div class="col-sm-12">
                                                            <h6><span class="malik-sirasi">1</span>.{{__('dashboard.tenant')}}</h6>
                                                        </div>
                                                        <div class="col-7 col-sm-7">
                                                            <label class="col-form-label">{{__('dashboard.name')}}</label>
                                                            <a class="label-link text-info float-right"
                                                               href="#tasks-1"
                                                               data-toggle="modal"  data-backdrop="static" data-target="#createPersonsModal"
                                                               data-redirect="person_id[]"
                                                               data-href="{{ route('persons.create') }}">{{__('dashboard.new_person')}}</a>
                                                            <input type="hidden" name="id[]" value=""/>
                                                            {!! \App\Models\Form::select('person_id[]',App\Models\Person::all(['id','name as name'])->toArray(),$newPerson,$errors,true,true,'Lütfen seçiniz...')  !!}
                                                        </div>
                                                        <div class="col-3 col-sm-3">
                                                            <label class="col-form-label">{{__('dashboard.share_ratio')}}</label>
                                                            {!! \App\Models\Form::input('share[]',$newPerson,$errors,true) !!}
                                                        </div>
                                                        <div class="col-1 col-sm-2 m-auto">
                                                            <button type="button"
                                                                    class="btn btn-just-icon btn-danger btn-sm btn-link deletePartner">
                                                                <i
                                                                    class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button id="addTenant" type="button"
                                                            class="btn btn-outline-info btn-sm pull-right element-clone"
                                                    >{{__('dashboard.add_partner')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="togglebutton">
                                                <label>
                                                    <input id="toggleGuarantorForm" name="toggleGuarantor"
                                                           type="checkbox">
                                                    <span class="toggle"></span>
                                                    {{__('dashboard.add_guarantor_to_the_contract')}}
                                                </label>
                                            </div>

                                            <div class="personSelectArea" id="guarantorForm" style="display: none">
                                                <div id="partners">
                                                        @if(count($unitPerson) > 0)
                                                            @foreach ($unitPerson as $person)
                                                                <div id="partnerGroup" class="row guarantorPerson">
                                                                    <div class="col-sm-12">
                                                                        <h6><span class="malik-sirasi">1</span>.{{__('dashboard.guarantor')}}</h6>
                                                                    </div>
                                                                    <div class="col-11 col-sm-10">
                                                                        <label class="col-form-label">{{__('dashboard.name')}}</label>
                                                                        <input type="hidden" name="type_id[]"
                                                                               value="{{\App\Models\ContractPersons::CONTRACT_PERSONS_TYPE_GUARANTOR}}"/>
                                                                        <input type="hidden" name="id[]" value="{{old('id',$person->id)}}"/>
                                                                        {!! \App\Models\Form::select('person_id[]',App\Models\Person::all(['id','name as name'])->toArray(),$person,$errors,false,true,'Lütfen seçiniz...')  !!}
                                                                    </div>
                                                                    <div class="col-1 col-sm-2 m-auto">
                                                                        <button type="button"
                                                                                class="btn btn-just-icon btn-danger btn-sm btn-link deleteGuarantor"><i
                                                                                class="fa fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div id="partnerGroup" class="row guarantorPerson">
                                                                <div class="col-sm-12">
                                                                    <h6><span class="malik-sirasi">1</span>.{{__('dashboard.guarantor')}}</h6>
                                                                </div>
                                                                <div class="col-11 col-sm-10">
                                                                    <label class="col-form-label">{{__('dashboard.name')}}</label>
                                                                    <input type="hidden" name="type_id[]"
                                                                           value="{{\App\Models\ContractPersons::CONTRACT_PERSONS_TYPE_GUARANTOR}}"/>
                                                                    {!! \App\Models\Form::select('person_id[]',App\Models\Person::all(['id','name as name'])->toArray(),$newPerson,$errors,true,true,'Lütfen kefil seçiniz...')  !!}
                                                                </div>
                                                                <div class="col-1 col-sm-2 m-auto">
                                                                    <button type="button"
                                                                            class="btn btn-just-icon btn-danger btn-sm btn-link deleteGuarantor"><i
                                                                            class="fa fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button id="addGuarantor" type="button"
                                                                class="btn btn-outline-info btn-sm pull-right element-clone"
                                                        >{{__('dashboard.add_guarantor')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane navigation-tab" id="contractDetail">
                                @if($unit_id == null):
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">{{__('dashboard.property')}}{{$unit_id}}</label>
                                    <div
                                        class="col-sm-8">                   {!! \App\Models\Form::select('unit_id',App\Models\Property::all(['id','name'])->toArray(),$contract,$errors)  !!}
                                    </div>
                                </div>
                                @else
                                    <input type="hidden" name="unit_id"
                                           value="{{old('unit_id',$unit_id)}}"/>
                                @endif


                                    <div class="row">
                                    <div class="col-sm-4">
                                        <h6>{{__('dashboard.payment')}}</h6>
                                        <span>{{__('dashboard.enter_details_about_payment')}}</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <label class="col-form-label">{{__('dashboard.payment_method')}}</label>
                                                {!! \App\Models\Form::select('payment_method_id',\App\Models\Payment::getPaymentMethod(),$contract,$errors)  !!}
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="col-form-label">{{__('dashboard.payment_account')}}</label>
                                                <a class="label-link text-info float-right"
                                                    href="#tasks-1"
                                                    data-toggle="modal"  data-backdrop="static" data-target="#createBankAccountModal"
                                                    data-redirect="payment_account_id"
                                                    data-href="{{ route('payment-accounts.create') }}">{{__('dashboard.new')}} Hesap</a>
                                                {!! \App\Models\Form::select('payment_account_id',\App\Models\PaymentAccount::all(['id','account_name as name'])->toArray(),$contract,$errors)  !!}
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="col-form-label">{{__('dashboard.payment_period')}}</label>
                                                {!! \App\Models\Form::select('payment_period',\App\Models\Contract::getPaymentPeriods(),$contract,$errors)  !!}
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">{{__('dashboard.start_date')}}</label>
                                                {!! \App\Models\Form::inputDate('start_date',$contract,$errors) !!}
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">{{__('dashboard.end_date')}}</label>
                                                {!! \App\Models\Form::inputDate('end_date',$contract,$errors) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label class="col-form-label"><span id="payment_period_name">test</span> {{__('dashboard.rent_fee')}}</label>
                                                {!! \App\Models\Form::inputNumber('rental_price',$contract,$errors) !!}
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">{{__('dashboard.rental_money_currency')}}</label>
                                                {!! \App\Models\Form::select('rental_currency',\App\Models\Country::currencies() ,$contract,$errors) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label class="col-form-label">{{__('dashboard.deposit_fee')}}</label>
                                                {!! \App\Models\Form::inputNumber('deposit_price',$contract,$errors) !!}
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">{{__('dashboard.deposit_money_currency')}}</label>
                                                {!! \App\Models\Form::select('deposit_currency',\App\Models\Country::currencies() ,$contract,$errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="tab-pane" id="contractPreview">--}}
{{--                                <div class="row"></div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <div class="modal-footer py-0 py-sm-2">
        <div class="mr-auto">
            <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled"
                   name="previous"
                   value="{{__('dashboard.back')}}">
        </div>
        <div class="ml-auto">
            <input type="button" class="btn btn-next btn-fill btn-info btn-wd" name="next"
                   value="{{__('dashboard.next')}}">
            <input type="submit" class="btn btn-complete btn-fill btn-info btn-wd" name="next"
                   value="{{__('dashboard.save_agreement')}}">
            <input type="button" class="btn btn-finish btn-fill btn-info btn-wd" name="finish"
                   value="{{__('dashboard.finish')}}"
                   style="display: none;">
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
            var valid = $('.card-wizard form').valid();
            if (!valid) {
                document.querySelector('.card-wizard form input:invalid')
                return false;
            }

            if ($('[name="contract"]:checked').length == 0) {
                $('#contractError label').text('{{__('dashboard.select_contract_type')}}');
                $('#contractError .error').show();
                return false;
            } else {
                $('#contractError .error').hide();

            }
            return true;
        },

        onInit: function (tab, navigation, index) {
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            var wizard = navigation.closest('.card-wizard');

            $first_li = navigation.find('li:first-child a').html();
            $('#contractError .error').hide();

            refreshAnimation(wizard, index);
            $(".card-wizard [type='file']").fileinput({ 'theme': 'fas',language: 'tr',showCaption: false, showUpload: false,dropZoneEnabled: false});

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

                //Bu kısım apiden sözleşme taslağını html olarak getirir.
                if ($('[name="contract"]:checked').val() == 'newContract') {
                    $.ajax({
                        type: "GET",
                        url: "/api/templates/" + $('#contract_template_id').val(),
                        dataType: "json",
                        success: function (data) {

                            res = data[0].template;
                            $('#contractPreview .row').html(res)
                            //Bu kısım contract-template alanını javasciprt ile render eder
                            var contractTemplate = $('#contractPreview .row').html()
                            contractTemplate = contractTemplate.replace("\{\{dairesi\}\}", "W3Schools");
                            @foreach(\App\Models\ContractVariable::getVariables() as $variable)
                                contractTemplate = contractTemplate.replace("\{\{ {{$variable["title"]}} \}\}", "W3Schools");

                            @endforeach

                            $('#contractPreview .row').html(contractTemplate)

                            if (typeof editor == "undefined") {
                                editor = ClassicEditor
                                editor.create(document.querySelector('#contractPreview .row'))
                            }
                        },
                    });
                }

                $(wizard).find('.btn-next').hide();
                $(wizard).find('.btn-complete').show();
            } else if ($current === 3) {

                $(wizard).find('.btn-complete').show();

                $(wizard).find('.btn-next').hide();
                $(wizard).find('.btn-finish').hide();
            } else {
                $(wizard).find('.btn-next').show();
                $(wizard).find('.btn-finish').hide();
                $(wizard).find('.btn-complete').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();


            var checkbox = $('.footer-checkbox');

            if (!index == 0) {
                $(checkbox).css({
                    'opacity': '0',
                    'visibility': 'hidden',
                    'position': 'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity': '1',
                    'visibility': 'visible'
                });
            }

            refreshAnimation(wizard, index);
        }
    });


    $(document).ready(function () {
        setFormValidation('#createContract');
        $('#type_id').trigger('changed.bs.select')

        $('.tenantPerson [name="share[]"]').val(1);


        $('.datetimepicker').datetimepicker({
            viewMode: 'years',
            format: '{{\App\Models\DateTime::getJavascriptDateFormats()[auth()->user()->date_format]}}',
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

        $('[name="start_date"]').on('dp.change', function (e) {
            let nextYear = $('[name="start_date"]').data('DateTimePicker').date().add(1, 'year').format('{{\App\Models\DateTime::getJavascriptDateFormats()[auth()->user()->date_format]}}')
            $('[name="end_date"]').val(nextYear);
        })

        $('[name="start_date"]').trigger('dp.change')


        $('.togglebutton :checkbox').off('change').on('change', function () {
            if ($(this).prop('checked')) {
                $('#guarantorForm').show()
                $('#guarantorForm input,#guarantorForm select').prop('disabled', false)
            } else {
                $('#guarantorForm').hide()
                $('#guarantorForm input,#guarantorForm select').prop('disabled', true)
            }
        })
        //KİRACI İÇİN KOMUTLAR
        function renderUnitNumber() {
            let unitNumber = 1;
            $('.tenantPerson .malik-sirasi').each(function () {
                $(this).text(unitNumber++)
            })

            if ($('.tenantPerson button.deletePartner').length < 2) {
                $('.tenantPerson button.deletePartner').hide();
            } else {
                $('.tenantPerson button.deletePartner').show();
            }
        }

        renderUnitNumber();

        var tenantPerson = $(document).find('.tenantPerson:last').clone();
        $(tenantPerson).find('.bootstrap-select button,.bootstrap-select div').remove()

        $(document).off('click', '#addTenant').on('click', '#addTenant', function () {
            $(document).find('.tenantPerson:last').after(tenantPerson[0].outerHTML)
            $('.tenantPerson .selectpicker').selectpicker('refresh')
            renderUnitNumber();
            let partnerSelectArea = $('.tenantPerson');
            let totalPersonCount = partnerSelectArea.length;
            partnerSelectArea.find('[name="share[]"]').val(1 / totalPersonCount);
        })

        $(document).off('click', '.deletePartner').on('click', '.deletePartner', function () {
            let partnerSelectArea = $('.tenantPerson');
            let totalPersonCount = partnerSelectArea.length - 1;
            $(this).parent().parent().remove()
            partnerSelectArea.find('[name="share[]"]').val(1 / totalPersonCount);
            renderUnitNumber();
        })

        //KİRACI İÇİN KOMUTLAR BİTİŞ
        //KEFİL İÇİN KOMUTLAR
        function renderGuarantorNumber() {
            let unitNumber = 1;
            $('.guarantorPerson .malik-sirasi').each(function () {
                $(this).text(unitNumber++)
            })

            if ($('.guarantorPerson button.deleteGuarantor').length < 2) {
                $('.guarantorPerson button.deleteGuarantor').hide();
            } else {
                $('.guarantorPerson button.deleteGuarantor').show();
            }
        }

        renderGuarantorNumber();

        var guarantorPerson = $(document).find('.guarantorPerson:last').clone();
        $(guarantorPerson).find('.bootstrap-select button,.bootstrap-select div').remove()

        $(document).off('click', '#addGuarantor').on('click', '#addGuarantor', function () {
            $(document).find('.guarantorPerson:last').after(guarantorPerson[0].outerHTML)
            $('.guarantorPerson .selectpicker').selectpicker('refresh')
            renderGuarantorNumber();
            let partnerSelectArea = $('.guarantorPerson');
            let totalPersonCount = partnerSelectArea.length;
            partnerSelectArea.find('[name="share[]"]').val(1 / totalPersonCount);
        })

        $(document).off('click', '.deleteGuarantor').on('click', '.deleteGuarantor', function () {
            let partnerSelectArea = $('.guarantorPerson');
            let totalPersonCount = partnerSelectArea.length - 1;
            $(this).parent().parent().remove()
            partnerSelectArea.find('[name="share[]"]').val(1 / totalPersonCount);
            renderGuarantorNumber();
        })
        //KEFİL İÇİN KOMUTLAR BİTİŞİ

        //Sözleşme Taslağındaki Tab kontrollerini yönetir
        // $('#selectContractType').find('.nav-link').on('show.bs.tab', function () {
        //     if ($(this).attr('href') == "#uploadContract") {
        //         $('[name="contract"][value="uploadContract"]').prop('checked', true)
        //     } else if ($(this).attr('href') == "#newContract") {
        //         $('[name="contract"][value="newContract"]').prop('checked', true)
        //     }
        // });

        $('.btn-complete').on('click', function () {
            //Tıklanan submit buttonunu disable etme
            let letFormSubmitButton = $(this);
            letFormSubmitButton.prop('disabled', true)
            letFormSubmitButton.attr('data-text-temp', letFormSubmitButton.val());
            letFormSubmitButton.val('Yükleniyor...');
            $('#createContract').submit()
        })

        $(document).on('ajaxError', ( function(event, jqxhr, settings, thrownError){
           $('.btn-complete').prop('disabled', false)
           $('.btn-complete').val($('.btn-complete').attr('data-text-temp'));
           //
            let errorsTabs = Object.keys(jqxhr.responseJSON.errors)[0];
            console.log(errorsTabs)
            let tabId = $('[name="'+errorsTabs+'"]').closest('.navigation-tab').attr('id');
            console.log(tabId)
             $('[href="#'+tabId+'"].nav-link').tab('show')

        } ))
        $(document).on('changed.bs.select', '#payment_method_id', function () {
            if ($(this).val() !== "{{\App\Models\Payment::PAYMENT_METHOD_BANK_TRANSFER}}") {
                $(document).find('[name="payment_account_id"]').parent().parent().parent().hide()
                $(document).find('[name="payment_account_id"]').prop('required', false)
                $(document).find('[name="payment_account_id"]').val(null)

            } else {
                $(document).find('[name="payment_account_id"]').parent().parent().parent().show()
                $(document).find('[name="payment_account_id"]').prop('required', true)
                if( $(document).find('[name="payment_account_id"] option').length > 0){
                    $(document).find('[name="payment_account_id"]').val($(document).find('[name="payment_account_id"] option:first').val())
                    $(document).find('[name="payment_account_id"]').selectpicker('refresh');
                }
            }
        })
        $('[name="payment_period"]').change(function () {
            var selectedText = $(this).find("option:selected").text();

            $("#payment_period_name").text(selectedText);
        });
        $('#payment_method_id').trigger('change')
        $('#payment_period').trigger('change')

    })

</script>
