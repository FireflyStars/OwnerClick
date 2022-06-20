<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\OutgoingRequest;
use App\Models\File;
use App\Models\Outgoing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutgoingController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['outgoing'] = Outgoing::find($id);
        return view('outgoings.detail',$data);

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $unitId = \Illuminate\Support\Facades\Request::input('unit_id');
        $data = [
            'outgoing' => new Outgoing(),
            'contracts' => Contract::query()->where('unit_id', $unitId)->get(['contracts.id',DB::raw("CONCAT(start_date,' - ',end_date) as name")])->toArray(),
            'formMethod' => 'post',
            'formAction' => 'outgoings.store',
        ];
        return view('outgoings.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Outgoing $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OutgoingRequest $request, Outgoing $model)
    {
        $model = Outgoing::create($request->merge(['creator_id' => Auth::id()])->all());

        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->outgoing_id = $model->id;
            $fileUpdate->unit_id = $model->unit_id;
            $fileUpdate->save();
        }

        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.outgoing_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
    }

    /**
     * @param \App\Models\Outgoing $outgoing
     * @return \Illuminate\View\View
     */
    public function edit(Outgoing $outgoing)
    {
        $unitId = \Illuminate\Support\Facades\Request::input('unit_id');
        $data = [
            'outgoing' => $outgoing,
            'formMethod' => 'PUT',
            'contracts' => Contract::query()->where('unit_id', $unitId)->get(['contracts.id',DB::raw("CONCAT(start_date,' - ',end_date) as name")])->toArray(),
            'formAction' => 'outgoings.update'
        ];

        return view('outgoings.create', $data);
    }

    /**
     * @param \App\Http\Requests\OutgoingRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OutgoingRequest $request, Outgoing $outgoing)
    {

        $outgoing->update($request->all());
        $files = (array)\Illuminate\Support\Facades\Request::input('files');

        foreach ($files as $file) {
            $fileUpdate = File::find($file);
            $fileUpdate->temp = 0;
            $fileUpdate->outgoing_id = $outgoing->id;
            $fileUpdate->unit_id = $outgoing->unit_id;
            $fileUpdate->save();
        }
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' =>  __('alert.outgoing_updated_successfully')], 'data' => ['id' => $outgoing->id, 'name' => $outgoing->name]]);
    }

    /**
     * @param \App\Models\Outgoing $outgoing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Outgoing $outgoing)
    {
        $outgoing->delete();
    }
}
