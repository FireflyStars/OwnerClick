<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Http\Requests\DetailRequest;
use App\Models\Detail;
use App\Http\Requests\UserRequest;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DetailController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['detail'] = Detail::find($id);
        return view('details.detail',$data);

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [
            'detail' => new Detail(),
            'formMethod' => 'post',
            'formAction' => 'details.store'
        ];
        return view('details.create', $data);
    }

    /**
     * @param \App\Http\Requests\UserRequest $request
     * @param \App\Models\Detail $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DetailRequest $request, Detail $model)
    {
        $model = Detail::create($request->merge(['creator_id' => Auth::id()])->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.detail_created_successfully')], 'data' => ['id' => $model->id, 'name' => $model->name]]);
    }

    /**
     * @param \App\Models\Detail $detail
     * @return \Illuminate\View\View
     */
    public function edit(Detail $detail)
    {
        $data = [
            'detail' => $detail,
            'formMethod' => 'PUT',
            'formAction' => 'details.update'
        ];

        return view('details.create', $data);
    }

    /**
     * @param \App\Http\Requests\DetailRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DetailRequest $request, Detail $detail)
    {
        $detail->update($request->all());
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.detail_updated_successfully')], 'data' => ['id' => $detail->id, 'name' => $detail->name]]);
    }

    /**
     * @param \App\Models\Detail $detail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Detail $detail)
    {
        $detail->delete();
    }
}
