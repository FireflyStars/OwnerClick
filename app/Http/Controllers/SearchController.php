<?php

namespace App\Http\Controllers;


use App\Models\Person;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $key = trim($request->get('q'));
        $keyArray = explode(" ",$key);

        $units = Unit::query()
            ->join('properties','properties.id','=','units.property_id')
            ->join('cities','properties.city_id','=','cities.id')
            ->where(
                function ($query) use($keyArray) {
                    for ($i = 0; $i < count($keyArray); $i++){
                        $query->where(DB::raw('CONCAT(cities.name," ",properties.name," ",units.name," ",properties.address)'), 'like',  '%' . $keyArray[$i] .'%');
                    }
                })
            ->orderBy('units.created_at', 'desc')
            ->limit(5)
            ->get(['cities.name as cityName','properties.name as propertyName','units.name as unitName','properties.address','units.type_id','units.id']);


        $persons = Person::query()
            ->where('name', 'like', "%{$key}%")
            ->orWhere('address', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['id','name','address','authorized_person']);

        foreach($units as $key=>$value){
            $units[$key]->icon = $units[$key]->getTypeIcon();
            $units[$key]->href = route('units.show',$units[$key]);
        }

        foreach($persons as $key=>$value){
            $persons[$key]->icon = "user-alt";
            $persons[$key]->href = route('persons.show',$persons[$key]);
            $persons[$key]->name = "<b>".$persons[$key]->name."</b> / ".$persons[$key]->authorized_person;
        }
        $results = [
            'search_key' =>$key,
            'units' => $units->toJson(),
            'persons' =>$persons->toJson(),
        ];

        return json_encode($results);
        return view('fixtures.index',$results);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'fixture' => new ContractTemplate(),
            'formMethod' => 'post',
            'formAction' => 'fixtures.store'
        ];
        return view('fixtures.create', $data);
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
        return redirect()->route('fixtures.index')->withStatus(__(__('alert.fixture_created_successfully')));
    }

    /**
     * @param \App\Models\Fixture $fixture
     * @return \Illuminate\View\View
     */
    public function edit(Fixture $fixture)
    {
        $data = [
            'fixture' => $fixture,
            'formMethod' => 'PUT',
            'formAction' => 'fixtures.update'
        ];

        return view('fixtures.create', $data);
    }

    /**
     * @param \App\Http\Requests\FixtureRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FixtureRequest $request, Fixture $fixture)
    {

        $fixture->update($request->all());

        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.fixture_updated_successfully')], 'data' => ['id' => $fixture->id, 'name' => $fixture->name]]);
    }

    /**
     * @param \App\Models\Fixture $fixture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fixture $fixture)
    {
        $fixture->delete();
    }
}
