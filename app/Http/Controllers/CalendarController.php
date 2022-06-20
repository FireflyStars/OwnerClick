<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Fixture;
use App\Http\Requests\FixtureRequest;
use App\Models\ContractTemplate;
use App\Http\Requests\UserRequest;
use App\Models\Note;
use App\Models\Payment;
use App\Models\Reminder;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class CalendarController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index($unitId = null)
    {
        $data = [ 'unit_id' => $unitId];
        if ($unitId) {
            $data = [
                'unit' => Unit::find($unitId),
                'unit_id' => $unitId
            ];
        }

        if (request()->ajax()) {
            return view('calendar.index',$data)->renderSections()['content'];
        } else {
            if ($unitId) {
                return view('units.detail', $data);
            }
            return view('calendar.index',$data);
        }


    }

    public function events()
    {
        $unitId = Request::input('unit_id');
        $start = Request::input('start');
        $end = Request::input('end');
        $paymentDue = Payment::query()->whereDate('due_date', '>', $start)->whereDate('due_date', '<', $end)->join('contracts', 'payments.contract_id', '=', 'contracts.id')->join('units', 'contracts.unit_id', 'units.id')->join('properties', 'units.property_id', 'properties.id');
        $paymentPayment = Payment::query()->whereDate('payment_date', '>', $start)->whereDate('payment_date', '<', $end)->join('contracts', 'payments.contract_id', '=', 'contracts.id')->join('units', 'contracts.unit_id', 'units.id')->join('properties', 'units.property_id', 'properties.id');
        $statedContracts = Contract::query()->whereDate('start_date', '>', $start)->whereDate('start_date', '<', $end)->join('units', 'contracts.unit_id', 'units.id')->join('properties', 'units.property_id', 'properties.id');
        $endContracts = Contract::query()->whereDate('end_date', '>', $start)->whereDate('end_date', '<', $end)->join('units', 'contracts.unit_id', 'units.id')->join('properties', 'units.property_id', 'properties.id');
        $reminders = Reminder::query()->whereDate('send_at', '>=', $start)->whereDate('send_at', '<=', $end)->leftJoin('units', 'reminders.unit_id', 'units.id')->leftJoin('properties', 'units.property_id', 'properties.id');

        if ($unitId) {
            $paymentDue = $paymentDue->where('contracts.unit_id', $unitId);
            $paymentPayment = $paymentPayment->where('contracts.unit_id', $unitId);
            $statedContracts = $statedContracts->where('unit_id', $unitId);
            $endContracts = $endContracts->where('unit_id', $unitId);
            $reminders = $reminders->where('unit_id', $unitId);
        }
        $paymentsDue = $paymentDue->addSelect(['contracts.unit_id', 'payments.id', DB::raw("'#009400' as color"), DB::raw("CONCAT(properties.name,'/',units.name, ' Ödeme Günü') as title"), DB::raw('due_date as start')])->get()->toArray();
        $paymentsPayment = $paymentPayment->addSelect(['contracts.unit_id', 'payments.id', DB::raw("'#7ece7e' as color"), DB::raw("CONCAT(properties.name,'/',units.name, ' Ödeme Alındı') as title"), DB::raw('payment_date as start')])->get()->toArray();
        $statedContracts = $statedContracts->addSelect(['contracts.unit_id', 'contracts.id', DB::raw("'#34a7f7' as color"), DB::raw("CONCAT(properties.name,'/',units.name, ' Sözleşme Başlangıcı') as title"), DB::raw('start_date as start')])->get()->toArray();
        $endContracts = $endContracts->addSelect(['contracts.unit_id', 'contracts.id', DB::raw("'#0a7eda' as color"), DB::raw("CONCAT(properties.name,'/',units.name, ' Sözleşme Bitişi') as title"), DB::raw('end_date as start')])->get()->toArray();
        $reminders = $reminders->addSelect(['reminders.unit_id', 'reminders.id', DB::raw("'#0a7eda' as color"), DB::raw("CONCAT(reminders.title, ' Hat') as title"), DB::raw("'bell' as icon"), DB::raw('send_at as start')])->get()->toArray();

        foreach ($paymentsDue as $key => $value) {
            $paymentsDue[$key]['link'] = route('payments.show', [$value['id'], 'unit_id' => $value['unit_id']]);
        }
        foreach ($paymentsPayment as $key => $value) {
            $paymentsPayment[$key]['link'] = route('payments.show', [$value['id'], 'unit_id' => $value['unit_id']]);
        }
        foreach ($statedContracts as $key => $value) {
            $statedContracts[$key]['link'] = route('contracts.show', [$value['id']]);
        }
        foreach ($endContracts as $key => $value) {
            $endContracts[$key]['link'] = route('contracts.show', [$value['id']]);
        }
        foreach ($reminders as $key => $value) {
            $reminders[$key]['link'] = route('reminders.edit', [$value['id']]);
        }

        $data = array_merge($paymentsDue, $paymentsPayment, $statedContracts, $endContracts, $reminders);
        echo json_encode($data);
        die;

    }


}
