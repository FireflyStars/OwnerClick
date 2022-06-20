<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\File;
use App\Models\Fixture;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Http\Requests\UserRequest;
use App\Models\Outgoing;
use App\Models\Payment;
use App\Models\PaymentDept;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AnalysisController extends Controller
{

    public function index(\Illuminate\Http\Request $request, $unitId = null)
    {
        $data = Payment::payments($unitId);

//        die;
        //        broadcast(new PaymentCreated($payment));
        if ($request->ajax()) {
            return view('analysis', $data)->renderSections()['content'];
        } else {
            return view('analysis', $data);
        }
    }

    public function contract(\Illuminate\Http\Request $request, $unitId = null)
    {

        $beforeDate = Carbon::now()->addMonths(-33)->startOfMonth();
        $afterDate = Carbon::now()->endOfMonth();
        $period = 'Ym';
        //YearlyPayment İçin Tasarlandı
        $yearlyPaymentDeptBuilder = PaymentDept::query();
        $paymentDepts = $yearlyPaymentDeptBuilder
            ->whereBetween('due_date', [$beforeDate, $afterDate])
            ->where('payment_type_id',Payment::PAYMENT_TYPE_RENT)
            ->join('contracts','contracts.id','=','payment_depts.contract_id')
            ->join('units','contracts.unit_id','=','units.id')
            ->join('properties','properties.id','=','units.property_id')
            ->orderBy('due_date', 'desc')
            ->get(['units.id', 'payment_depts.status_id', 'payment_depts.due_date', 'payment_depts.amount', 'payment_depts.active','properties.name as pname','units.name']);

        $yearlyPaymentDates = [];
        $labels = [];
        $payment_date_timestamp = 0;
        $due_date_timestamp = 0;
        foreach ($paymentDepts as $payment) {
            if (!is_null($payment->due_date)) {
                $due_date_timestamp = Carbon::createFromFormat(\auth()->user()->date_format, $payment->due_date)->format($period);
            }

            if (!isset($yearlyPaymentDates[$due_date_timestamp])) {
                $yearlyPaymentDates[$due_date_timestamp] = ['x' => $due_date_timestamp];
            }

            if (!isset($yearlyPaymentDates[$due_date_timestamp][$payment->pname."-".$payment->name])) {
                $yearlyPaymentDates[$due_date_timestamp][$payment->pname."-".$payment->name] = 0;
                $labels[] = $payment->pname."-".$payment->name;
            }

            $yearlyPaymentDates[$due_date_timestamp][$payment->pname."-".$payment->name] += $payment->amount;
        }

        foreach($yearlyPaymentDates as $key => $value){
            foreach($labels as $label){
                if(!isset($value[$label])){
                    $yearlyPaymentDates[$key][$label] = null;
                }
            }
        }

        ksort($yearlyPaymentDates);
        $yearlyPaymentDates = array_values($yearlyPaymentDates);
        echo json_encode($yearlyPaymentDates);
        die;

    }
}
