<?php

namespace App\Http\Controllers;

use App\Events\ContractRenewed;
use App\Events\UnitPersonCreated;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\UnitPersonsRequest;
use App\Http\Requests\PropertyRequest;
use App\Models\Person;
use App\Models\Property;
use App\Models\Unit;
use App\Models\UnitPerson;
use App\Models\User;
use App\Http\Requests\UserRequest;
use http\Env\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Illuminate\Support\Facades\Response;

class UnitPersonsController extends Controller
{


    public function create($propertyId)
    {
        $data = [
            'unitPerson' =>  new UnitPerson(),
            'formMethod' => 'POST',
            'formAction' => route('unit-person.store',$propertyId),
        ];

        return view('unit-person.create', $data);
    }

    public function store(UnitPersonsRequest $request)
    {

//        $test = $persons->update($request->all());
        foreach($request['person_id'] as $key => $value) {
            $person = new UnitPerson();
            $person->creator_id = Auth::id();
            $person->type_id = UnitPerson::UNIT_PERSONS_TYPE_OWNER;
            $person->person_id = $request['person_id'][$key];
            $person->unit_id = $request->get('unit_id');
            $person->status_id = UnitPerson::UNIT_PERSONS_STATUS_ACTIVE;
            $person->share = $request['share'][$key];
            $person->save();
        }
        return \response()->json(['status' => true, 'message' => ['type'=>'success','title' => __('alert.success'),'text'=>__('alert.owner_updated_successfully')]]);
        return redirect()->route('properties.index')->withStatus(__('alert.owner_updated_successfully'));
    }


    /**
     * @param \App\Models\Property $property
     * @return \Illuminate\View\View
     */
    public function edit($unitId)
    {
        $unitPerson = UnitPerson::query()->where('unit_id',$unitId)->get()->all();
        $newPerson = new UnitPerson();
        if(request()->get('modal')){
            $newPerson->person_id = Auth::user()->person->id;
        }
        $data = [
            'unitPerson' => $unitPerson,
            'newPerson' => $newPerson,
            'formMethod' => 'PUT',
            'formAction' => route('unit-person.store',$unitId),
        ];

        if(request()->ajax()){
            if(request()->get('modal') == 'true'){
                return view('modals.owners', $data);
            }else{
                return view('cards.card-owners', $data);
            }
        }else{
            if ($unitId) {
                $data['unit'] = Unit::find($unitId);
                return view('units.detail', $data);
            }
            return redirect(route('units.show',[$unitId]));
        }
    }


    /**
     * @param \App\Models\UnitPerson $unitPerson
     * @return \Illuminate\View\View
     */
    public function update($unitPersonId, UnitPersonsRequest $request, UnitPerson $unitPerson)
    {
        $requestModel = $request->all();
        $unitPersons = UnitPerson::query()->where('unit_id', $unitPersonId)->get()->all();

        foreach($unitPersons as $unitPerson){
            if(in_array($unitPerson->id,$requestModel['id'])) {
                $key = array_search($unitPerson->id,$requestModel['id']);
                $unitPerson->person_id = $requestModel['person_id'][$key];
                $unitPerson->share = $requestModel['share'][$key];
                $unitPerson->status_id = UnitPerson::UNIT_PERSONS_STATUS_ACTIVE;
                $update = $unitPerson->update();
                unset($requestModel['share'][$key]);
                unset($requestModel['person_id'][$key]);
            }else{
                $unitPerson->delete();
            }
        }

        foreach ($requestModel['person_id'] as $key => $value){
            if($requestModel['person_id'][$key] !== null){
            $unitPerson = new UnitPerson();
            $unitPerson->creator_id = Auth::id();
            $unitPerson->type_id = UnitPerson::UNIT_PERSONS_TYPE_OWNER;
            $unitPerson->person_id = $requestModel['person_id'][$key];
            $unitPerson->unit_id = $unitPersonId;
            $unitPerson->status_id = UnitPerson::UNIT_PERSONS_STATUS_ACTIVE;
            $unitPerson->share = $requestModel['share'][$key];
            $unitPerson->save();
            }
        }

        return \response()->json(['status' => true, 'message' => ['type'=>'success','title' => __('alert.success'),'text'=>__('alert.owner_updated_successfully')]]);
    }




    /**
     * @param \App\Models\Property $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->withStatus(__('alert.property_delete_successfully'));
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

}
