<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\FixtureRequest;
use App\Models\ContractTemplate;
use App\Http\Requests\UserRequest;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FixtureController extends Controller
{

    /**
     * @param Fixture $fixture
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['fixture'] = Fixture::find($id);
        return view('fixtures.detail',$data);


    }

    /**
     * @param Fixture $fixture
     * @return \Illuminate\View\View
     */
    public function index(Fixture $fixture)
    {

        $data = [
            'fixtures' => $fixture->paginate(15),
        ];
        if(request()->ajax()){
            return view('fixtures.index', $data)->renderSections()['content'];
        }else{
            return view('fixtures.index', $data);
        }

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
        $fixture = Fixture::create($request->merge(['creator_id' => Auth::id()])->all());

        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->fixture_id = $fixture->id;
            $fileUpdate->unit_id = $fixture->unit_id;
            $fileUpdate->save();
        }

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
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->fixture_id = $fixture->id;
            $fileUpdate->unit_id = $fixture->unit_id;
            $fileUpdate->save();
        }

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
