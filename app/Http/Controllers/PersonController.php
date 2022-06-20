<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Models\File;
use App\Models\Person;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonController extends Controller
{

    public function __construct()
    {
        $this->middleware([ 'verified'])->only(['create']);

    }

    /**
     * @param Person $person
     * @return \Illuminate\View\View
     */
    public function index(Person $person)
    {

        $data = [
            'persons' => $person->paginate(15),
            'activePersons' => $person->query()->where('status_id', Person::PERSONS_STATUS_ACTIVE)->count()
        ];

        if(request()->ajax()){
            return view('persons.index', $data)->renderSections()['content'];
        }else{
            return view('persons.index', $data);
        }


    }

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['person'] = Person::find($id);
        return view('persons.detail',$data);

    }


    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $data = [
            'person' => new Person(),
            'formMethod' => 'post',
            'formAction' => 'persons.store'
        ];
        return view('persons.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Person $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PersonRequest $request, Person $model)
    {
        $model = Person::create($request->merge(['creator_id' => Auth::id()])->all());
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->person_id = $model->id;
            $fileUpdate->save();
        }
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.person_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
    }

    /**
     * @param \App\Models\Person $person
     * @return \Illuminate\View\View
     */
    public function edit(Person $person)
    {
        $data = [
            'person' => $person,
            'formMethod' => 'PUT',
            'formAction' => 'persons.update'
        ];

        return view('persons.create', $data);
    }

    /**
     * @param \App\Http\Requests\PersonRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PersonRequest $request, Person $person)
    {
        $person->update($request->all());
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->person_id = $person->id;
            $fileUpdate->save();
        }
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.person_updated_successfully')]]);
        return redirect()->route('persons.index')->withStatus(__('alert.property_created_successfully'));
    }

    /**
     * @param \App\Models\Person $person
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Person $person)
    {
        $person->delete();

/*        return redirect()->route('persons.index')->withStatus(__('Gayrimenkul silme işlemi başarıyla gerçekleşmiştir.'));*/
    }
}
