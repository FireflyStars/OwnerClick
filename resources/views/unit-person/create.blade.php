<div class="modal-content">
    <form id="createProperty" method="{{ $formMethod }}" action="{{ $formAction }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.owner_screen')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    {!! __('dashboard.owners_help_description',['item'=>'<a
                        href="#tasks-1"
                        data-toggle="modal" data-backdrop="static" data-target="#createPersonsModal"
                        data-redirect="person_id[]"
                        data-href="/persons/create">'.__("dashboard.persons").'</a>']) !!}
                </div>
            </div>
            <div class="row">
                <label class="col-sm-7 col-form-label">{{__('dashboard.owner_name')}}</label>
                <label class="col-sm-3 col-form-label">{{__('dashboard.share_ratio')}}</label>
                <label class="col-sm-2 col-form-label"></label>
            </div>

            <div id="partnerGroup" class="row partnerGroupForm">
                <div class="col-sm-7">
                    {!! \App\Models\Form::select('person_id[]',App\Models\Person::all(['id','name as name'])->toArray(),$unitPerson,$errors)  !!}
                </div>
                <div class="col-sm-3">
                    {!! \App\Models\Form::input('share[]',$unitPerson,$errors) !!}
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger btn-sm float-right deletePartner"><i
                            class="material-icons">delete</i>Sil
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="offset-8 col-sm-4">
                    <button id="addPartner" type="button" class="btn btn-warning btn-sm float-right">{{__('dashboard.add_partner')}}</button>
                </div>
            </div>
        </div>
        <div class="modal-footer py-0 py-sm-2">
            <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
            <button type="submit" class="btn btn-info">{{__('dashboard.save')}}</button>
        </div>
    </form>
</div><!-- /.modal-content -->

<script>
    function modalInit() {
        var partnerGroupForm = $(document).find('.partnerGroupForm:last').clone();
        $(partnerGroupForm).find('.bootstrap-select button,.bootstrap-select div').remove()
        $(document).off('click', '#addPartner').on('click', '#addPartner', function () {
            $(document).find('.partnerGroupForm:last').after(partnerGroupForm[0].outerHTML)
            $('#ajaxModal .selectpicker').selectpicker()
        })

        $(document).off('click', '.deletePartner').on('click', '.deletePartner', function () {
            $(this).parent().parent().remove()
        })

        $(document).off('click', '#goPersonAdd').on('click', '#goPersonAdd', function () {
            $.ajax('/persons/create').then(function (a) {
                $('#ajaxModal .modal-content').html(a)
                modalInit();
                $('#ajaxModal .selectpicker').selectpicker()
                $('.ajax-selectpicker').each(function () {
                    reloadSelectPicker.call(this);
                })

            })
        })
    }
</script>
