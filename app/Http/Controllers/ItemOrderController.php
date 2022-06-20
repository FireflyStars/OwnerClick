<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemOrderRequest;
use App\Models\Fixture;
use App\Http\Requests\DetailRequest;
use App\Models\Detail;
use App\Http\Requests\UserRequest;
use App\Models\ItemOrder;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ItemOrderController extends Controller
{


    /**
     * @param \App\Http\Requests\ItemOrderRequest $request
     * @param \App\Models\ItemOrder $itemOrder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ItemOrderRequest $request, ItemOrder $itemOrder)
    {
        DB::beginTransaction();
        ItemOrder::query()->where(['user_id' => \auth()->user()->id, 'item_type' => $request->get('item_type'),'parent_item_id' => $request->get('parent_item_id')])->delete();
        foreach ($request->get('item_sort') as $key => $value) {
            ItemOrder::firstOrCreate([
                'user_id' => \auth()->user()->id,
                'item_type' => $request->get('item_type'),
                'parent_item_id' => $request->get('parent_item_id'),
                'item_id' => $value,
                'order' => $key,
            ]);
        }
        DB::commit();
        return \response()->json(['status' => true, 'message' => ['type' => 'success', 'title' => __('alert.success'), 'text' => __('alert.ranking_information_updated')]]);
    }

}
