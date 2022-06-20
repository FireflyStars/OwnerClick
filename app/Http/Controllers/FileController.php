<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\FixtureRequest;
use App\Models\ContractTemplate;
use App\Http\Requests\UserRequest;
use App\Models\Outgoing;
use App\Models\Unit;
use App\Models\UnitPerson;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\Finder;

class FileController extends Controller
{

    /**
     * @param Fixture $file
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['outgoing'] = Outgoing::find($id);
        return view('files.detail');

    }

    /**
     * @param Fixture $file
     * @return \Illuminate\View\View
     */
    public function index(Fixture $file)
    {

        $data = [
            'files' => $file->paginate(15),
        ];
        return view('files.index', $data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'file' => new File(),
            'formMethod' => 'post',
            'formAction' => 'files.store'
        ];
        return view('files.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Fixture $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FixtureRequest $request, Fixture $model)
    {
        $model->create($request->merge(['creator_id' => Auth::id()])->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.fixture_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
        return redirect()->route('files.index')->withStatus(__('alert.fixture_created_successfully'));
    }

    /**
     * @param \App\Models\Fixture $file
     * @return \Illuminate\View\View
     */
    public function edit(Fixture $file)
    {
        $data = [
            'file' => $file,
            'formMethod' => 'PUT',
            'formAction' => 'files.update'
        ];

        return view('files.create', $data);
    }

    /**
     * @param \App\Http\Requests\FixtureRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FixtureRequest $request, Fixture $file)
    {

        $file->update($request->all());

        return redirect()->route('files.index')->withStatus(__('alert.property_updated_successfully'));
    }

    /**
     * @param \App\Models\Fixture $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $file = File::query()->where('hash',$request->get('key'))->get()->first();
        Storage::disk('digitalocean_spaces')->delete($file->path);
        $file->delete();
        return json_encode(['success'=>true]);
    }

    public function download($hash)
    {
        $file = File::query()->where('hash', $hash)->get('path')->first();
        return Storage::disk('digitalocean_spaces')->download($file->path);
    }

    public function get($hash)
    {
        $file = File::query()->where('hash', $hash)->get('path')->first();
        return response()->file(Storage::disk('digitalocean_spaces')->path($file->path));
    }

    public function upload(Request $request)
    {
        $files = $request->file('input-pd');
        foreach ($files as $file) {
            $filePath = Storage::disk('digitalocean_spaces')->put(env('DO_SPACES_FOLDER'), $file);
            $fileModel = new File();
            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->path = $filePath;
            $fileModel->creator_id = Auth::id();
            $fileModel->type_id =$request->get('type_id');
//            $fileModel->unit_id = $request->get('unit_id');
//            $fileModel->contract_id = $contract->id;
            $fileModel->hash = md5($filePath);
            $fileModel->title = "Sözleşme";
            $fileModel->upload_date = Now();
            $fileModel->save();
//            $contract->file_id = $fileModel->id;
//            $contract->save();
        }
        // Saving data to database
        return response()->json(['success' => "File has been successfully uploaded", 'data' => ['id'=>$fileModel->id]], 200);
    }

    public function fileList(Request $request)
    {
        $data = ['fileList' => []];
        $files = File::query()->where('temp',false);
        if($request->get('type_id') == 'last10'){

            $files->orderBy('created_at','desc')->limit(10);
        }else{
            $files->where('type_id',$request->get('type_id'));

        }
        if($request->get('contract_id')){
            $files->where('contract_id',$request->get('contract_id')) ;
        }
        if($request->get('person_id')){
            $files->where('person_id',$request->get('person_id')) ;
        }
        if($request->get('fixture_id')){
            $files->where('fixture_id',$request->get('fixture_id')) ;
        }
        if($request->get('note_id')){
            $files->where('note_id',$request->get('note_id')) ;
        }
        if($request->get('outgoing_id')){
            $files->where('outgoing_id',$request->get('outgoing_id')) ;
        }
        if($request->get('payment_id')){
            $files->where('payment_id',$request->get('payment_id')) ;
        }
        if($request->get('unit_id')){
            $files->where('unit_id',$request->get('unit_id'));
        }
        if((boolean)$request->get('create')){
            $files->limit(0) ;
        }

        if(($request->get('type_id') == File::FILE_TYPE_PERSON OR $request->get('type_id') == 'last10') AND $request->get('unit_id') != null){
            $files->orWhere(function (Builder $query) use ($request){
                //todo Burada bir güvelik zaafiyet olabilir iyi incelemek gerekir.
                    $var = Unit::find($request->get('unit_id'))->persons()->select('persons_properties.person_id')->get()->toArray();
                    $query->where('person_id',$var);
                $query->where('type_id',File::FILE_TYPE_PERSON);
                $query->where('unit_id',null);
            });
        }

            $i = 0;

        foreach ($files->get()->all() as $file) {
//            $data['fileList'][] = route('files.get', $file->hash);
            $data['fileList'][] = Storage::disk('digitalocean_spaces')->temporaryUrl($file->path,now()->addMinutes(1));
            $data['initialPreviewConfig'][] = [
                'type' => $file->extensionType,
//                'size' => 'office',
                'caption' => $file->name,
//                'url' => route('files.get', $file->hash),
                'key' => $file->hash,
                'downloadUrl' => route('files.download', $file->hash),
//                'width' => '100px',

            ];


//            {type: "html", size: 3550, caption: "LoremIpsum.html", url: "/file-upload-batch/2", key: 12, downloadUrl: false},  // disable download
        }

        echo json_encode($data);
        die;
    }


}
