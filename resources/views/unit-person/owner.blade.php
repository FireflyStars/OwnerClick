<form class="editOwner" id="editOwner" method="POST" action="{{ $formAction }}" autocomplete="off"
      novalidate="novalidate">
    @csrf
    @method($formMethod)
    <div class="row">
        <div class="col-sm-4">
            <h6>{{__('dashboard.owners')}}</h6>
            <span>{!! __('dashboard.owners_help_description',['item'=>'<a
                    href="#tasks-1"
                    data-toggle="modal" data-backdrop="static" data-target="#createPersonsModal"
                    data-redirect="person_id[]"
                    data-href="/persons/create">'.__("dashboard.persons").'</a>']) !!}</span>
        </div>
        <div class="col-sm-8">
            @if(count($unitPerson) > 0)
                @foreach ($unitPerson as $person)
                    <div id="partnerGroup" class="row partnerGroupForm">
                        <div class="col-sm-12">
                            <h6><span class="malik-sirasi">1</span>.{{__('dashboard.owner')}}</h6>
                        </div>
                        <div class="col-8 col-sm-7">
                            <label class="col-form-label">{{__('dashboard.name')}}</label>
                            <a class="label-link text-info float-right"
                               href="#tasks-1"
                               data-toggle="modal" data-backdrop="static" data-target="#createBankAccountModal"
                               data-redirect="person_id[]"
                               data-href="{{ route('persons.create') }}">{{__('dashboard.new_person')}}</a>
                            <input type="hidden" name="id[]" value="{{old('id',$person->id)}}"/>

                            {!! \App\Models\Form::select('person_id[]',App\Models\Person::all(['id','name as name'])->toArray(),$person,$errors,true,true,'Lütfen seçiniz...')  !!}
                        </div>
                        <div class="col-3 col-sm-3">
                            <label class="col-form-label">{{__('dashboard.share_ratio')}}</label>
                            {!! \App\Models\Form::input('share[]',$person,$errors,true) !!}
                        </div>
                        <div class="col-1 col-sm-2 m-auto">
                            <button type="button"
                                    class="btn btn-just-icon btn-danger btn-sm btn-link deletePartner"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div id="partnerGroup" class="row partnerGroupForm">
                    <div class="col-sm-12">
                        <h6><span class="malik-sirasi">1</span>.{{__('dashboard.owner')}}</h6>
                    </div>
                    <div class="col-7 col-sm-7">
                        <label class="col-form-label">{{__('dashboard.name')}}</label>
                        <a class="label-link text-info float-right"
                           href="#tasks-1"
                           data-toggle="modal" data-backdrop="static" data-target="#createBankAccountModal"
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
                                class="btn btn-just-icon btn-danger btn-sm btn-link deletePartner"><i
                                class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <button type="button"
                            class="addPartner btn btn-outline-info btn-sm pull-right element-clone"
                    >{{__('dashboard.add_partner')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="partners">
    </div>

</form>

<script>
    function modalInitOwner() {
        renderUnitNumber();
        var partnerGroupForm = $(document).find('.partnerGroupForm:last').clone();
        $(partnerGroupForm).find('.bootstrap-select button,.bootstrap-select div').remove()

        if($('#partnerGroup [name="share[]"]').val() === ""){
            $('#partnerGroup [name="share[]"]').val(1);
        }


        function renderUnitNumber() {
            let unitNumber = 1;
            $('#editOwner .malik-sirasi').each(function () {
                $(this).text(unitNumber++)
            })

            if ($('#editOwner button.deletePartner').length < 2) {
                $('#editOwner button.deletePartner').hide();
            } else {
                $('#editOwner button.deletePartner').show();
            }
        }

        $(document).off('click', '.addPartner').on('click', '.addPartner', function () {
            console.log('a');
            $(document).find('.partnerGroupForm:last').after(partnerGroupForm[0].outerHTML)
            $('#editOwner .selectpicker').selectpicker('refresh')
            renderUnitNumber();
            let partnerSelectArea = $('.partnerGroupForm');
            let totalPersonCount = partnerSelectArea.length;
            partnerSelectArea.find('[name="share[]"]').val(1 / totalPersonCount);
        })

        $(document).off('click', '.deletePartner').on('click', '.deletePartner', function () {
            let partnerSelectArea = $('.partnerGroupForm');
            let totalPersonCount = partnerSelectArea.length - 1;
            $(this).parent().parent().remove()
            partnerSelectArea.find('[name="share[]"]').val(1 / totalPersonCount);
            renderUnitNumber();
        })

        $(document).ready(function () {
            setFormValidation('#editOwner');

        })


    }


    modalInitOwner()
</script>
