<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Contract;
use App\Models\ContractPersons;
use App\Models\Detail;
use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\PropertyRequest;
use App\Models\Note;
use App\Models\Outgoing;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Person;
use App\Models\Property;
use App\Models\UnitPerson;
use App\Models\Unit;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Notifications\UnitCreatedNotification;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\AssignOp\Concat;
use function Illuminate\Support\Facades\Response;

class UnitController extends Controller
{

    /**
     * @var Property $property
     * @var \App\Models\Unit $unit
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $unit = \App\Models\Unit::find($id);
        $property = $unit->property;
//        $contracts = Contract::query()->where('unit_id', $id)->get()->all();

//        $tenantPersons = ContractPersons::query()->whereIn('contract_id', array_column($contracts,'id'))->where('type_id', ContractPersons::CONTRACT_PERSONS_TYPE_TENANT)->get(['person_id'])->toArray();

//        $tenants = Person::query()->whereIn('id', $tenantPersons)->get()->all();
//
////        $fixtures  = Fixture::query()->where('unit_id', $id)->get()->all();
//
//        $details  = Detail::query()->where('type_id',Detail::DETAIL_TYPE_PROPERTY)->where('object_id', $id)->get()->all();
//
//        $notes  = Note::query()->where('unit_id',$id)->get()->all();
//
//        $payments  = Payment::query()->whereNull('ref_payment_id')->whereIn('contract_id',array_column($contracts,'id'))->orderBy('updated_at','desc')->get()->all();
//
////        $outgoings  = Outgoing::query()->whereIn('contract_id',array_column($contracts,'id'))->get()->all();
//
////        $files  = File::query()->whereIn('contract_id',array_column($contracts,'id'))->orWhere('unit_id', $id)->get()->all();
//
//
//
//        $activeContractArrayKey = array_search(Contract::CONTRACT_STATUS_ACTIVE, array_column($contracts, 'status_id'));
//        $activeContractId = false;
//        if($activeContractArrayKey){
//            $activeContractId = $contracts[$activeContractArrayKey]['id'];
//        }
        $data = [
//            'activeContractId' => $activeContractId,
//            'tenants' => $tenants,
//            'payments' => $payments,
//            'outgoings' => $outgoings,
//            'files' => $files,
//            'contracts' => $contracts,
//            'details' => $details,
//            'notes' => $notes,
//            'fixtures' => $fixtures,
            'property' => $property,
            'unit' => $unit
        ];
        if(request()->ajax()){
            return view('units.detail', $data)->renderSections()['content'];
        }else{
            return view('units.detail', $data);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function files($id){
        $contracts = Contract::query()->where('unit_id', $id)->get()->all();
        $files  = File::query()->whereIn('contract_id',array_column($contracts,'id'))->orWhere('unit_id', $id)->get()->all();
        $folders = File::getTypes();
        $data = [
            'files' => $files,
            'folders' => $folders,
            'unit_id' => $id,
            'unit'=>Unit::find($id),
        ];
        if(request()->ajax()){
            return view('units.files', $data);
        }else{
            return view('units.detail', $data);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function notes($id){
        $notes  = Note::query()->where('unit_id',$id)->get()->all();

        $data = [
            'notes' => $notes,
            'unit_id' => $id,
            'unit'=>Unit::find($id),

        ];
        if(request()->ajax()){
            return view('units.notes', $data);
        }else{
            return view('units.detail', $data);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function fixtures($id){
        $fixtures  = Fixture::query()->where('unit_id', $id)->get()->all();

        $data = [
            'fixtures' => $fixtures,
            'unit_id' => $id,
            'unit'=>Unit::find($id),

        ];
        if(request()->ajax()){
            return view('units.fixtures', $data);
        }else{
            return view('units.detail', $data);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function expenses($id){
        $outgoings  = Outgoing::query()->where('unit_id',$id)->get()->all();
        $data = [
            'outgoings' => $outgoings,
            'unit_id' => $id,
            'unit'=>Unit::find($id),
        ];
        if(request()->ajax()){
            return view('units.expenses', $data);
        }else{
            return view('units.detail', $data);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function paymentDepts($id){
        $contracts = Contract::query()->where('unit_id', $id)->get()->all();
        $paymentDepts  = PaymentDept::query()->whereIn('contract_id',array_column($contracts,'id'))->orderBy('id','desc')->get()->all();

        $data = [
            'paymentDepts' => $paymentDepts,
            'unit_id' => $id,
            'unit'=>Unit::find($id),
        ];
        if(request()->ajax()){
            return view('units.payments', $data);
        }else{
            return view('units.detail', $data);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tenants($id){
        $contracts = Contract::query()->where('unit_id', $id)->get()->all();
        $contractPersons = ContractPersons::query()->whereIn('contract_id', array_column($contracts,'id'))->leftJoin('contracts','contracts.id','=','contract_id')->whereIn('type_id', [ContractPersons::CONTRACT_PERSONS_TYPE_TENANT,ContractPersons::CONTRACT_PERSONS_TYPE_GUARANTOR])->get()->all();

        $data = [
            'contractPersons' => $contractPersons,
            'unit'=>Unit::find($id),
            'unit_id' => $id,
        ];
        if(request()->ajax()){
            return view('units.tenants', $data);
        }else{
            return view('units.detail', $data);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function details($id){
        $unit = Unit::find($id);
        $details  = Detail::query()->where('type_id',Detail::DETAIL_TYPE_PROPERTY)->where('unit_id', $id)->get()->all();

        $data = [
            'unit' => $unit,
            'property' => $unit->property,
            'dashboard' => false,
            'details' => $details,
        ];
        if(request()->ajax()){
            return view('cards.card-unitDetails', $data);
        }else{
            return view('units.detail', $data);
        }

    }



    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function assignments($id){
        $unit = \App\Models\Unit::find($id);
        $property = $unit->property;
        $contracts = Contract::query()->where('unit_id', $id)->get()->all();
        $activeContractArrayKey = array_search(Contract::CONTRACT_STATUS_ACTIVE, array_column($contracts, 'status_id'));
        $data = [
            'contracts' => $contracts,
            'unit' => $unit,
            'unit_id' => $id,
            'activeContractArrayKey' => $activeContractArrayKey,
        ];
        if(request()->ajax()){
            return view('units.assignments', $data);
        }else{
            return view('units.detail', $data);
        }

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $unit = new \App\Models\Unit();
        $unit->property_id = (int)\Illuminate\Support\Facades\Request::input('property_id');
        $data = [
            'item' => $unit,
            'formMethod' => 'post',
            'formAction' => 'units.store'
        ];
        return view('properties.create', $data);
    }

    /**
     * @param \App\Models\Unit $unit
     * @return \Illuminate\View\View
     */
    public function edit(Unit $unit)
    {
        $data = [
            'item' => $unit,
            'formMethod' => 'PUT',
            'formAction' => 'units.update'
        ];

        return view('properties.create', $data);
    }

    /**
     * @param \App\Http\Requests\UnitRequest $request
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $unit->name = $request->get('name')[0];
        $unit->type_id = $request->get('type_id')[0];
        $unit->property_id = $request->get('property_id');
        $unit->update();
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.property_updated_successfully')]]);
        return redirect()->route('properties.index')->withStatus(__('alert.property_updated_successfully'));
    }



    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Property $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UnitRequest $request)
    {

        foreach($request['name'] as $key => $value) {
            $unit = new \App\Models\Unit();
            $unit->creator_id = Auth::id();
            $unit->property_id =$request['property_id'];
            $unit->type_id = $request['type_id'][$key];
            $unit->name = $request['name'][$key];
            $unit->save();
//            Auth::user()->notify(new UnitCreatedNotification($unit));
        }

        $data = [
            'status' => true,
            'target' => '#ajax-content',
            'href' => route('properties.index'),
//            'redirect' => true,
            'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.unit_created_successfully')]];
        return \response()->json($data);
        //  return Response::json(['status' => true, 'message' => 'Gayrimenkul Başarıyla Oluşturuldu.']);
    }

    function persons(Property $property)
    {
        $data = [
            'person' => new Person(),
            'formMethod' => 'post',
            'formAction' => 'properties.store'
        ];

        return view('properties.persons', $data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function updatePersons()
    {
        $data = [
            'person' => new Person(),
            'formMethod' => 'post',
            'formAction' => 'properties.store'
        ];
        return view('properties.create', $data);
    }

    /**
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.delete_created_successfully')]]);

//        return redirect()->route('properties.index')->withStatus(__('Birim silme işlemi başarıyla gerçekleşmiştir.'));
    }




}
