<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractPersons;
use App\Models\Detail;
use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\PropertyRequest;
use App\Models\ItemOrder;
use App\Models\Note;
use App\Models\Outgoing;
use App\Models\Payment;
use App\Models\Person;
use App\Models\Property;
use App\Models\UnitPerson;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Database\Seeders\UsersTableSeeder;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Concat;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use function Illuminate\Support\Facades\Response;

class PropertyController extends Controller
{


    /**
     * @param Property $property
     * @return \Illuminate\View\View
     */
    public function index(Request $request, Property $property)
    {
        $data = [
            'properties' => $property->with('orders')->get()
                ->sortBy(function($item) {
                    return  $item->orders?$item->orders->id:null;
            }),
            'propertyCount' => $property->count(),
            'forRentCount' => \App\Models\Unit::query()->join('contracts', 'contracts.unit_id', '=', 'units.id', 'left')->where('contracts.status_id', '!=', Contract::CONTRACT_STATUS_ACTIVE)->orWhereNull('contracts.status_id')->count(),
            'expiredContracts' => Property::query()->join('contracts', 'contracts.unit_id', '=', 'properties.id', 'left')->whereDate('contracts.end_date', '<=', Carbon::now())->count(),
            'expiredContractsNextMonth' => Property::query()->join('contracts', 'contracts.unit_id', '=', 'properties.id', 'left')->whereDate('contracts.end_date', '>=', Carbon::now())->whereDate('contracts.end_date', '<=', Carbon::now()->addMonth())->count()
        ];
        if ($request->ajax()) {
            return view('properties.index', $data)->renderSections()['content'];
        } else {
            return view('properties.index', $data);
        }

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $property = new Property();
        $property->country_id = Auth::user()->location;
        $data = [
            'item' => $property,
            'formMethod' => 'post',
            'formAction' => 'properties.store'
        ];
        return view('properties.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Property $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PropertyRequest $request)
    {
        $property = new Property($request->merge(['creator_id' => Auth::id()])->all());
        $property->save();

        $data = ['status' => true,
            'reload_url' => route('units.create', ['property_id' => $property->id]),
            'reload_target' => '#propertiesModal .modal-dialog',
            'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.property_created_successfully')]];
        return \response()->json($data);
        //  return Response::json(['status' => true, 'message' => 'Gayrimenkul Başarıyla Oluşturuldu.']);
    }

    /**
     * @param \App\Models\Property $property
     * @return \Illuminate\View\View
     */
    public function edit(Property $property)
    {
        $data = [
            'item' => $property,
            'formMethod' => 'PUT',
            'formAction' => 'properties.update'
        ];

        return view('properties.create', $data);
    }

    /**
     * @param \App\Http\Requests\PropertyRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.unit_created_successfully')]]);
//        return redirect()->route('properties.index')->withStatus(__('Gayrimenkul güncelleme işlemi başarıyla gerçekleşti.'));
    }

    /**
     * @param \App\Models\Property $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Property $property)
    {
        $units = count($property->units);
        if($units != 0){
            $data = [
                'success' =>false,
                'icon' => 'warning',
                'type' => 'warning',
                'title' => __('alert.failed_delete_property'),
                'message' => __('alert.you_need_to_delete_the_partitions_belonging_to_the_property'),
            ];
            return \response()->json($data);
        }
        $property->delete();
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.unit_delete_successfully')]]);

//        return redirect()->route('properties.index')->withStatus(__('Gayrimenkul silme işlemi başarıyla gerçekleşmiştir.'));
    }


}
