<div class="modal-content">
    <form id="createProperty" method="POST" action="{{ route($formAction,$property) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.creating_unit')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
            <div class="row">
                <div class="col-sm-4">
                    <h6>{{__('dashboard.category')}}</h6>

                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-form-label">{{__('dashboard.property_name')}}</label>
                            {!! \App\Models\Form::input('name',$property,$errors)  !!}
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">{{__('dashboard.type')}}</label>
                            {!! \App\Models\Form::select('type_id',\App\Models\Property::getTypes(),$property,$errors) !!}
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
                            {!! \App\Models\Form::selectAjax('country_id','/api/countries?withFlag=true',$property,$errors) !!}
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">{{__('dashboard.state')}}</label>
                            {!! \App\Models\Form::selectAjax('state_id',null,$property,$errors) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="col-form-label">{{__('dashboard.city')}}</label>
                            {!! \App\Models\Form::selectAjax('city_id',null,$property,$errors) !!}
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label">Mahalle</label>
                            {!! \App\Models\Form::input('region',$property,$errors)  !!}
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
                                                      aria-required="true">{{ old('address',$property->address) }}</textarea>
                                @if ($errors->has('address'))
                                    <span id="name-error" class="error text-danger"
                                          for="input-name">{{ $errors->first('address') }}</span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <h6>{{__('dashboard.detail')}}</h6>
                    <span>Gayrimenkulünüzü biraz daha tanıyalım</span>
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="col-form-label">Bina No</label>
                            {!! \App\Models\Form::input('building_no',$property,$errors,false)  !!}
                        </div>
                        <div class="col-sm-3">
                            <label class=" col-form-label">Posta Kodu</label>
                            {!! \App\Models\Form::input('zip_code',$property,$errors)  !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}

            </button>
        </div>
    </form>

</div>

<script>
    function modalInit() {
        $('#type_id').on('changed.bs.select', function () {
            console.log($(this).val())
            switch ($(this).val()) {
                // Büro
                case "1":
                    $('[name="building_no"]').parent().parent().show();
                    break;
                // Dükkan
                case "2":
                    $('[name="building_no"]').parent().parent().show();
                    break;
                // Arsa
                case "3":
                    $('[name="building_no"]').parent().parent().hide();
                    break;
                // Konut
                case "4":
                    $('[name="building_no"]').parent().parent().show();
                    break;
                // Bina
                case "5":
                    $('[name="building_no"]').parent().parent().show();
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
            $('#country_id').trigger('changed.bs.select')
        })
    }

    modalInit()
    //todo Buradaki selectAjaxlar çoklu istekte bulunuyor kontrol edilecek

</script>
