<div class="modal-content">
    <form id="createContractTemplate" method="POST" action="{{ route($formAction,$contractTemplate) }}"
          autocomplete="off" novalidate="novalidate">
        @csrf
        @method($formMethod)
        <div class="modal-header">
            <h4 class="modal-title" id="gridSystemModalLabel">{{__('dashboard.create_contract_template')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">


{{--            <div class="row">
                <ul id="selectContractType"
                    class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center"
                    role="tablist">
                    <li class="col-6">
                        <div class="nav-link" data-toggle="tab" href="#link7"
                             role="tablist">
                            <div><i class="material-icons">assignment</i></div>
                            <h6>Sözleşme Taslağı Hazırla</h6>
                            <p>Sözleşme taslağınızı dilediğiniz gibi gelişmiş yazı aracımızla oluşturabilirsiniz.</p>
                        </div>
                    </li>
                    <li class="col-6">
                        <div class="nav-link" data-toggle="tab" href="#link8" role="tablist">
                            <div><i class="material-icons">attach_file</i></div>
                            <h6>Mevcut Sözleşme Taslağını Yükle</h6>
                            <p>Mevcut .doc, .docx ve .odt uzantılı sözleşme taslaklarınızı dizine yükleyebilirsiniz.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <hr/>--}}
            <div class="row">
                <div class="col-sm-12">
                    <label class="col-form-label">{{__('dashboard.template_name')}}</label>
                    {!! \App\Models\Form::input('name',$contractTemplate,$errors)  !!}
                </div>
            </div>
{{--            <div class="tab-content tab-space tab-subcategories">
                <div class="tab-pane" id="link8">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="col-form-label">{{__('dashboard.template_file')}}</label><br/>
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <span class="btn btn-round btn-info btn-file">
                      <span class="fileinput-new">{{__('dashboard.add_file')}}</span>
                      <span class="fileinput-exists">Değiştir</span>
                      <input type="file" name="contractTemplateFile">
                    </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                           data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="link7">--}}
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="col-form-label">{{__('dashboard.contract_template')}}</label><br/>
                        <textarea name="template" id="contractTemplateEditor">{{__('dashboard.enter_the_draft_contract')}}</textarea>
                        </div>
                    </div>
{{--
                </div>
            </div>
--}}


            {{--            <div class="row">
                            <label class="col-sm-4 col-form-label">Şablon HTML Kodu</label>
                            <div class="col-sm-8">
                                {!! \App\Models\Form::textArea('template',$contractTemplate,$errors) !!}
                            </div>
                        </div>--}}

        </div>
        <div class="modal-footer py-0 py-sm-2 ">
            <button type="submit" class="btn btn-info pull-right">{{__('dashboard.save')}}

            </button>
        </div>
    </form>
</div>
<script>
    var editor;
    $(document).ready(function (){
        setFormValidation('#createContractTemplate');

        if(typeof editor == "undefined"){
            editor = ClassicEditor
            editor.create(document.querySelector('#contractTemplateEditor'))
        }
    })
</script>
