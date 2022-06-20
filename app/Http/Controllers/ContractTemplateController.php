<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractTemplateRequest;
use App\Models\ContractTemplate;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\ZipArchive;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Writer\HTML;
use PhpOffice\PhpWord\Writer\PDF;

class ContractTemplateController extends Controller
{

    /**
     * @param ContractTemplate $contractTemplate
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $contractTemplate = ContractTemplate::find($id);
        $data = ['property' => $contractTemplate];
        return view('contract-templates.detail', $data);

    }

    /**
     * @param ContractTemplate $contractTemplate
     * @return \Illuminate\View\View
     */
    public function index(ContractTemplate $contractTemplate)
    {

        $data = [
            'contractTemplates' => $contractTemplate->paginate(15),
        ];
        return view('contract-templates.index', $data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'contractTemplate' => new ContractTemplate(),
            'formMethod' => 'post',
            'formAction' => 'contract-templates.store'
        ];
        return view('contract-templates.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\ContractTemplate $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContractTemplateRequest $request, ContractTemplate $model)
    {
        //   $word = new \DOMDocument();

        $model = ContractTemplate::create($request->merge(['creator_id' => Auth::id()])->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.contract_template_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);


        $path = '/var/www/html/public/Sultanbeyli A blok 2.docx';
        $document = $request->file('contractTemplateFile');
        $path = $document->getClientOriginalName();
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $phpWord = IOFactory::load($path,'Word2007');
        $objWriter = IOFactory::createWriter($phpWord, 'HTML');
        $html = new HTML($phpWord);
        $outputHTML = $html->getContent();
        $model = ContractTemplate::create($request->merge(['creator_id' => Auth::id(),'template' => $outputHTML])->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.contract_template_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
        //return redirect()->route('contract-templates.index')->withStatus(__('Kiracı kaydı başarıyla oluşturuldu.'));
    }

    /**
     * @param \App\Models\ContractTemplate $contractTemplate
     * @return \Illuminate\View\View
     */
    public function edit(ContractTemplate $contractTemplate)
    {
        $data = [
            'contractTemplate' => $contractTemplate,
            'formMethod' => 'PUT',
            'formAction' => 'contract-templates.update'
        ];

        return view('contract-templates.create', $data);
    }

    /**
     * @param \App\Http\Requests\ContractTemplateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContractTemplateRequest $request, ContractTemplate $contractTemplate)
    {
        $contractTemplate->update($request->all());

        return redirect()->route('contract-templates.index')->withStatus(__('alert.property_updated_successfully'));
    }

    /**
     * @param \App\Models\ContractTemplate $contractTemplate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ContractTemplate $contractTemplate)
    {
        $contractTemplate->delete();

        return redirect()->route('contract-templates.index')->withStatus(__('alert.property_delete_successfully'));
    }


}
