<div class="modal-content">
    <form id="createProperty" method="POST" action="{{ route($formAction,$item) }}" autocomplete="off"
          novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            @if($formMethod == 'post')
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_property')}}</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.editing_property')}}</h4>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body ">
            @if(!isset($item->property_id))
                <div class="row">
                    <div class="col-sm-4">
                        <h6>{{__('dashboard.category')}}</h6>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-form-label">{{__('dashboard.property_name')}}</label>
                                {!! \App\Models\Form::input('name',$item,$errors)  !!}
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label">{{__('dashboard.type')}}</label>
                                {!! \App\Models\Form::select('type_id',\App\Models\Property::getTypes(),$item,$errors) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h6>{{__('dashboard.address')}}</h6>
                        <span>{{__('dashboard.use_your_address_information_to_show_map')}}</span>

                    </div>

                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-form-label">{{__('dashboard.country')}}</label>
                                {!! \App\Models\Form::selectAjax('country_id','/api/countries?withFlag=true',$item,$errors) !!}
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label">{{__('dashboard.state')}}</label>
                                {!! \App\Models\Form::selectAjax('state_id',null,$item,$errors) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-form-label">{{__('dashboard.city')}}</label>
                                {!! \App\Models\Form::selectAjax('city_id',null,$item,$errors) !!}
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label">Mahalle</label>
                                {!! \App\Models\Form::input('region',$item,$errors)  !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-form-label">Bina No</label>
                                {!! \App\Models\Form::input('building_no',$item,$errors,false)  !!}
                            </div>
                            <div class="col-sm-6">
                                <label class=" col-form-label">Posta Kodu</label>
                                {!! \App\Models\Form::input('zip_code',$item,$errors)  !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-form-label">{{__('dashboard.address')}}</label>
                                <div
                                    class="form-group bmd-form-group{{ $errors->has('adress') ? ' has-danger' : '' }}">
                                            <textarea name="address"
                                                      class="form-control{{ $errors->has('adress') ? ' is-invalid' : '' }}"
                                                      rows="3" required="true"
                                                      aria-required="true">{{ old('address',$item->address) }}</textarea>
                                    @if ($errors->has('address'))
                                        <span id="name-error" class="error text-danger"
                                              for="input-name">{{ $errors->first('address') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($formAction == 'units.store' OR $formAction == 'units.update')
                <div class="row">
                    <div class="col-sm-4">
                        <h6>{{__('dashboard.units')}}</h6>
                        <span>{{__('dashboard.do_you_own_more_than_one_independent_unit')}}</span>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class=" col-form-label">{{__('dashboard.property')}}</label>
                                {!! \App\Models\Form::select('property_id',App\Models\Property::all(['id','name'])->toArray(),$item,$errors)  !!}
                            </div>
                        </div>
                        <div id="unit-data" class="row">
                            <div class="col-sm-12">
                                <h6><span class="bagimsiz-bolum">1</span>.{{__('dashboard.unit')}}</h6>
                            </div>
                            <div class="col-10 col-sm-10">
                                <label class="col-form-label">{{__('dashboard.name')}}</label>
                                {!! \App\Models\Form::input('name[]',$item,$errors,true)  !!}
                            </div>
                            <div class="col-2 col-sm-2 m-auto">
                                <button type="button" class="btn btn-just-icon btn-danger btn-sm btn-link delete-unit">
                                    <i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        @if($formAction != 'units.update')
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-outline-info btn-sm pull-right element-clone"
                                            data-clone-element="#unit-data">{{__('dashboard.add_new_unit')}}
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}</button>
        </div>
    </form>
</div>


<script>
    function modalInit() {
        function renderUnitNumber() {
            let unitNumber = 1;
            $('.bagimsiz-bolum').each(function () {
                $(this).text(unitNumber++)
                console.log('a');
            })

            if ($('#propertiesModal button.delete-unit').length < 2) {
                $('#propertiesModal button.delete-unit').hide();
            } else {
                $('#propertiesModal button.delete-unit').show();
            }
        }

        $('.element-clone').on('click', function () {
            let elem = $($(this).attr('data-clone-element')).clone();
            $(this).parent().parent().before(elem);
            renderUnitNumber();
        });

        $(document).on('click', '.delete-unit', function () {
            $(this).parent().parent().remove();
            renderUnitNumber();
        });

        $('#type_id').on('changed.bs.select', function () {
            console.log($(this).val())
            switch ($(this).val()) {
                // Büro
                case "1":
                    $('[name="building_no"]').parent().parent().show();
                    $('[name="floor"]').parent().parent().show();
                    $('[name="apartment_no"]').parent().parent().show();
                    break;
                // Dükkan
                case "2":
                    $('[name="building_no"]').parent().parent().show();
                    $('[name="floor"]').parent().parent().show();
                    $('[name="apartment_no"]').parent().parent().hide();
                    break;
                // Arsa
                case "3":
                    $('[name="building_no"]').parent().parent().hide();
                    $('[name="floor"]').parent().parent().hide();
                    $('[name="apartment_no"]').parent().parent().hide();
                    break;
                // Konut
                case "4":
                    $('[name="building_no"]').parent().parent().show();
                    $('[name="floor"]').parent().parent().show();
                    $('[name="apartment_no"]').parent().parent().show();
                    break;
                // Bina
                case "5":
                    $('[name="building_no"]').parent().parent().show();
                    $('[name="floor"]').parent().parent().show();
                    $('[name="apartment_no"]').parent().parent().hide();
                    break;

            }
            reloadSelectPicker.call($('#state_id'));
        })


        $('#country_id').on('changed.bs.select', function () {
            if ($(this).val() != null) {
                $('#state_id').attr('data-select-url', "/api/states/" + $(this).val())
                reloadSelectPicker.call($('#state_id'));
                $('#state_id').trigger('changed.bs.select')
            }
        })


        $('#state_id').on('changed.bs.select', function () {
            if ($(this).val() != null) {
                $('#city_id').attr('data-select-url', "/api/cities/" + $(this).val())
                reloadSelectPicker.call($('#city_id'));
                $('#city_id').trigger('changed.bs.select')
            }

        })

        $(document).ready(function () {
            setFormValidation('#createProperty');

            $('#country_id').trigger('changed.bs.select');
            renderUnitNumber()

        })

        $(document).on('hidden.bs.modal', '.modal', function (e) {

            console.log('kapandı');
        });
    }

    modalInit()
    //todo Buradaki selectAjaxlar çoklu istekte bulunuyor kontrol edilecek

</script>
